<?php

namespace Saeed\LoginLog;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Saeed\LoginLog\Console\ClearCommand;


class LoginLogServiceProvider extends ServiceProvider
{
    public function boot()
    {

        $this->registerEvents();
        $this->loadViewsFrom(__DIR__ . '/views', 'LoginLog');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/config/LoginLog.php' => config_path('LoginLog.php'),
                __DIR__ . '/views/email.blade.php' => resource_path('/views/vendor/LoginLog/email.blade.php'),

            ], 'Login-log');
        }

    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/LoginLog.php', 'LoginLog'
        );
        
        if ($this->app->runningInConsole()) {
            $this->commands([
                ClearCommand::class
            ]);
        }

    }


    protected function registerEvents()
    {
        Event::listen(Login::class, function () {
            auth()->user()->storeLoginInfo();
        });

    }


}