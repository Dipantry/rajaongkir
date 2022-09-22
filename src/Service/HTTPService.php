<?php

namespace Dipantry\Rajaongkir\Service;

use Dipantry\Rajaongkir\Exception\ApiResponseException;
use Exception;
use Illuminate\Support\Facades\Http;

class HTTPService
{
    private string $apiKey;
    private string $baseUrl;
    private int $timeout;

    public function __construct(string $baseUrl, int $timeout, string $apiKey)
    {
        $this->baseUrl = $baseUrl;
        $this->timeout = $timeout;
        $this->apiKey = $apiKey;
    }

    /* @throws ApiResponseException */
    public function get(string $url, array $params, bool $manyResults)
    {
        try {
            $response = Http::withHeaders([
                'key' => $this->apiKey,
            ])->timeout($this->timeout)->get($this->baseUrl.$url, $params);
        } catch (Exception) {
            throw new ApiResponseException('Connection Timed Out');
        }

        if (!$response->ok()) {
            throw new ApiResponseException($response->reason(), $response->status());
        }

        try {
            $result = $response['rajaongkir'][$manyResults ? 'results' : 'result'];
        } catch (Exception) {
            throw new ApiResponseException(
                $response['rajaongkir']['status']['description'] ?? 'Unknown Error',
                $response['rajaongkir']['status']['code'] ?? 500
            );
        }

        return $result;
    }

    /* @throws ApiResponseException */
    public function post(string $url, array $params, bool $manyResults)
    {
        try {
            $response = Http::withHeaders([
                'key' => $this->apiKey,
            ])->timeout($this->timeout)->post($this->baseUrl.$url, $params);
        } catch (Exception) {
            throw new ApiResponseException('Connection Timed Out');
        }

        if (!$response->ok()) {
            throw new ApiResponseException($response->reason(), $response->status());
        }

        try {
            $result = $response['rajaongkir'][$manyResults ? 'results' : 'result'];
        } catch (Exception) {
            throw new ApiResponseException(
                $response['rajaongkir']['status']['description'] ?? 'Unknown Error',
                $response['rajaongkir']['status']['code'] ?? 500
            );
        }

        return $result;
    }
}
