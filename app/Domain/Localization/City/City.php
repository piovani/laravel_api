<?php

namespace App\Domain\Localization\City;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $primaryKey = 'id';

    const COLUMNS = [
        'id',
        'name',
        'created_at',
        'updated_at',
    ];
}
