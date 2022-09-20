<?php

namespace Dipantry\Rajaongkir;

use Dipantry\Rajaongkir\Constants\URLs;
use Dipantry\Rajaongkir\Controller\BaseVanillaRajaongkir;
use Dipantry\Rajaongkir\Exception\ApiResponseException;

class Rajaongkir extends BaseVanillaRajaongkir
{
    public function __construct(string $apiKey, string $package, int $timeout = 30)
    {
        parent::__construct($apiKey, $package, $timeout);
    }

    /** @throws ApiResponseException */
    public function getProvince(
        int $provinceId = 0,
    ){
        if (!$this->policy->allowGetProvinces()){
            throw new ApiResponseException('You\'re not allowed to get province data', 400);
        }

        $query = [];
        if ($provinceId > 0)
            $query['id'] = $provinceId;

        return $this->getHttp(URLs::$province, $query);
    }

    /** @throws ApiResponseException */
    public function getCity(
        int $cityId = 0,
        int $provinceId = 0
    ){
        if (!$this->policy->allowGetCities()){
            throw new ApiResponseException('You\'re not allowed to get city data', 400);
        }

        $query = [];
        if ($cityId > 0)
            $query['id'] = $cityId;
        if ($provinceId > 0)
            $query['province'] = $provinceId;

        return $this->getHttp(URLs::$city, $query);
    }

    /** @throws ApiResponseException */
    public function getSubDistrict(
        int $cityId,
        int $subDistrictId = 0,
    ){
        if (!$this->policy->allowGetDistricts()){
            throw new ApiResponseException('You\'re not allowed to get sub district data', 400);
        }

        $query['city'] = $cityId;
        if ($subDistrictId > 0)
            $query['id'] = $subDistrictId;

        return $this->getHttp(URLs::$subDistrict, $query);
    }
}