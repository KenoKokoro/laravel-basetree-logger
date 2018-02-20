<?php


namespace BaseTree\DAL;


use BaseTree\DAL\TrafficLog\EloquentTrafficLog;
use BaseTree\DAL\TrafficLog\TrafficLogRepository;
use Illuminate\Support\ServiceProvider;

class DalServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(TrafficLogRepository::class, EloquentTrafficLog::class);
    }
}