<?php

namespace Dipantry\Rajaongkir\Tests\Vanilla\Pro;

use Dipantry\Rajaongkir\Exception\ApiResponseException;
use Dipantry\Rajaongkir\Models\RajaongkirCourier;
use Dipantry\Rajaongkir\Tests\VanillaTestCase;
use Exception;

class LocalCostTest extends VanillaTestCase
{
    /* @throws ApiResponseException */
    public function setUp(): void
    {
        parent::setUp();
        $this->loadProApi();
    }

    /* @throws ApiResponseException */
    public function testGetCostSuccess()
    {
        $response = $this->rajaongkir
            ->getOngkirCost(1, 500, 300, RajaongkirCourier::JNE);
        $this->assertNotEmpty($response);
    }

    /* @throws ApiResponseException */
    public function testGetCostSubDistrictSuccess()
    {
        $response = $this->rajaongkir
            ->getOngkirCost(
                1,
                500,
                300,
                RajaongkirCourier::JNE,
                'subdistrict',
                'subdistrict'
            );
        $this->assertNotEmpty($response);
    }

    /* @throws ApiResponseException */
    public function testCostOtherCourier()
    {
        $response = $this->rajaongkir
            ->getOngkirCost(1, 500, 300, RajaongkirCourier::LION_PARCEL);
        $this->assertNotEmpty($response);
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

    /* @throws ApiResponseException */
    public function testGetCostUnknownOrigin()
    {
        $response = $this->rajaongkir
            ->getOngkirCost(999, 500, 300, RajaongkirCourier::LION_PARCEL);
        $this->assertNotEmpty($response);
    }

    /* @throws ApiResponseException */
    public function testGetCostUnknownDestination()
    {
        $response = $this->rajaongkir
            ->getOngkirCost(1, 999, 300, RajaongkirCourier::LION_PARCEL);
        $this->assertNotEmpty($response);
    }
}
