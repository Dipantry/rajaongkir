<?php

/** @noinspection PhpUndefinedClassInspection */

namespace Dipantry\Rajaongkir\Tests;

use Dipantry\Rajaongkir\Models\RajaongkirCourier;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Rajaongkir;

class ServiceTest extends TestCase
{
    use InteractsWithDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->loadProApi();
    }

    public function testGetLocalOngkirCost()
    {
        $results = Rajaongkir::getOngkirCost(1, 200, 300, RajaongkirCourier::JNE);
        $this->assertNotEmpty($results);
    }

    public function testGetInternationalOngkirCost()
    {
        $results = Rajaongkir::getInternationalOngkirCost(1, 200, 300, RajaongkirCourier::JNE);
        $this->assertNotEmpty($results);
    }

    public function testGetCurrency()
    {
        $result = Rajaongkir::getCurrency();
        $this->assertNotEmpty($result);
    }

    public function testGetWaybill()
    {
        $result = Rajaongkir::getWaybill('003013007979', RajaongkirCourier::SICEPAT);
        $this->assertNotEmpty($result);
    }
}
