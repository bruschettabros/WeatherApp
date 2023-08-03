<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeatherRequest;
use App\Weather\Consumers\AbstractWeatherConsumer;
use App\Weather\WeatherFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Arr;

class WeatherController extends Controller
{
    public function current(WeatherRequest $request): array
    {
        $provider = WeatherFactory::create(config('weather.default'));
        $provider->setLocation($request->input('lat'), $request->input('lon'));
        // We only want the weather data in the immediate location provided
        $weatherData = $this->processWeatherData(json_decode($provider->current(), true));
        return $provider->getAdapter()::convert($weatherData);
    }

    private function ProcessWeatherData(array $weatherData): array
    {
        // We only want the weather data in the immediate location provided
        return array_slice($weatherData, 0, 1);
    }
}
