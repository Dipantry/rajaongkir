<?php

namespace Dipantry\Rajaongkir\Helper;

use Dipantry\Rajaongkir\Controller\BaseRajaongkir;
use Dipantry\Rajaongkir\Exception\ApiResponseException;

class SystemSecurity
{
    public static function checkApiKey(): bool
    {
        try {
            (new BaseRajaongkir())->getHttp('');
        } catch (ApiResponseException $e) {
            if ($e->getCode() == 500) {
                return true;
            }
            return false;
        }

        return true;
    }
}
