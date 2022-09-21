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
    ) {
        if (!$this->policy->allowGetProvinces()) {
            throw new ApiResponseException('You\'re not allowed to get province data', 400);
        }

        $query = [];
        if ($provinceId > 0) {
            $query['id'] = $provinceId;
        }

        return $this->getHttp(URLs::$province, $query);
    }

    /** @throws ApiResponseException */
    public function getCity(
        int $cityId = 0,
        int $provinceId = 0
    ) {
        if (!$this->policy->allowGetCities()) {
            throw new ApiResponseException('You\'re not allowed to get city data', 400);
        }

        $query = [];
        if ($cityId > 0) {
            $query['id'] = $cityId;
        }
        if ($provinceId > 0) {
            $query['province'] = $provinceId;
        }

        return $this->getHttp(URLs::$city, $query);
    }

    /** @throws ApiResponseException */
    public function getSubDistrict(
        int $cityId,
        int $subDistrictId = 0,
    ) {
        if (!$this->policy->allowGetDistricts()) {
            throw new ApiResponseException('You\'re not allowed to get sub district data', 400);
        }

        $query['city'] = $cityId;
        if ($subDistrictId > 0) {
            $query['id'] = $subDistrictId;
        }

        return $this->getHttp(URLs::$subDistrict, $query);
    }

    /** @throws ApiResponseException */
    public function getOngkirCost(
        int $origin,
        int $destination,
        int $weight,
        string $courier,
        string $originType = 'city',
        string $destinationType = 'city',
        int $length = null,
        int $width = null,
        int $height = null,
        int $diameter = null
    ) {
        if (!$this->checkCourierCode($courier)) {
            throw new ApiResponseException('Courier code not found', 400);
        }

        if (!$this->policy->allowGetCosts($courier)) {
            throw new ApiResponseException('Courier not allowed', 400);
        }

        $body = match ($this->package) {
            'pro' => [
                'origin'          => "$origin",
                'destination'     => "$destination",
                'weight'          => $weight,
                'courier'         => $courier,
                'originType'      => $originType,
                'destinationType' => $destinationType,
                'length'          => $length,
                'width'           => $width,
                'height'          => $height,
                'diameter'        => $diameter,
            ],
            default => [
                'origin'      => "$origin",
                'destination' => "$destination",
                'weight'      => $weight,
                'courier'     => $courier,
            ]
        };

        return $this->postHttp(URLs::$localCost, $body);
    }

    /* @throws ApiResponseException */
    public function getInternationalOrigin(
        int $cityId = 0,
        int $provinceId = 0
    ) {
        if (!$this->policy->allowGetInternationalOrigin()) {
            throw new ApiResponseException('You\'re not allowed to get international origin data', 400);
        }

        $query = [];
        if ($cityId > 0) {
            $query['id'] = $cityId;
        }
        if ($provinceId > 0) {
            $query['province'] = $provinceId;
        }

        return $this->getHttp(URLs::$internationalOrigin, $query);
    }

    /* @throws ApiResponseException */
    public function getInternationalDestination(
        int $countryId = 0,
    ) {
        if (!$this->policy->allowGetInternationalDestination()) {
            throw new ApiResponseException('You\'re not allowed to get international destination data', 400);
        }

        $query = [];
        if ($countryId > 0) {
            $query['id'] = $countryId;
        }

        return $this->getHttp(URLs::$internationalDestination, $query);
    }

    /* @throws ApiResponseException */
    public function getInternationalOngkirCost(
        int $origin,
        int $destination,
        int $weight,
        string $courier,
        int $length = null,
        int $width = null,
        int $height = null,
        int $diameter = null
    ) {
        if (!$this->checkCourierCode($courier)) {
            throw new ApiResponseException('Courier code not found', 400);
        }

        if (!$this->policy->allowGetInternationalCosts()) {
            throw new ApiResponseException('You can\'t get international costs', 400);
        }

        $body = match ($this->package) {
            'pro' => [
                'origin'      => "$origin",
                'destination' => "$destination",
                'weight'      => $weight,
                'courier'     => $courier,
                'length'      => $length,
                'width'       => $width,
                'height'      => $height,
                'diameter'    => $diameter,
            ],
            default => [
                'origin'      => "$origin",
                'destination' => "$destination",
                'weight'      => $weight,
                'courier'     => $courier,
            ]
        };

        return $this->postHttp(URLs::$internationalCost, $body);
    }

    /* @throws ApiResponseException */
    public function getCurrency()
    {
        if (!$this->policy->allowGetCurrencies()) {
            throw new ApiResponseException('You can\'t get currency', 400);
        }

        return $this->getHttp(URLs::$currency, manyResults: false);
    }

    /* @throws ApiResponseException */
    public function getWaybill(
        string $waybill,
        string $courier
    ) {
        if (!$this->policy->allowGetWaybill($courier)) {
            throw new ApiResponseException('You can\'t get waybill', 400);
        }

        $body = [
            'waybill' => $waybill,
            'courier' => $courier,
        ];

        return $this->postHttp(URLs::$waybill, $body, false);
    }
}
