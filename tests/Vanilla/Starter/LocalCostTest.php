<?php

namespace Dipantry\Rajaongkir\Tests\Vanilla\Starter;

use Dipantry\Rajaongkir\Constants\RajaongkirCourier;
use Dipantry\Rajaongkir\Exception\ApiResponseException;
use Dipantry\Rajaongkir\Tests\VanillaTestCase;
use Exception;

class LocalCostTest extends VanillaTestCase
{
    /* @throws ApiResponseException */
    public function setUp(): void
    {
        parent::setUp();
        $this->loadStarterApi();
    }

    /* @throws ApiResponseException */
    public function testGetCostSuccess()
    {
        $response = $this->rajaongkir
            ->getOngkirCost(1, 500, 300, RajaongkirCourier::JNE);
        $this->assertNotEmpty($response);
    }

    public function testGetCostOtherCourier()
    {
        $response = null;

        try {
            $response = $this->rajaongkir
                ->getOngkirCost(1, 500, 300, RajaongkirCourier::LION_PARCEL);
        } catch (Exception $e) {
            $this->assertEquals(400, $e->getCode());
            $this->assertNotEmpty($e->getMessage());
        }
        $this->assertEmpty($response);
    }

    public function testGetCostUnknownCourier()
    {
        $response = null;

        try {
            $response = $this->rajaongkir
                ->getOngkirCost(1, 500, 300, 'Lorem Ipsum');
        } catch (Exception $e) {
            $this->assertEquals(400, $e->getCode());
            $this->assertNotEmpty($e->getMessage());
        }
        $this->assertEmpty($response);
    }

    public function testGetCostUnknownOrigin()
    {
        $response = null;

        try {
            $response = $this->rajaongkir
                ->getOngkirCost(999, 500, 300, RajaongkirCourier::JNE);
        } catch (Exception $e) {
            $this->assertEquals(500, $e->getCode());
            $this->assertNotEmpty($e->getMessage());
        }
        $this->assertEmpty($response);
    }

    public function testGetCostUnknownDestination()
    {
        $response = null;

        try {
            $response = $this->rajaongkir
                ->getOngkirCost(1, 999, 300, RajaongkirCourier::JNE);
        } catch (Exception $e) {
            $this->assertEquals(500, $e->getCode());
            $this->assertNotEmpty($e->getMessage());
        }
        $this->assertEmpty($response);
    }
}
