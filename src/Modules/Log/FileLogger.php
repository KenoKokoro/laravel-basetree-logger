<?php


namespace BaseTree\Modules\Log;


use BaseTree\Models\TrafficLog;
use Illuminate\Contracts\Logging\Log;
use Symfony\Component\HttpFoundation\Response;

class FileLogger extends BaseLogger implements ClientLogger
{
    /**
     * @var Log
     */
    protected $log;

    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    public function writeIncoming(Response $response, $request = null)
    {
        return $this->write($response, TrafficLog::GOING_IN, $request);
    }

    public function write(Response $response, $going = TrafficLog::GOING_IN, $request = null)
    {
        if (is_null($request)) {
            $request = request();
        }

        $attributes = $this->buildAttributes($response, $request);
        $attributes['going'] = $going;

        $this->log->info(json_encode($attributes));
    }
}