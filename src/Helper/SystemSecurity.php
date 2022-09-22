<?php

namespace Dipantry\Rajaongkir\Helper;

use Dipantry\Rajaongkir\Constants\URLs;
use Dipantry\Rajaongkir\Controller\BaseRajaongkir;
use Dipantry\Rajaongkir\Exception\ApiResponseException;

class SystemSecurity
{
    public static function checkApiKey(): bool
    {
        try {
            (new BaseRajaongkir())->getHttp(URLs::$province);
        } catch (ApiResponseException) {
            return false;
        }

        return true;
    }
}
