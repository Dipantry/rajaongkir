<?php

namespace Dipantry\Rajaongkir\Tests\Model;

use Dipantry\Rajaongkir\Models\ROCity;
use Dipantry\Rajaongkir\Models\ROProvince;
use Dipantry\Rajaongkir\Models\ROSubDistrict;
use Dipantry\Rajaongkir\Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;

class ProvinceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->loadProApi();
    }

    public function testProvinceHasManyCities()
    {
        $this->seed($this->provinceSeeder);
        $this->seed($this->citySeeder);

        $province = ROProvince::first();

        $this->assertInstanceOf(Collection::class, $province->cities);
        $this->assertInstanceOf(ROCity::class, $province->cities->first());
    }

    public function testProvinceHasManySubDistricts()
    {
        $this->seed($this->provinceSeeder);
        $this->seed($this->citySeeder);
        $this->seed($this->subDistrictSeeder);

        $province = ROProvince::first();

        $this->assertInstanceOf(Collection::class, $province->subDistricts);
        $this->assertInstanceOf(ROSubDistrict::class, $province->subDistricts->first());
    }

    public function testProvinceHasAttribute()
    {
        $this->seed($this->provinceSeeder);

        $province = ROProvince::first();

        $this->assertEquals('Bali', $province->name);
    }
}
