<?php

namespace Dipantry\Rajaongkir\Tests\Exception;

use Dipantry\Rajaongkir\Exception\ApiResponseException;
use Dipantry\Rajaongkir\Models\RajaongkirCourier;
use Dipantry\Rajaongkir\RajaongkirService;
use Dipantry\Rajaongkir\Tests\TestCase;
use Exception;
use Illuminate\Support\Facades\Config;

class ApiResponseExceptionTest extends TestCase
{
    public function testApiEmpty()
    {
        Config::set('rajaongkir.api_key', '');
        Config::set('rajaongkir.package', 'pro');

        try {
            (new RajaongkirService())->getOngkirCost(1, 99, 300, RajaongkirCourier::JNE);
        } catch (Exception $e) {
            $this->assertInstanceOf(ApiResponseException::class, $e);
            $this->assertEquals('API Key not specified', $e->getMessage());
        }
    }

    public function testPackageEmpty()
    {
        $this->loadStarterApi();
        Config::set('rajaongkir.package', '');

        try {
            (new RajaongkirService())->getOngkirCost(1, 99, 300, RajaongkirCourier::JNE);
        } catch (Exception $e) {
            $this->assertInstanceOf(ApiResponseException::class, $e);
            $this->assertEquals('API Package not specified', $e->getMessage());
        }
    }

    public function testUnknownPackage()
    {
        $this->loadStarterApi();
        Config::set('rajaongkir.package', 'Lorem Ipsum');

        try {
            (new RajaongkirService())->getOngkirCost(1, 99, 300, RajaongkirCourier::JNE);
        } catch (Exception $e) {
            $this->assertInstanceOf(ApiResponseException::class, $e);
            $this->assertEquals('Unknown API Package', $e->getMessage());
        }
    }

    public function testConnectionTimeout()
    {
        $this->loadStarterApi();
        Config::set('rajaongkir.timeout', 1);

        try {
            (new RajaongkirService())->getOngkirCost(1, 99, 300, RajaongkirCourier::JNE);
        } catch (Exception $e) {
            $this->assertInstanceOf(ApiResponseException::class, $e);
            $this->assertEquals('Connection Timed Out', $e->getMessage());
        }
    }
}
