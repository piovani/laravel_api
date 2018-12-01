<?php

namespace Modules\CRM\Services\Statistics;

use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

class Statistics
{
    const DAILY = 'daily';
    const WEEKLY = 'weekly';
    const MONTHLY = 'monthly';
    const RETURN_PERIOD_AS_STRING = 'string';

    /** @var Builder */
    private $query;
    /** @var string */
    private $dateColumn = 'created_at';
    /** @var int */
    private $quantidadePeriodos = 6;
    /** @var string */
    private $periodo;
    /** @var Carbon */
    private $dataFinal;
    /** @var Carbon */
    private $dataInicial;
    /** @var array */
    private $indicadores = [];
    /** @var Collection */
    private $data;
    /** @var Collection */
    private $rowsByPeriod;
    /** @var string */
    private $returnPeriodAs;
    /** @var Collection */
    private $dataWithIndicadors;

    public function __construct($query)
    {
        $this->data = new Collection();
        $this->rowsByPeriod = new Collection();
        $this->dataWithIndicadors = new Collection();

        $this->query = $query;
        $this->setDataFinal(Carbon::now());
    }

    public function setDataFinal($dataFinal)
    {
        $this->dataFinal = $dataFinal;
    }

    public static function ofQuery($query)
    {
        return new self($query);
    }

    public function setInterval($periodoEscolhido, $quantidadePeriodo, $returnPeriodAs = 'default')
    {
        $this->setPeriodo($periodoEscolhido);
        $this->quantidadePeriodos = $quantidadePeriodo;
        $this->setReturnAs($returnPeriodAs);

        $this->setDataInicial($this->getDataAtualMenosPeriodos());
    }

    /**
     * @return Carbon
     */
    private function getDataAtualMenosPeriodos()
    {
        $subPeriodos = [
            self::DAILY => 'subDays',
            self::WEEKLY => 'subWeeks',
            self::MONTHLY => 'subMonths',
        ];

        $periodoEscolhido = $subPeriodos[$this->periodo];

        return Carbon::today()->$periodoEscolhido($this->quantidadePeriodos - 1);
    }

    public function addIndicador($nomeIndicador, $closure)
    {
        $this->indicadores[$nomeIndicador] = $closure;
    }

    public function make()
    {
        $this->getDataFromQuery();

        $this->setRowsByPeriod();

        $this->runIndicadorsOnPeriod();

        return $this->dataWithIndicadors;
    }

    private function getDataFromQuery()
    {
        $this->setDateBetween($this->dataInicial, $this->dataFinal);
        $this->data = $this->query->get();
    }

    private function setRowsByPeriod()
    {
        $column = $this->dateColumn;
        $carbonPeriod = $this->getCarbonPeriod();

        $this->rowsByPeriod = $this
            ->data
            ->groupBy(function ($row) use ($column, $carbonPeriod) {
                $period = Carbon::parse($row->$column)->$carbonPeriod;
                return $this->transformPeriodIfNeeded($period);
            });
    }

    /**
     * @return mixed
     */
    private function getCarbonPeriod()
    {
        $periodosDisponiveis = [
            'daily' => 'dayOfWeek',
            'weekly' => 'weekOfYear',
            'monthly' => 'month',
        ];

        return $periodosDisponiveis[$this->periodo];
    }

    private function transformPeriodIfNeeded($period)
    {
        if ($this->returnPeriodAs == self::RETURN_PERIOD_AS_STRING) {
            return $this->getPeriodAsString($period);
        }

        return $period;
    }

    /**
     * @param $period
     *
     * @return mixed|string
     */
    private function getPeriodAsString($period)
    {
        if ($this->periodo == self::DAILY) {
            return Helper::converteDiaDaSemanaParaString($period);
        }

        if ($this->periodo == self::MONTHLY) {
            return Helper::converteMesParaString($period);
        }

        return $period;
    }

    private function runIndicadorsOnPeriod()
    {
        $this->dataWithIndicadors = $this
            ->rowsByPeriod
            ->map(function ($periodo) {
                $indicadors = [];
                foreach ($this->indicadores as $indicador => $closure) {
                    $indicadors[$indicador] = call_user_func($closure, $periodo);
                }

                return collect($indicadors);
            });
    }

    public function getPeriods()
    {
        return $this
            ->dataWithIndicadors
            ->keys();
    }

    /**
     * @param string $dateColumn
     */
    public function setDateColumn($dateColumn)
    {
        $this->dateColumn = $dateColumn;
    }

    /**
     * @param $startDate
     * @param $endDate
     */
    public function setDateBetween($startDate, $endDate)
    {
        $this
            ->query
            ->whereBetween($this->dateColumn, [$startDate, $endDate])
            ->oldest($this->dateColumn);
    }

    /**
     * @param $carbon
     */
    public function setDataInicial($carbon)
    {
        $this->dataInicial = $carbon;
    }

    /**
     * @param $periodoEscolhido
     */
    public function setPeriodo($periodoEscolhido)
    {
        $this->periodo = $periodoEscolhido;
    }

    /**
     * @param $returnPeriodAs
     */
    public function setReturnAs($returnPeriodAs)
    {
        $this->returnPeriodAs = $returnPeriodAs;
    }
}
