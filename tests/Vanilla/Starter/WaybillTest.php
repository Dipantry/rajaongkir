<?php

namespace Dipantry\Rajaongkir\Tests\Vanilla\Starter;

use Dipantry\Rajaongkir\Constants\RajaongkirCourier;
use Dipantry\Rajaongkir\Exception\ApiResponseException;
use Dipantry\Rajaongkir\Tests\VanillaTestCase;
use Exception;

class WaybillTest extends VanillaTestCase
{
    /* @throws ApiResponseException */
    public function setUp(): void
    {
        parent::setUp();
        $this->loadStarterApi();
    }

    public function testWaybill()
    {
        $response = null;

        try {
            $response = $this->rajaongkir
                ->getWaybill('003013007979', RajaongkirCourier::SICEPAT);
        } catch (Exception $e) {
            $this->assertEquals(400, $e->getCode());
            $this->assertNotEmpty($e->getMessage());
        }
        $this->assertEmpty($response);
    }
}
