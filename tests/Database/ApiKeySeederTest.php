<?php

namespace Dipantry\Rajaongkir\Tests\Database;

use Dipantry\Rajaongkir\Models\ROProvince;
use Dipantry\Rajaongkir\Tests\TestCase;
use Dipantry\Rajaongkir\Tests\TestingConfigData;
use Illuminate\Support\Facades\Config;

class ApiKeySeederTest extends TestCase
{
    public function testStarterAccessPro()
    {
        TestingConfigData::loadStarterAPI();
        Config::set('rajaongkir.package', 'pro');

        $this->artisan('rajaongkir:seed');

        $provinces = ROProvince::all();
        $this->assertEmpty($provinces);
    }

    public function testProAccessStarter()
    {
        TestingConfigData::loadProAPI();
        Config::set('rajaongkir.package', 'starter');

        $this->artisan('rajaongkir:seed');

        $provinces = ROProvince::all();
        $this->assertNotEmpty($provinces);
    }
}