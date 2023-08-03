<?php

namespace App\Weather\Consumers;

use App\Weather\Adapters\BlueSky as BlueSkyAdapter;
use App\Weather\Exceptions\LocationNotSetException;
use Carbon\Carbon;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

final class BlueSky extends AbstractWeatherConsumer
{
    protected const BASE_URL = 'https://api.blueskyapi.io';

    protected const CURRENT_URI  = '/forecasts/latest';

    protected const PAST_URI = '/forecasts/history';

    public function __construct(private readonly string $apiKey) {}

    public function getAdapter() : string
    {
        return BlueSkyAdapter::class;
    }

    public function current() : PromiseInterface|Response
    {
        return $this->request(self::CURRENT_URI);
    }

    public function past(Carbon $from, Carbon $to) : PromiseInterface|Response
    {
        return $this->request(self::PAST_URI, [
            'min_forecast_moment' => $from->toIso8601String(),
            'max_forecast_moment' => $to->toIso8601String(),
        ]);
    }

    protected function request(?string $uri = null, array $additionalParams = []) : PromiseInterface|Response
    {
        if (!$this->lat || !$this->lon) {
            throw new LocationNotSetException('Location not set');
        }
        return Http::withHeaders([
            'Authorization' => sprintf('Bearer %s', $this->apiKey),
        ])->get(self::BASE_URL . $uri, [
            'lat' => $this->lat,
            'lon' => $this->lon,
            'columns' => $this->getCallColumns(),
            ...$additionalParams,
        ]);
    }

    private function getCallColumns(): string
    {
        /*
         * These columns are defined here: https://blueskyapi.io/docs/data
         * We are only interested in a few of them, so we will only request those
         * You can add additional columns here if you want to use them in the future
         */
        return implode(',', [
            'apparent_temperature_at_2m',
            'relative_humidity_at_2m',
            'categorical_rain_at_surface',
            'categorical_snow_at_surface',
            'pressure_at_max_wind',
            'pressure_at_surface',
            'visibility_at_surface',
            'wind_speed_gust_at_surface'
        ]);
    }
}
