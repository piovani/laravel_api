<?php

namespace App\Domain\Localization\State;

use App\Domain\Localization\City\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use SoftDeletes;

    public $incrementing = false;

    const COLUMNS = [
        'id',
        'name',
        'initials',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'updated_at',
        'deleted_at',
    ];

    public static function initial ($initials)
    {
        return State::where('initials', $initials)->first();
    }

    public function cities()
    {
        return $this->hasMany('App\Domain\Localization\City\City');
    }
}
