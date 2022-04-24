<?php

namespace Dipantry\Rajaongkir\Controller;

use Dipantry\Rajaongkir\Exception\ApiResponseException;
use Dipantry\Rajaongkir\Models\RajaongkirCourier;
use Dipantry\Rajaongkir\Policies\PackagePolicy;
use Exception;
use Illuminate\Support\Facades\Http;
use ReflectionException;

class BaseRajaongkir
{
    protected string $apiKey;
    protected string $package;
    protected string $baseUrl;
    protected int $timeout;
    protected PackagePolicy $policy;

    protected string $starterBaseUrl = 'https://api.rajaongkir.com/starter';
    protected string $basicBaseUrl = 'https://api.rajaongkir.com/basic';
    protected string $proBaseUrl = 'https://pro.rajaongkir.com/api';

    /* @throws ApiResponseException */
    public function __construct()
    {
        if (empty(config('rajaongkir.api_key'))) {
            throw new ApiResponseException('API Key not specified');
        } else {
            $this->apiKey = config('rajaongkir.api_key');
        }

        if (empty($this->checkPackage())) {
            $this->package = config('rajaongkir.package');
        } else {
            throw new ApiResponseException($this->checkPackage());
        }

        $this->timeout = config('rajaongkir.timeout');

        $this->baseUrl = match ($this->package) {
            'basic' => $this->basicBaseUrl,
            'pro'   => $this->proBaseUrl,
            default => $this->starterBaseUrl,
        };

        $this->policy = new PackagePolicy($this->package);
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

    private function checkPackage(): string
    {
        $package = config('rajaongkir.package');

        if (empty($package)) {
            return 'API Package not specified';
        }
        if (!($package == 'starter' || $package == 'basic' || $package == 'pro')) {
            return 'Unknown API Package';
        }

        return '';
    }
}
