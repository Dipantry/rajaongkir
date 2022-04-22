<?php

namespace Dipantry\Rajaongkir\Tests\Http\Pro;

use Dipantry\Rajaongkir\Models\RajaongkirCourier;
use Dipantry\Rajaongkir\Rajaongkir;
use Dipantry\Rajaongkir\Tests\TestCase;
use Dipantry\Rajaongkir\Tests\TestingConfigData;

class LocalCostTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        TestingConfigData::loadProAPI();
    }

    public function testGetCostSuccess()
    {
        $response = (new Rajaongkir())
            ->getOngkirCost(1, 500, 300, RajaongkirCourier::JNE);
        $this->assertNotEmpty($response);
    }

    public function testGetCostSubDistrictSuccess()
    {
        $response = (new Rajaongkir())
            ->getOngkirCost(1, 500, 300, RajaongkirCourier::JNE,
                'subdistrict', 'subdistrict');
        $this->assertNotEmpty($response);
    }

    public function testCostOtherCourier()
    {
        $response = (new Rajaongkir())
            ->getOngkirCost(1, 500, 300, RajaongkirCourier::LION_PARCEL);
        $this->assertNotEmpty($response);
    }

    public function testGetCostUnknownCourier()
    {
        $response = null;
        try {
            $response = (new Rajaongkir())
                ->getOngkirCost(1, 500, 300, "Lorem Ipsum");
        } catch (\Exception $e) {
            $this->assertEquals(400, $e->getCode());
            $this->assertNotEmpty($e->getMessage());
        }
        $this->assertEmpty($response);
    }
}