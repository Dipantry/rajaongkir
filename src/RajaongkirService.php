<?php

namespace Dipantry\Rajaongkir;

use Dipantry\Rajaongkir\Constants\Packages;
use Dipantry\Rajaongkir\Constants\URLs;
use Dipantry\Rajaongkir\Controller\BaseRajaongkir;
use Dipantry\Rajaongkir\Exception\ApiResponseException;

class RajaongkirService extends BaseRajaongkir
{
    /* @throws ApiResponseException */
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
            Packages::PRO => [
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
            Packages::PRO => [
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
            throw new ApiResponseException('You can\'t get currencies', 400);
        }

        return $this->getHttp(URLs::$currency, [], false);
    }

    /* @throws ApiResponseException */
    public function getWaybill(
        string $waybill,
        string $courier
    ) {
        if (!$this->policy->allowGetWaybill($courier)) {
            throw new ApiResponseException('You can\'t get waybills', 400);
        }

        $body = [
            'waybill' => $waybill,
            'courier' => $courier,
        ];

        return $this->postHttp(URLs::$waybill, $body, false);
    }
}
