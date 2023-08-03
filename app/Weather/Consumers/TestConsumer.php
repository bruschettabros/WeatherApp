<?php

namespace App\Weather\Consumers;

use App\Weather\Adapters\BlueSky as BlueSkyAdapter;
use Carbon\Carbon;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class TestConsumer extends AbstractWeatherConsumer
{
    public function __construct(private readonly string $apiKey) {}

    protected function request(?string $uri = null) : PromiseInterface|Response
    {
        return Http::fake([
            'http://fakeapi/api/' => Http::response([
                'data' => [
                    'apparent_temperature_at_2m' => 290.46799442,
                    'relative_humidity_at_2m' => 98.15939112,
                    'categorical_rain_at_surface' => 1,
                    'categorical_snow_at_surface' => 0,
                    'pressure_at_surface' => 99520,
                    'visibility_at_surface' => 2003,
                    'wind_speed_gust_at_surface' => 15.491631,
                ],
            ], 200)
        ])->get('http://fakeapi/api/');
    }

    public function getAdapter() : string
    {
        return BlueSkyAdapter::class;
    }

    public function current() : PromiseInterface|Response
    {
        return $this->request();
    }

    public function past(Carbon $from, Carbon $to) : PromiseInterface|Response
    {
        return $this->request();
    }
}
