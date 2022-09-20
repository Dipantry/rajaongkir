<?php

namespace Dipantry\Rajaongkir\Tests\Vanilla\Pro;

use Dipantry\Rajaongkir\Exception\ApiResponseException;
use Dipantry\Rajaongkir\Tests\VanillaTestCase;

class LocationTest extends VanillaTestCase
{
    /** @throws ApiResponseException */
    public function setUp(): void
    {
        parent::setUp();
        $this->loadProApi();
    }

    /** @throws ApiResponseException */
    public function testGetProvince()
    {
        $response = $this->rajaongkir->getProvince();
        $this->assertNotEmpty($response);
    }
}