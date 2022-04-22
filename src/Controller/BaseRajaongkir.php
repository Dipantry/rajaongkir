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
    protected string $apiKey, $package, $baseUrl;
    protected PackagePolicy $policy;

    protected string $starterBaseUrl = 'https://api.rajaongkir.com/starter';
    protected string $basicBaseUrl = 'https://api.rajaongkir.com/basic';
    protected string $proBaseUrl = 'https://pro.rajaongkir.com/api';

    public function __construct()
    {
        $this->apiKey = config('rajaongkir.api_key');
        $this->package = config('rajaongkir.package');

        $this->baseUrl = match ($this->package) {
            'basic' => $this->basicBaseUrl,
            'pro' => $this->proBaseUrl,
            default => $this->starterBaseUrl,
        };

        $this->policy = new PackagePolicy($this->package);
    }

    /* @throws ApiResponseException */
    public function getHttp($url, $params = [])
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->get($this->baseUrl . $url, $params);

        try {
            $result = $response['rajaongkir']['results'];
        } catch (Exception $e) {
            throw new ApiResponseException(
                message: $response['rajaongkir']['status']['description'],
                code: $response['rajaongkir']['status']['code']
            );
        }
        return $result;
    }

    /* @throws ApiResponseException */
    public function postHttp($url, $body = [])
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->post($this->baseUrl . $url, $body);

        try {
            $result = $response['rajaongkir']['results'];
        } catch (Exception $e) {
            throw new ApiResponseException(
                message: $response['rajaongkir']['status']['description'],
                code: $response['rajaongkir']['status']['code']
            );
        }
        return $result;
    }

    public function checkCourierCode(string $courierCode): bool
    {
        try {
            return RajaongkirCourier::isValidValue($courierCode);
        } catch (ReflectionException $e) {
            return false;
        }
    }
}