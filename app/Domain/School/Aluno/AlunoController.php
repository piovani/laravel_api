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

    public function index(Request $request)
    {
        return response($this->service->getList($request));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|max:255',
            'cpf'      => 'required|min:11|max:11',
            'curso_id' => 'required|exists:cursos,id',
            'city_id'  => 'required|exists:cities,id',
            'state_id' => 'required|exists:states,id',
        ]);

        return response($this->service->store($request), 201);
    }

    public function show(Aluno $aluno)
    {
        return response($aluno, 200);
    }

    public function update(Request $request, Aluno $aluno)
    {
        $request->validate([
            'name'     => 'max:255',
            'cpf'      => 'min:11|max:11',
            'curso_id' => 'exists:cursos,id',
            'city_id'  => 'exists:cities,id',
            'state_id' => 'exists:states,id',
        ]);

        return response($this->service->update($aluno, $request), 200);
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
