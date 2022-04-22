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
        } catch (ApiResponseException $e) {
            return false;
        }
        return true;
    }
}