<?php

namespace Tests\Weather\Consumers;

use App\Weather\Consumers\BlueSky;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class BlueSkyTest extends TestCase
{
    private $blueSky;

    public function setUp(): void
    {
        parent::setUp();
        $this->blueSky = new BlueSky('cfsSDpz96RXAaMGJIQcRaO429Nsy7cwC_OSdR3NZk91TsgilsA-dyCT6RmIxRLuBaCGTb4v4dL8h1sb88BH-pg');
    }

    public function testPing() : void
    {
        $ping = $this->blueSky->ping();
        $this->assertEquals(200, $ping->status());
    }

    public function testConsumerName() : void
    {
        $this->assertEquals('BlueSky', BlueSky::getConsumerName());
    }
}
