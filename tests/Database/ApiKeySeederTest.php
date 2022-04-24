<?php

namespace Dipantry\Rajaongkir\Tests\Database;

use Dipantry\Rajaongkir\Models\ROProvince;
use Dipantry\Rajaongkir\Tests\TestCase;
use Illuminate\Support\Facades\Config;

class ApiKeySeederTest extends TestCase
{
    public function testStarterAccessPro()
    {
        $this->loadStarterApi();
        Config::set('rajaongkir.package', 'pro');

        $this->artisan('rajaongkir:seed');

        $provinces = ROProvince::all();
        $this->assertEmpty($provinces);
    }

    public function testProAccessStarter()
    {
        $this->loadProApi();
        Config::set('rajaongkir.package', 'starter');

        $this->artisan('rajaongkir:seed');

        $provinces = ROProvince::all();
        $this->assertNotEmpty($provinces);
    }
}
