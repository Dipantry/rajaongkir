<?php

namespace Dipantry\Rajaongkir\Tests\Model;

use Dipantry\Rajaongkir\Models\ROCity;
use Dipantry\Rajaongkir\Models\ROProvince;
use Dipantry\Rajaongkir\Models\ROSubDistrict;
use Dipantry\Rajaongkir\Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;

class CityTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->loadProApi();
    }

    public function testCityHasManySubDistricts()
    {
        $this->seed($this->citySeeder);
        $this->seed($this->subDistrictSeeder);

        $city = ROCity::first();

        $this->assertInstanceOf(Collection::class, $city->subDistricts);
        $this->assertInstanceOf(ROSubDistrict::class, $city->subDistricts->first());
    }

    public function testCityHasProvince()
    {
        $this->seed($this->provinceSeeder);
        $this->seed($this->citySeeder);

        $city = ROCity::first();

        $this->assertInstanceOf(ROProvince::class, $city->province);
        $this->assertEquals($city->province_id, $city->province->id);
    }

    public function testCityHasAttributes()
    {
        $this->seed($this->citySeeder);

        $city = ROCity::first();

        $this->assertEquals('Aceh Barat', $city->name);
        $this->assertEquals('23681', $city->postal_code);
        $this->assertEquals('Kabupaten', $city->type);
    }
}
