<?php


namespace BaseTree\DAL\TrafficLog;


use BaseTree\Eloquent\BaseEloquent;
use BaseTree\Models\TrafficLog;

class EloquentTrafficLog extends BaseEloquent implements TrafficLogRepository
{
    public function __construct(TrafficLog $model)
    {
        parent::__construct($model);
    }
}