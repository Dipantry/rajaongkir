<?php

namespace Dipantry\Rajaongkir\Tests\Vanilla\Starter;

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
        $this->loadStarterApi();
    }

    public function testGetInternationalCost()
    {
        $response = null;

        try {
            $response = $this->rajaongkir
                ->getInternationalOngkirCost(1, 200, 300, RajaongkirCourier::JNE);
        } catch (Exception $e) {
            $this->assertEquals(400, $e->getCode());
            $this->assertNotEmpty($e->getMessage());
        }
        $this->assertEmpty($response);
    }
}
