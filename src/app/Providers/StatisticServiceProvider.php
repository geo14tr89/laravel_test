<?php

namespace App\Providers;


use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use App\Services\StatisticService;

class StatisticServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind(StatisticService::class, static function ($app) {
            return new StatisticService($app->make(Request::class));
        });
    }
}
