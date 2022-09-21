<?php

namespace Dipantry\Rajaongkir\Controller;

use Dipantry\Rajaongkir\Constants\URLs;
use Dipantry\Rajaongkir\Exception\ApiResponseException;
use Dipantry\Rajaongkir\Models\RajaongkirCourier;
use Dipantry\Rajaongkir\Policies\PackagePolicy;
use Exception;
use Illuminate\Support\Facades\Http;
use ReflectionException;

class BaseVanillaRajaongkir
{
    protected string $apiKey;
    protected string $package;
    protected string $baseUrl;
    protected int $timeout;
    protected PackagePolicy $policy;

    /* @throws ApiResponseException */
    public function __construct(string $apiKey, string $package, int $timeout)
    {
        if (empty($apiKey)) {
            throw new ApiResponseException('API Key not specified');
        } else {
            $this->apiKey = $apiKey;
        }

        if (empty($this->checkPackage($package))) {
            $this->package = $package;
        } else {
            throw new ApiResponseException($this->checkPackage($package));
        }

        $this->baseUrl = match ($this->package) {
            'basic' => URLs::$basicBaseUrl,
            'pro'   => URLs::$proBaseUrl,
            default => URLs::$starterBaseUrl,
        };

        $this->policy = new PackagePolicy($this->package);
        $this->timeout = $timeout;
    }

    /* @throws ApiResponseException */
    public function getHttp($url, $params = [], bool $manyResults = true)
    {
        try {
            $response = Http::withHeaders([
                'key' => $this->apiKey,
            ])->timeout($this->timeout)->get($this->baseUrl.$url, $params);
        } catch (Exception) {
            throw new ApiResponseException('Connection Timed Out');
        }

        try {
            $result = $response['rajaongkir'][$manyResults ? 'results' : 'result'];
        } catch (Exception) {
            throw new ApiResponseException(
                message: $response['rajaongkir']['status']['description'] ?? 'Unknown Error',
                code: $response['rajaongkir']['status']['code'] ?? 500
            );
        }

        return $result;
    }

    /* @throws ApiResponseException */
    public function postHttp($url, $body = [], bool $manyResults = true)
    {
        try {
            $response = Http::withHeaders([
                'key' => $this->apiKey,
            ])->timeout($this->timeout)->post($this->baseUrl.$url, $body);
        } catch (Exception) {
            throw new ApiResponseException('Connection Timed Out');
        }

        try {
            $result = $response['rajaongkir'][$manyResults ? 'results' : 'result'];
        } catch (Exception) {
            throw new ApiResponseException(
                message: $response['rajaongkir']['status']['description'] ?? 'Unknown Error',
                code: $response['rajaongkir']['status']['code'] ?? 500
            );
        }

        return $result;
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
        if (empty($package)) {
            return 'API Package not specified';
        }
        if ($package != 'starter' && $package != 'basic' && $package != 'pro') {
            return 'Invalid package';
        }

        return '';
    }
}
