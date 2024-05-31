<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrentWeatherRequest;
use App\Http\Requests\PastWeatherRequest;
use App\Weather\WeatherFactory;
use Carbon\Carbon;

class WeatherController extends Controller
{
    public function current(CurrentWeatherRequest $request): array
    {
        $provider = WeatherFactory::create(config('weather.default'));
        $provider->setLocation($request->input('lat'), $request->input('lon'));

        $weatherData = $this->processWeatherData(json_decode(
            $provider->current(),
            true,
            512,
            JSON_THROW_ON_ERROR
        ));
        return $provider->getAdapter()::convert($weatherData);
    }

    public function past(PastWeatherRequest $request): array
    {
        $provider = WeatherFactory::create(config('weather.default'));
        $provider->setLocation($request->input('lat'), $request->input('lon'));

        $date = Carbon::createFromFormat(PastWeatherRequest::DATE_FORMAT, $request->input('date'));
        $weatherData = $this->processWeatherData(json_decode(
            $provider->past($date->endOfDay(), $date->startOfDay()),
            true,
            512,
            JSON_THROW_ON_ERROR
        ));
        return $provider->getAdapter()::convert($weatherData);
    }

    private function ProcessWeatherData(array $weatherData): array
    {
        // We only want the weather data in the immediate location provided
        return array_slice($weatherData, 0, 1);
    }
}
