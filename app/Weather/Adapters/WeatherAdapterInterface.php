<?php

namespace App\Weather\Adapters;

interface WeatherAdapterInterface
{
    const ROUNDED_DECIMALS = 2;
    public static function convert(array $data): array;
}
