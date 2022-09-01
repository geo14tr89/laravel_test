<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class StatisticService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'StatisticService';
    }
}
