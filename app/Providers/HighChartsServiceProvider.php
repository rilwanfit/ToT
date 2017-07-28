<?php

namespace App\Providers;

use App\HighCharts;
use Illuminate\Support\ServiceProvider;

class HighChartsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HighCharts::class , function(){
            return new Highcharts;
        });
    }
}
