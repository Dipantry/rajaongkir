<?php

namespace Dipantry\Rajaongkir\Tests\Http\Starter;

use Dipantry\Rajaongkir\Models\RajaongkirCourier;
use Dipantry\Rajaongkir\RajaongkirService;
use Dipantry\Rajaongkir\Tests\TestCase;
use Exception;

class InternationalCostTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->loadStarterApi();
    }

    public function testGetInternationalCost()
    {
        $response = null;

        try {
            $response = (new RajaongkirService())
                ->getInternationalOngkirCost(1, 200, 300, RajaongkirCourier::JNE);
        } catch (Exception $e) {
            $this->assertEquals(400, $e->getCode());
            $this->assertNotEmpty($e->getMessage());
        }
        $this->assertEmpty($response);
    }
}
