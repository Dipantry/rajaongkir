<?php

namespace Dipantry\Rajaongkir\Tests\Database;

use Dipantry\Rajaongkir\Models\ROCity;
use Dipantry\Rajaongkir\Models\ROCountry;
use Dipantry\Rajaongkir\Models\ROSubDistrict;
use Dipantry\Rajaongkir\Tests\TestCase;
use Dipantry\Rajaongkir\Tests\TestingConfigData;
use Illuminate\Support\Facades\Config;

class DatabaseTest extends TestCase
{
    public function testStarterDatabaseSeed(){
        TestingConfigData::loadStarterAPI();
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

    public function testProDatabaseSeed(){
        TestingConfigData::loadProAPI();
        Config::set('rajaongkir.package', 'pro');
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