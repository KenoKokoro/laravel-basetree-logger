<?php

namespace BaseTree\Providers;


use BaseTree\DAL\DalServiceProvider;
use BaseTree\Modules\Log\ClientLogger;
use BaseTree\Modules\Log\DatabaseLogger;
use BaseTree\Modules\Log\FileLogger;
use Illuminate\Support\ServiceProvider;

class BaseTreeLoggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__. '/../../database/migrations');
    }
    
    public function register()
    {
        $this->bindLogger();
        $this->app->register(DalServiceProvider::class);
    }

    private function bindLogger()
    {
        if (app()->runningUnitTests()) {
            $this->app->bind(ClientLogger::class, FileLogger::class);
        } else {
            $this->app->bind(ClientLogger::class, DatabaseLogger::class);
        }
    }
}