<?php

namespace Dipantry\Rajaongkir\Tests;

use Dipantry\Rajaongkir\Exception\ApiResponseException;
use Dipantry\Rajaongkir\Rajaongkir;

class VanillaTestCase extends \Orchestra\Testbench\TestCase
{
    protected Rajaongkir $rajaongkir;

    private string $starterKey = 'pkwVDHW+eSanFzvS7GVLPROWj6LRWBTlm8gLOYvUrOo=';
    private string $proKey = 'phsWXy6+fnz8HDyLtmtHOUaS0qeDDEexlcpZNdiG/7Y=';
    private string $encIv = '1234567891011121';
    private string $encKey = 'Dipantry';

    /** @throws ApiResponseException */
    protected function loadProApi(): void
    {
        $package = 'pro';
        $this->rajaongkir = new Rajaongkir($this->getApiKey($package), $package, 60);
    }

    /** @throws ApiResponseException */
    protected function loadStarterApi(): void
    {
        $package = 'starter';
        $this->rajaongkir = new Rajaongkir($this->getApiKey($package), $package, 60);
    }

    private function getApiKey(string $type): string
    {
        return openssl_decrypt(
            $type == 'pro' ? $this->proKey : $this->starterKey,
            'AES-128-CTR',
            $this->encKey,
            0,
            $this->encIv);
    }
}