<?php

namespace Dipantry\Rajaongkir\Tests\Vanilla\Pro;

use Dipantry\Rajaongkir\Exception\ApiResponseException;
use Dipantry\Rajaongkir\Models\RajaongkirCourier;
use Dipantry\Rajaongkir\Tests\VanillaTestCase;
use Exception;

class InternationalCostTest extends VanillaTestCase
{
    /** @throws ApiResponseException */
    public function setUp(): void
    {
        parent::setUp();
        $this->loadProApi();
    }

    /** @throws ApiResponseException */
    public function testGetInternationalCost()
    {
        $response = $this->rajaongkir
            ->getInternationalOngkirCost(1, 200, 300, RajaongkirCourier::JNE);
        $this->assertNotEmpty($response);
    }

    public function testGetInternationalCostUnknownCourier()
    {
        $response = null;

        try {
            $response = $this->rajaongkir
                ->getInternationalOngkirCost(1, 200, 300, 'U');
        } catch (Exception $e) {
            $this->assertEquals(400, $e->getCode());
            $this->assertNotEmpty($e->getMessage());
        }
        $this->assertEmpty($response);
    }

    /** @throws ApiResponseException */
    public function testGetInternationalCostUnknownOrigin()
    {
        $response = $this->rajaongkir
            ->getInternationalOngkirCost(999, 200, 300, RajaongkirCourier::JNE);
        $this->assertNotEmpty($response);
    }

    /** @throws ApiResponseException */
    public function testGetInternationalCostUnknownDestination()
    {
        $response = $this->rajaongkir
            ->getInternationalOngkirCost(1, 999, 300, RajaongkirCourier::JNE);
        $this->assertNotEmpty($response);
    }
}