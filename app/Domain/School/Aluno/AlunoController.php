<?php

namespace App\Domain\School\Aluno;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AlunoController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new AlunoService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this
            ->service
            ->getList($request);

        return response($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this
            ->service
            ->store($request);

        return response($data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function show(Aluno $aluno)
    {
        return response($aluno, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aluno $aluno)
    {
        $data = $this
            ->service
            ->update($aluno, $request);

        return response($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aluno $aluno)
    {
        $aluno->deleted = true;
        $aluno->save();

        return response(null, 204);
    }

    public function getRelacaoAlunoCurso()
    {
        $dataInicial = Carbon
            ::today()
            ->subMonths(6)
            ->startOfMonth();

        //-------------------------------------------------------
        $data = $statistics
            ->make()
            ->toArray();
        $novaData = new Collection();
        foreach ($data as $mes => $value) {
            $novaData->put($mes, $value);
            $proximoValue = next($data);
            $proximaChave = key($data);

            if ($proximoValue) {
                for ($proximoMes = $mes + 1; $proximoMes < $proximaChave; $proximoMes++) {
                    $novaData->put($proximoMes, $value);
                }
            }
        }

        $periodos = $novaData
            ->keys()
            ->map(function ($key) {
                return Helper::converteMesParaString($key);
            });

        //--------------------------------------------------------

        $periodo = $request->periodo;


        $tituloPrimeiraQuinzena = 'primeiraQuinzena';

        $tituloSegundaQuinzena = 'segundaQuinzena';

        if ($periodo == Statistics::MONTHLY) {
            $tituloPrimeiraQuinzena = 'mediaAcordada';
            $this->MESES_RETROATIVOS = 5;
        }

        $atendimentoQuery = Atendimento::where('USER_ID', $request->user_id);

        $statistics = Statistics::ofQuery($atendimentoQuery);
        $statistics->setDateColumn('data_prazo_resposta');
        $statistics->setPeriodo(Statistics::MONTHLY);
        $statistics->setDataInicial(self::getDataInicial($this->MESES_RETROATIVOS));

        $statistics->addIndicador($tituloPrimeiraQuinzena, function ($row) use ($periodo) {
            return $row->filter(function ($innerRow) use ($periodo) {
                $diaDoPrazoResposta = Carbon::parse($innerRow->data_prazo_resposta)->day;
                return $diaDoPrazoResposta <= $periodo == Statistics::MONTHLY ? 15 : 31;
            })->avg('dias_acordado') ?: 0;
        });

        if ($periodo != Statistics::MONTHLY) {
            $statistics->addIndicador($tituloSegundaQuinzena, function ($row) {
                return $row->filter(function ($innerRow) {
                    $diaDoPrazoResposta = Carbon::parse($innerRow->data_prazo_resposta)->day;
                    return $diaDoPrazoResposta > 15;
                })->avg('dias_acordado') ?: 0;
            });
        }

        $novaData = self::fillIncompletePeriods($statistics);
        $periodos = self::getPeriodos($novaData);

        $returnJs = new ChartJsFactory();
        $datasets = $novaData->pluck($tituloPrimeiraQuinzena);
        $returnJs->addDataset($tituloPrimeiraQuinzena, $datasets);

        if ($periodo != Statistics::MONTHLY) {
            $datasets = $novaData->pluck($tituloSegundaQuinzena);
            $returnJs->addDataset($tituloSegundaQuinzena, $datasets);
        }


        $returnJs->setPeriodos($periodos->toArray());

        return $returnJs->make();

    }
}
