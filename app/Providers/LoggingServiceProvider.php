<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Utility\MyLogger3;

class LoggingServiceProvider extends ServiceProvider
{
    protected $defer = true;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //used for only one instance
        $this->app->singleton('App\Http\Services\Utility\ILoggerService', function($app){
           return new MyLogger3(); 
        });
        /*
         * used for multipul instances
         * $this->app->bind('App\Services\Utility\ILoggerService', function($app){
           return new MyLogger3(); 
        });
         * 
         */
     
    }
    
    public function provides(){
        echo "Deferred true and i am here in provides()";
        return ['App\Http\Services\Utility\ILoggerService'];
    }
}
