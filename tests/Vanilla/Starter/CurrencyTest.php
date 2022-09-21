<?php

namespace Dipantry\Rajaongkir\Tests\Vanilla\Starter;

use Dipantry\Rajaongkir\Exception\ApiResponseException;
use Dipantry\Rajaongkir\Tests\VanillaTestCase;
use Exception;

class CurrencyTest extends VanillaTestCase
{
    /* @throws ApiResponseException */
    public function setUp(): void
    {
        parent::setUp();
        $this->loadStarterApi();
    }

    public function testGetCurrency()
    {
        $response = null;

        try {
            $response = $this->rajaongkir->getCurrency();
        } catch (Exception $e) {
            $this->assertEquals(400, $e->getCode());
            $this->assertNotEmpty($e->getMessage());
        }
        $this->assertEmpty($response);
    }
}
