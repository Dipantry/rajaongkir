<?php

namespace Dipantry\Rajaongkir\Tests\Http\Pro;

use Dipantry\Rajaongkir\Exception\ApiResponseException;
use Dipantry\Rajaongkir\Models\RajaongkirCourier;
use Dipantry\Rajaongkir\RajaongkirService;
use Dipantry\Rajaongkir\Tests\TestCase;
use Exception;

class WaybillTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->loadProApi();
    }

    /* @throws ApiResponseException */
    public function testWaybillSuccess()
    {
        $response = (new RajaongkirService())
            ->getWaybill('003013007979', RajaongkirCourier::SICEPAT);
        $this->assertNotEmpty($response);
    }

    public function testWaybillWrongData()
    {
        $response = null;

        try {
            $response = (new RajaongkirService())
                ->getWaybill('SOCAG00183235715', RajaongkirCourier::JNE);
        } catch (Exception $e) {
            $this->assertEquals(400, $e->getCode());
            $this->assertNotEmpty($e->getMessage());
        }
        $this->assertEmpty($response);
    }
}
