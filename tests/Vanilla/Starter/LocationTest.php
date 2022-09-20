<?php

namespace Dipantry\Rajaongkir\Tests\Vanilla\Starter;

use Dipantry\Rajaongkir\Exception\ApiResponseException;
use Dipantry\Rajaongkir\Tests\VanillaTestCase;
use Exception;

class LocationTest extends VanillaTestCase
{
    /** @throws ApiResponseException */
    public function setUp(): void
    {
        parent::setUp();
        $this->loadStarterApi();
    }

    /** @throws ApiResponseException */
    public function testGetProvince()
    {
        $response = $this->rajaongkir->getProvince();
        $this->assertNotEmpty($response);
        $this->assertSame(sizeof($response), 34);

        $this->assertSame($response[0]['province'], 'Bali');
    }

    /** @throws ApiResponseException */
    public function testGetProvinceWithId()
    {
        $response = $this->rajaongkir->getProvince(1);
        $this->assertNotEmpty($response);

        $this->assertSame($response['province'], 'Bali');
    }

    /** @throws ApiResponseException */
    public function testGetProvinceFailed()
    {
        $response = $this->rajaongkir->getProvince(100);
        $this->assertEmpty($response);
    }

    /** @throws ApiResponseException */
    public function testGetCity()
    {
        $response = $this->rajaongkir->getCity();
        $this->assertNotEmpty($response);
        $this->assertSame(sizeof($response), 501);

        $this->assertSame($response[0]['city_name'], 'Aceh Barat');
    }

    /** @throws ApiResponseException */
    public function testGetCityWithProvinceId()
    {
        $response = $this->rajaongkir->getCity(provinceId: 1);
        $this->assertNotEmpty($response);
        $this->assertSame(sizeof($response), 9);

        $this->assertSame($response[0]['city_name'], 'Badung');
    }

    /** @throws ApiResponseException */
    public function testGetCityWithId()
    {
        $response = $this->rajaongkir->getCity(cityId: 1);
        $this->assertNotEmpty($response);

        $this->assertSame($response['city_name'], 'Aceh Barat');
    }

    /** @throws ApiResponseException */
    public function testGetCityWithTwoParameters()
    {
        $response = $this->rajaongkir->getCity(13, 23);
        $this->assertNotEmpty($response);

        $this->assertSame($response['city_name'], 'Alor');
    }

    /** @throws ApiResponseException */
    public function testGetCityFailed()
    {
        $response = $this->rajaongkir->getCity(cityId: 999);
        $this->assertEmpty($response);
    }

    public function testGetSubDistrict()
    {
        $response = null;
        try {
            $response = $this->rajaongkir->getSubDistrict(1);
        } catch (Exception $e){
            $this->assertEquals(400, $e->getCode());
            $this->assertNotEmpty($e->getMessage());
        }
        $this->assertEmpty($response);
    }
}