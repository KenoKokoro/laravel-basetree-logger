<?php


namespace BaseTree\Modules\Log;


use BaseTree\DAL\TrafficLog\TrafficLogRepository;
use BaseTree\Models\TrafficLog;
use Symfony\Component\HttpFoundation\Response;

class DatabaseLogger extends BaseLogger implements ClientLogger
{
    /**
     * @var TrafficLogRepository
     */
    private $repository;

    public function __construct(TrafficLogRepository $repository)
    {
        $this->repository = $repository;
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

        return $this->repository->create($attributes);
    }
}