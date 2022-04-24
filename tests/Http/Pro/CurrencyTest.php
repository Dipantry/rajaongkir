<?php

namespace Dipantry\Rajaongkir\Tests\Http\Pro;

use Dipantry\Rajaongkir\RajaongkirService;
use Dipantry\Rajaongkir\Tests\TestCase;

class CurrencyTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->loadProApi();
    }

    public function testGetCurrency()
    {
        $response = (new RajaongkirService())
            ->getCurrency();
        $this->assertNotEmpty($response);
    }
}