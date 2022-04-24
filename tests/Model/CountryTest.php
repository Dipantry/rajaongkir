<?php

namespace Dipantry\Rajaongkir\Tests\Model;

use Dipantry\Rajaongkir\Models\ROCountry;
use Dipantry\Rajaongkir\Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;

class CountryTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->loadProApi();
    }

    public function testCountries()
    {
        $this->seed($this->countrySeeder);

        $countries = ROCountry::all();

        $this->assertInstanceOf(Collection::class, $countries);
        $this->assertInstanceOf(ROCountry::class, $countries->first());
    }

    public function testCountryHasAttribute()
    {
        $this->seed($this->countrySeeder);

        $country = ROCountry::first();

        $this->assertEquals('Acores Et Madere', $country->name);
    }
}
