<?php

namespace Dipantry\Rajaongkir;

use Dipantry\Rajaongkir\Controller\BaseRajaongkir;
use Dipantry\Rajaongkir\Exception\ApiResponseException;
use Exception;

class Rajaongkir extends BaseRajaongkir
{
    /* @throws Exception */
    public function getOngkirCost(
        int $origin, int $destination, int $weight, string $courier,
        string $originType = 'city', string $destinationType = 'city',
        int $length = null, int $width = null, int $height = null, int $diameter = null
    ){
        if (!$this->checkCourierCode($courier)){
            throw new ApiResponseException('Courier code not found', 400);
        }

        if (!$this->policy->allowGetCosts($courier)){
            throw new ApiResponseException('Courier not allowed', 400);
        }

        if ($this->package == 'pro'){
            $body = [
                'origin' => "{$origin}",
                'destination' => "{$destination}",
                'weight' => $weight,
                'courier' => $courier,
                'origin_type' => $originType,
                'destination_type' => $destinationType,
                'length' => $length,
                'width' => $width,
                'height' => $height,
                'diameter' => $diameter
            ];
        } else {
            $body = [
                'origin' => "{$origin}",
                'destination' => "{$destination}",
                'weight' => $weight,
                'courier' => $courier
            ];
        }

        return $this->postHttp('/cost', $body);
    }
}