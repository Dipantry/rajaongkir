<?php

namespace Dipantry\Rajaongkir\Tests\Http\Starter;

use Dipantry\Rajaongkir\Models\RajaongkirCourier;
use Dipantry\Rajaongkir\RajaongkirService;
use Dipantry\Rajaongkir\Tests\TestCase;
use Exception;

class WaybillTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->loadStarterApi();
    }

    public function testWaybill()
    {
        $response = null;

        try {
            $response = (new RajaongkirService())
                ->getWaybill('003013007979', RajaongkirCourier::SICEPAT);
        } catch (Exception $e) {
            $this->assertEquals(400, $e->getCode());
            $this->assertNotEmpty($e->getMessage());
        }
        $this->assertEmpty($response);
    }
}
