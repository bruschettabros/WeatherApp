<?php

namespace Tests\Weather;

use App\Weather\Consumers\BlueSky;
use App\Weather\Exceptions\WeatherConsumerNotFound;
use App\Weather\WeatherFactory;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class WeatherFactoryTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        Config::set('weather.providers.BlueSky', [
            'class'  => BlueSky::class,
            'apiKey' => 'test',
        ]);
    }

    public function testGenerateObject() : void
    {
        $this->assertInstanceOf(BlueSky::class, WeatherFactory::create(BlueSky::getConsumerName()));
    }

    public function testCannotGenerateObject() : void
    {
        $this->ExpectException(WeatherConsumerNotFound::class);
        $this->expectExceptionMessage('Weather consumer FAKE_PROVIDER not found');
        WeatherFactory::create('FAKE_PROVIDER');
    }
}
