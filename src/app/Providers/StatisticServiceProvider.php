<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Services\StatisticService;

class StatisticServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind('StatisticService', StatisticService::class);
    }
}
