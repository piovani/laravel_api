<?php

namespace App\Domain\Localization\State;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    protected $primaryKey = 'id';

    const COLUMNS = [
        'id',
        'name',
        'initials',
        'created_at',
        'updated_at',
    ];


    public static function initial ($initials)
    {
        return State::where('initials', $initials)->first();
    }

}
