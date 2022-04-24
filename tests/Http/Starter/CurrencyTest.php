<?php

namespace Dipantry\Rajaongkir\Tests\Http\Starter;

use Dipantry\Rajaongkir\RajaongkirService;
use Dipantry\Rajaongkir\Tests\TestCase;
use Exception;

class CurrencyTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->loadStarterApi();
    }

    public function testGetCurrency()
    {
        $response = null;

        try {
            $response = (new RajaongkirService())
                ->getCurrency();
        } catch (Exception $e) {
            $this->assertEquals(400, $e->getCode());
            $this->assertNotEmpty($e->getMessage());
        }
        $this->assertEmpty($response);
    }
}
