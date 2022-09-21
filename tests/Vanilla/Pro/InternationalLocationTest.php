<?php

namespace Dipantry\Rajaongkir\Tests\Vanilla\Pro;

use Dipantry\Rajaongkir\Exception\ApiResponseException;
use Dipantry\Rajaongkir\Tests\VanillaTestCase;

class InternationalLocationTest extends VanillaTestCase
{
    /* @throws ApiResponseException */
    public function setUp(): void
    {
        parent::setUp();
        $this->loadProApi();
    }

    public function testGetSupportedOriginSuccess()
    {
        try {
            $response = $this->rajaongkir->getInternationalOrigin();

            $this->assertNotEmpty($response);
            $this->assertSame(sizeof($response), 501);

            $this->assertSame($response[0]['province'], 'Nanggroe Aceh Darussalam (NAD)');
        } catch (ApiResponseException $e) {
            $this->assertEquals('Connection Timed Out', $e->getMessage());
            $this->assertEquals(0, $e->getCode());
        }
    }

    /* @throws ApiResponseException */
    public function testGetSupportedOriginWithCity()
    {
        $response = $this->rajaongkir->getInternationalOrigin(cityId: 152);
        $this->assertNotEmpty($response);

        $this->assertSame($response['province'], 'DKI Jakarta');
    }

    /* @throws ApiResponseException */
    public function testGetSupportedOriginWithProvince()
    {
        $response = $this->rajaongkir->getInternationalOrigin(provinceId: 6);
        $this->assertNotEmpty($response);
        $this->assertSame(sizeof($response), 6);

        $this->assertSame($response[0]['city_name'], 'Jakarta Barat');
    }

    /* @throws ApiResponseException */
    public function testGetSupportedOriginWithTwoParameters()
    {
        $response = $this->rajaongkir->getInternationalOrigin(152, 6);
        $this->assertNotEmpty($response);
        $this->assertSame(sizeof($response), 1);

        $this->assertSame($response[0]['city_name'], 'Jakarta Pusat');
    }

    /* @throws ApiResponseException */
    public function testGetSupportedOriginFailed()
    {
        $response = $this->rajaongkir->getInternationalOrigin(999, 999);
        $this->assertEmpty($response);
    }

    /* @throws ApiResponseException */
    public function testGetSupportedDestinationSuccess()
    {
        $response = $this->rajaongkir->getInternationalDestination();
        $this->assertNotEmpty($response);
        $this->assertSame(sizeof($response), 235);

        $this->assertSame($response[0]['country_name'], 'Acores Et Madere');
    }

    /* @throws ApiResponseException */
    public function testGetSupportedDestinationWithId()
    {
        $response = $this->rajaongkir->getInternationalDestination(30);
        $this->assertNotEmpty($response);

        $this->assertSame($response['country_name'], 'Canada');
    }

    /* @throws ApiResponseException */
    public function testGetSupportedDestinationFailed()
    {
        $response = $this->rajaongkir->getInternationalDestination(999);
        $this->assertEmpty($response);
    }
}
