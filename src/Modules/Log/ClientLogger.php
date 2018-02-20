<?php


namespace BaseTree\Modules\Log;


use BaseTree\Models\TrafficLog;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

interface ClientLogger
{
    /**
     * @param Response $response
     * @param Request|null $request
     * @return TrafficLog
     */
    public function writeIncoming(Response $response, $request = null);

    /**
     * @param Response $response
     * @param string $going
     * @param Request|null $request
     * @return TrafficLog
     */
    public function write(Response $response, $going = TrafficLog::GOING_IN, $request = null);
}