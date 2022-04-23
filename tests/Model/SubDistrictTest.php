<?php

namespace Dipantry\Rajaongkir\Tests\Model;

use Dipantry\Rajaongkir\Models\ROCity;
use Dipantry\Rajaongkir\Models\ROSubDistrict;
use Dipantry\Rajaongkir\Tests\TestCase;
use Dipantry\Rajaongkir\Tests\TestingConfigData;

class SubDistrictTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        TestingConfigData::loadProAPI();
    }

    public function testSubDistrictHasCity()
    {
        $this->seed($this->subDistrictSeeder);
        $this->seed($this->citySeeder);

        $subDistrict = ROSubDistrict::first();

        $this->assertInstanceOf(ROCity::class, $subDistrict->city);
        $this->assertEquals($subDistrict->city_id, $subDistrict->city->id);
    }

    public function testSubDistrictAttributes()
    {
        $this->seed($this->subDistrictSeeder);

        $subDistrict = ROSubDistrict::first();

        $this->assertEquals('Arongan Lambalek', $subDistrict->name);
    }
}