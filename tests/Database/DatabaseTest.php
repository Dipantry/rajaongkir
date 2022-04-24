<?php

namespace Dipantry\Rajaongkir\Tests\Database;

use Dipantry\Rajaongkir\Models\ROCity;
use Dipantry\Rajaongkir\Models\ROCountry;
use Dipantry\Rajaongkir\Models\ROSubDistrict;
use Dipantry\Rajaongkir\Tests\TestCase;

class DatabaseTest extends TestCase
{
    public function testStarterDatabaseSeed()
    {
        $this->loadStarterApi();
        $this->artisan('rajaongkir:seed');

        $cities = ROCity::all();
        $this->assertNotEmpty($cities);

        $subDistricts = ROSubDistrict::all();
        $this->assertEmpty($subDistricts);

        $citySubDistricts = ROCity::first()->subDistricts;
        $this->assertEmpty($citySubDistricts);

        $countries = ROCountry::all();
        $this->assertEmpty($countries);
    }

//    public function testBasicDatabaseSeed(){
//        Config::set('rajaongkir.package', 'basic');
//        $this->artisan('rajaongkir:seed');
//
//        $cities = ROCity::all();
//        $this->assertNotEmpty($cities);
//
//        $subDistricts = ROSubDistrict::all();
//        $this->assertEmpty($subDistricts);
//
//        $citySubDistricts = ROCity::first()->subDistricts;
//        $this->assertEmpty($citySubDistricts);
//
//        $countries = ROCountry::all();
//        $this->assertNotEmpty($countries);
//    }

    public function testProDatabaseSeed()
    {
        $this->loadProApi();
        $this->artisan('rajaongkir:seed');

        $cities = ROCity::all();
        $this->assertNotEmpty($cities);

        $subDistricts = ROSubDistrict::all();
        $this->assertNotEmpty($subDistricts);

        $citySubDistricts = ROCity::first()->subDistricts;
        $this->assertNotEmpty($citySubDistricts);

        $countries = ROCountry::all();
        $this->assertNotEmpty($countries);
    }
}
