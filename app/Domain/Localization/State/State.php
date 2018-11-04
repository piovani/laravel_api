<?php

namespace App\Domain\Localization\State;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
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
