<?php

namespace App\Domain\Localization\City;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;

    public $incrementing = false;

    protected $primaryKey = 'id';

    const COLUMNS = [
        'id',
        'name',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function scopeState($query)
    {
        return $query->where('state_id');
    }
}
