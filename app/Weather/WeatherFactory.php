<?php

namespace App\Weather;

use App\Weather\Consumers\AbstractWeatherConsumer;
use App\Weather\Exceptions\WeatherConsumerNotFound;

class WeatherFactory
{
    /**
     * Will generate a WeatherConsumer based on the provided string, or fallback to the default consumer
     *
     * @param string|null $weatherConsumer
     * @throws WeatherConsumerNotFound
     */
    public static function create(string|null $weatherConsumer = null) : AbstractWeatherConsumer
    {
        $weatherConfig = config(sprintf('weather.providers.%s', $weatherConsumer)) ?? config('weather.default');

        if (!$weatherConfig || !isset($weatherConfig['class'])) {
            throw new WeatherConsumerNotFound(sprintf('Weather consumer %s not found', $weatherConsumer));
        }

        return new $weatherConfig['class'](...self::generateConfig($weatherConfig));
    }

    private static function generateConfig(array $config) : array
    {
        unset($config['class']);

        return $config;
    }
}
