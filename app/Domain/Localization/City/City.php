<?php

namespace App\Domain\Localization\City;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'id';

    const COLUMNS = [
        'id',
        'name',
        'created_at',
        'updated_at',
    ];
}
