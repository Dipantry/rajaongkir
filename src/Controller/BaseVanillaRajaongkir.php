<?php

namespace Dipantry\Rajaongkir\Controller;

use Dipantry\Rajaongkir\Constants\Packages;
use Dipantry\Rajaongkir\Constants\RajaongkirCourier;
use Dipantry\Rajaongkir\Constants\URLs;
use Dipantry\Rajaongkir\Exception\ApiResponseException;
use Dipantry\Rajaongkir\Policies\PackagePolicy;
use Dipantry\Rajaongkir\Service\HTTPService;
use ReflectionException;

class BaseVanillaRajaongkir
{
    protected string $package;
    protected PackagePolicy $policy;

    private HTTPService $http;

    /* @throws ApiResponseException */
    public function __construct(string $apiKey, string $package, int $timeout)
    {
        if (empty($apiKey)) {
            throw new ApiResponseException('API Key not specified');
        }

        if (empty($this->checkPackage($package))) {
            $this->package = $package;
        } else {
            throw new ApiResponseException($this->checkPackage($package));
        }

        $baseUrl = match ($this->package) {
            Packages::BASIC => URLs::$basicBaseUrl,
            Packages::PRO   => URLs::$proBaseUrl,
            default         => URLs::$starterBaseUrl,
        };

        $this->policy = new PackagePolicy($this->package);
        $this->http = new HTTPService($baseUrl, $timeout, $apiKey);
    }

    /* @throws ApiResponseException */
    public function getHttp($url, $params = [], bool $manyResults = true)
    {
        return $this->http->get($url, $params, $manyResults);
    }

    /* @throws ApiResponseException */
    public function postHttp($url, $body = [], bool $manyResults = true)
    {
        return $this->http->post($url, $body, $manyResults);
    }

    protected function checkCourierCode(string $courierCode): bool
    {
        try {
            return RajaongkirCourier::isValidValue($courierCode);
        } catch (ReflectionException) {
            return false;
        }
    }

    private function checkPackage(string $package): string
    {
        $message = '';

        if (empty($package)) {
            $message = 'API Package not specified';
        }
        try {
            if (!Packages::isValidValue($package)) {
                $message = 'Invalid Package';
            }
        } catch (ReflectionException) {
            $message = 'Invalid Package';
        }

        return $message;
    }
}
