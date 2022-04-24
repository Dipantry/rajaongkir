<?php

namespace Dipantry\Rajaongkir\Helper;

use Dipantry\Rajaongkir\Controller\BaseRajaongkir;
use Dipantry\Rajaongkir\Exception\ApiResponseException;

class SystemSecurity
{
    public static function checkApiKey(): bool
    {
        try {
            (new BaseRajaongkir())->getHttp('/province', []);
        } catch (ApiResponseException) {
            return false;
        }

        return true;
    }

    public static function allowProvinceSeeding(): bool
    {
        try {
            (new BaseRajaongkir())->getHttp('/province', []);
        } catch (ApiResponseException) {
            return false;
        }

        return true;
    }

    public static function allowCitySeeding(): bool
    {
        try {
            (new BaseRajaongkir())->getHttp('/city', []);
        } catch (ApiResponseException) {
            return false;
        }

        return true;
    }

    public static function allowSubDistrictSeeding(): bool
    {
        try {
            (new BaseRajaongkir())->getHttp('/subdistrict', [
                'id' => '1',
            ]);
        } catch (ApiResponseException) {
            return false;
        }

        return true;
    }

    public static function allowCountrySeeding(): bool
    {
        try {
            (new BaseRajaongkir())->getHttp('/v2/internationalDestination', [
                'id' => '1',
            ]);
        } catch (ApiResponseException) {
            return false;
        }

        return true;
    }
}
