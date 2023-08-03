<?php

namespace Tests\Http\Controllers;

use App\Weather\Consumers\TestConsumer;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class WeatherControllerTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        Config::set('weather.providers.testProvider', [
            'class'  => TestConsumer::class,
            'apiKey' => 'test',
        ]);
        Config::set('weather.default', 'testProvider');
    }

    public function testCurrent() : void
    {
        $response = $this->Json('GET', '/api/weather/current', [
            'lat' => 50,
            'lon' => -1,
        ]);

        $response->assertStatus(200);
        $response->assertJsonCount(7, 'data');
        $response->assertJson(['data' => [
            'temperature' => "290.47 K",
            "humidity"    => "98.16 %",
            "raining"     => "Yes",
            "snowing"     => "No",
            "pressure"    => "99520 hPa",
            "visibility"  => "2003 m",
            "wind speed"  => "15.49 m/s",
        ]]);
    }

    public function testPast() : void
    {
        $response = $this->Json('GET', '/api/weather/past', [
            'lat'  => 50,
            'lon'  => -1,
            'date' => '01/08/2023',
        ]);

        $response->assertStatus(200);
        $response->assertJsonCount(7, 'data');
        $response->assertJson(['data' => [
            'temperature' => "290.47 K",
            "humidity"    => "98.16 %",
            "raining"     => "Yes",
            "snowing"     => "No",
            "pressure"    => "99520 hPa",
            "visibility"  => "2003 m",
            "wind speed"  => "15.49 m/s",
        ]]);
    }

    public function testLatAndLonRequired() : void
    {
        $response = $this->Json('GET', '/api/weather/current', [
        ]);
        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'The lat field is required. (and 1 more error)',
            'errors'  => [
                'lat' => [
                    'The lat field is required.',
                ],
                'lon' => [
                    'The lon field is required.',
                ],
            ],
        ]);
    }

    public function testDateRequired() : void
    {
        $response = $this->Json('GET', '/api/weather/past', [
            'lat' => 50,
            'lon' => -1,
        ]);
        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'The date field is required.',
            'errors'  => [
                'date' => [
                    'The date field is required.',
                ],
            ],
        ]);

        $response = $this->Json('GET', '/api/weather/past', [
            'lat'  => 50,
            'lon'  => -1,
            'date' => '2021-01-01', // Incorrect format
        ]);
        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'The date field must match the format d/m/Y.',
            'errors'  => [
                'date' => [
                    'The date field must match the format d/m/Y.',
                ],
            ],
        ]);
    }
}
