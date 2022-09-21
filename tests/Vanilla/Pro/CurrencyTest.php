<?php

namespace Dipantry\Rajaongkir\Tests\Vanilla\Pro;

use Dipantry\Rajaongkir\Exception\ApiResponseException;
use Dipantry\Rajaongkir\Tests\VanillaTestCase;

class CurrencyTest extends VanillaTestCase
{
    /* @throws ApiResponseException */
    public function setUp(): void
    {
        parent::setUp();
        $this->loadProApi();
    }

    /* @throws ApiResponseException */
    public function testGetCurrency()
    {
        $response = $this->rajaongkir->getCurrency();
        $this->assertNotEmpty($response);
    }
}
