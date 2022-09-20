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
        if ($provinceId > 0){
            $query = [
                'id' => $provinceId
            ];
        }

        return $this->getHttp(URLs::$province, $query);
    }
}