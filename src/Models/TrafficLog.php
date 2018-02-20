<?php


namespace BaseTree\Models;


use Illuminate\Database\Eloquent\Model;

class TrafficLog extends Model implements BaseTreeModel
{
    const GOING_IN = 'in';
    const GOING_OUT = 'out';

    protected $table = 'traffic_logs';

    protected $fillable = [
        'client',
        'url',
        'method',
        'requestHeaders',
        'requestBody',
        'responseHeaders',
        'responseBody',
        'code',
        'going'
    ];

    protected $casts = [
        'requestHeaders' => 'json',
        'requestBody' => 'json',
        'responseHeaders' => 'json',
        'responseBody' => 'json',
    ];

    /**
     * @return \Illuminate\Support\Collection
     */
    public function going()
    {
        return collect([self::GOING_IN => self::GOING_IN, self::GOING_OUT => self::GOING_OUT]);
    }
}