<?php

namespace Dipantry\Rajaongkir\Tests\Database;

use Dipantry\Rajaongkir\Models\ROCity;
use Dipantry\Rajaongkir\Models\ROSubDistrict;
use Dipantry\Rajaongkir\Tests\TestCase;
use Illuminate\Support\Facades\Config;

class ApiKeySeederTest extends TestCase
{
    public function testStarterAccessPro()
    {
        $this->loadStarterApi();
        Config::set('rajaongkir.package', 'pro');

        $this->artisan('rajaongkir:seed');

        $data = ROCity::all();
        $this->assertEmpty($data);
    }

    public function testProAccessStarter()
    {
        $this->loadProApi();
        Config::set('rajaongkir.package', 'starter');

        $this->artisan('rajaongkir:seed');

        $data = ROCity::all();
        $this->assertNotEmpty($data);
    }

    public function testWrongPackage()
    {
        $this->loadProApi();
        Config::set('rajaongkir.package', 'wrong');

        $this->artisan('rajaongkir:seed');

        $data = ROSubDistrict::all();
        $this->assertEmpty($data);
    }

    public function testWrongAPI()
    {
        $this->loadProApi();
        Config::set('rajaongkir.api_key', 'wrong');

        $this->artisan('rajaongkir:seed');

        $data = ROSubDistrict::all();
        $this->assertEmpty($data);
    }
}
