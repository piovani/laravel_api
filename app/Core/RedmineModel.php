<?php

namespace App\Core;

abstract class RedmineModel extends Model
{
    const CREATED_AT = 'created_on';

    const UPDATED_AT = 'updated_on';

    protected $connection = 'redmine';
}