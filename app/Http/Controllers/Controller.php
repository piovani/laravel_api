<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected const messageSuccess = 'Operação efetuada com sucesso.';
    protected const messageError   = 'Não foi possível efetuar a operação.';

    protected const messsages      = [
        200 => self::messageSuccess,
        500 => self::messageError,
    ];

    protected function messageResponse($status = 200)
    {
        return Response()->json([
            'Messagem' => self::messsages[$status],
        ], $status);
    }
}
