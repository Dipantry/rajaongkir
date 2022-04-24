<?php

namespace Dipantry\Rajaongkir\Tests\Http\Pro;

use Dipantry\Rajaongkir\Exception\ApiResponseException;
use Dipantry\Rajaongkir\Models\RajaongkirCourier;
use Dipantry\Rajaongkir\RajaongkirService;
use Dipantry\Rajaongkir\Tests\TestCase;
use Exception;

class LocalCostTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->loadProApi();
    }

    /* @throws ApiResponseException */
    public function testGetCostSuccess()
    {
        $response = (new RajaongkirService())
            ->getOngkirCost(1, 500, 300, RajaongkirCourier::JNE);
        $this->assertNotEmpty($response);
    }

    /* @throws ApiResponseException */
    public function testGetCostSubDistrictSuccess()
    {
        $response = (new RajaongkirService())
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
        $response = (new RajaongkirService())
            ->getOngkirCost(1, 500, 300, RajaongkirCourier::LION_PARCEL);
        $this->assertNotEmpty($response);
    }

    public function testGetCostUnknownCourier()
    {
        $response = null;

        try {
            $response = (new RajaongkirService())
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
        $response = (new RajaongkirService())
            ->getOngkirCost(999, 500, 300, RajaongkirCourier::LION_PARCEL);
        $this->assertNotEmpty($response);
    }

    /* @throws ApiResponseException */
    public function testGetCostUnknownDestination()
    {
        $response = (new RajaongkirService())
            ->getOngkirCost(1, 999, 300, RajaongkirCourier::LION_PARCEL);
        $this->assertNotEmpty($response);
    }
}
