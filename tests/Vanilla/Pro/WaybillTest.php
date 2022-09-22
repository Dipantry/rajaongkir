<?php

namespace Dipantry\Rajaongkir\Tests\Vanilla\Pro;

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
        $this->loadProApi();
    }

    /* @throws ApiResponseException */
    public function testWaybillSuccess()
    {
        $response = $this->rajaongkir
            ->getWaybill('003013007979', RajaongkirCourier::SICEPAT);
        $this->assertNotEmpty($response);
    }

    public function testWaybillFailed()
    {
        $response = null;

        try {
            $response = $this->rajaongkir
                ->getWaybill('SOCAG00183235715', RajaongkirCourier::JNE);
        } catch (Exception $e) {
            $this->assertEquals(400, $e->getCode());
            $this->assertNotEmpty($e->getMessage());
        }
        $this->assertEmpty($response);
    }
}
