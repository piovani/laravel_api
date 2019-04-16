<?php

namespace App\Domain\School\Aluno;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Activitylog\Traits\LogsActivity;

class Aluno extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use LogsActivity;

    public $incrementing = false;

    protected $fillable = [
        'name',
        'cpf',
        'curso_id',
        'city_id',
        'state_id',
        'faltas',
    ];

    protected $auditInclude = [
        'name',
        'curso_id',
    ];

    protected static $logAttributes = [
        'name',
        'curso_id',
    ];
}
