<?php

namespace Dipantry\Rajaongkir\Tests\Http\Pro;

use Dipantry\Rajaongkir\Models\RajaongkirCourier;
use Dipantry\Rajaongkir\Rajaongkir;
use Dipantry\Rajaongkir\Tests\TestCase;
use Dipantry\Rajaongkir\Tests\TestingConfigData;

class InternationalCostTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        TestingConfigData::loadProAPI();
    }

    public function testGetInternationalCost()
    {
        $response = (new Rajaongkir())
            ->getInternationalOngkirCost(1, 200, 300, RajaongkirCourier::JNE);
        $this->assertNotEmpty($response);
    }

    public function testGetInternationalCostUnknownCourier()
    {
        $response = null;
        try {
            $response = (new Rajaongkir())
                ->getInternationalOngkirCost(1, 200, 300, "U");
        } catch (\Exception $e) {
            $this->assertEquals(400, $e->getCode());
            $this->assertNotEmpty($e->getMessage());
        }
        $this->assertEmpty($response);
    }

    public function testGetInternationalCostUnknownOrigin()
    {
        $response = (new Rajaongkir())
            ->getInternationalOngkirCost(999, 200, 300, RajaongkirCourier::JNE);
        $this->assertNotEmpty($response);
    }

    public function testGetInternationalCostUnknownDestination()
    {
        $response = (new Rajaongkir())
            ->getInternationalOngkirCost(1, 999, 300, RajaongkirCourier::JNE);
        $this->assertNotEmpty($response);
    }
}