<?php

namespace App\Weather\Consumers;

use Carbon\Carbon;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;

abstract class AbstractWeatherConsumer
{
    protected const BASE_URL = '';
    protected float $lat;
    protected float $lon;

    abstract protected function request(?string $uri = null) : PromiseInterface|Response;

    abstract public function getAdapter() : string;

    abstract public function current() : PromiseInterface|Response;

    abstract public function past(Carbon $from, Carbon $to) : PromiseInterface|Response;

    public function setLocation(float $lat, float $lon) : self
    {
        $this->lat = $lat;
        $this->lon = $lon;

        return $this;
    }

    public static function getConsumerName() : string
    {
        return str(static::class)->afterLast('\\')->before('Consumer');
    }
}
