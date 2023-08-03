<?php

namespace App\Weather\Adapters;

use Illuminate\Support\Arr;

final class BlueSky implements WeatherAdapterInterface
{

    public static function convert(array $data) : array
    {
        return Arr::map($data, static function ($value, $key) {
            return [
                'temperature' => round($value['apparent_temperature_at_2m'], self::ROUNDED_DECIMALS ) . ' K',
                'humidity' => round($value["relative_humidity_at_2m"], self::ROUNDED_DECIMALS) . ' %',
                'raining' => $value["categorical_rain_at_surface"] ? 'Yes' : 'No',
                'snowing' => $value["categorical_snow_at_surface"] ? 'Yes' : 'No',
                'pressure' => round($value["pressure_at_surface"], self::ROUNDED_DECIMALS) . ' hPa',
                'visibility' => $value["visibility_at_surface"] . ' m',
                'wind speed' => round($value["wind_speed_gust_at_surface"], self::ROUNDED_DECIMALS) . ' m/s',
            ];
        });
    }
}
