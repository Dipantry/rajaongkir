<?php

namespace Dipantry\Rajaongkir\Tests\Http;

use Dipantry\Rajaongkir\Models\RajaongkirCourier;
use Dipantry\Rajaongkir\Rajaongkir;
use Dipantry\Rajaongkir\Tests\TestCase;
use Dipantry\Rajaongkir\Tests\TestingConfigData;

class LocalCostTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        TestingConfigData::loadStarterAPI();
    }

    public function testGetCostSuccess()
    {
        $response = (new Rajaongkir())
            ->getOngkirCost(1, 500, 300, RajaongkirCourier::JNE);
        $this->assertNotEmpty($response);
    }

    public function testGetCostOtherCourier()
    {
        $response = null;
        try {
            $response = (new Rajaongkir())
                ->getOngkirCost(1, 500, 300, RajaongkirCourier::LION_PARCEL);
        } catch (\Exception $e) {
            $this->assertEquals(400, $e->getCode());
            $this->assertNotEmpty($e->getMessage());
        }
        $this->assertEmpty($response);
    }
}