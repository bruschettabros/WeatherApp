<?php

namespace Tests\Weather\Consumers;

use App\Weather\Adapters\BlueSky as BlueSkyAdapter;
use App\Weather\Consumers\BlueSky;
use App\Weather\Exceptions\LocationNotSetException;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class BlueSkyTest extends TestCase
{
    private BlueSky $blueSky;

    public function setUp(): void
    {
        parent::setUp();
        $this->blueSky = new BlueSky('test');
    }

    public function testConsumerName() : void
    {
        $this->assertEquals('BlueSky', BlueSky::getConsumerName());
    }

    public function testSetAdapterName(): void
    {
        $this->assertEquals(BlueSkyAdapter::class, $this->blueSky->getAdapter());
    }

    public function testLocationsNotSetException(): void
    {
        $this->expectException(LocationNotSetException::class);
        $this->expectExceptionMessage('Location not set');

        $this->blueSky->current();
    }
}
