<?php

namespace CraigWoodlandOW\LaravelBarcodeGenerator;

use Illuminate\Support\ServiceProvider;

class BarcodeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
