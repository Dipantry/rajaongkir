<?php

namespace Dipantry\Rajaongkir\Tests;

use Dipantry\Rajaongkir\Facade;
use Illuminate\Support\Facades\Config;
use JetBrains\PhpStorm\ArrayShape;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public string $provinceSeeder = 'Dipantry\Rajaongkir\Seeds\ROProvinceSeeder';
    public string $citySeeder = 'Dipantry\Rajaongkir\Seeds\ROCitySeeder';
    public string $subDistrictSeeder = 'Dipantry\Rajaongkir\Seeds\ROSubDistrictSeeder';
    public string $countrySeeder = 'Dipantry\Rajaongkir\Seeds\ROCountrySeeder';

    public function setUp(): void
    {
        parent::setUp();
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    public function getPackageProviders($app): array
    {
        return [
            FakeServiceProvider::class,
        ];
    }

    #[ArrayShape(['Rajaongkir' => 'string'])]
    public function getPackageAliases($app): array
    {
        return [
            'Rajaongkir' => Facade::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => 'rajaongkir_',
        ]);
        $app['config']->set('indonesia.table_prefix', 'rajaongkir_');
    }

    protected function loadStarterApi(): void
    {
        Config::set('rajaongkir.package', 'starter');
        Config::set('rajaongkir.api_key', $this->loadTestingApis('starter'));
    }

    protected function loadProApi(): void
    {
        Config::set('rajaongkir.package', 'pro');
        Config::set('rajaongkir.api_key', $this->loadTestingApis('pro'));
    }

    private function loadTestingApis(string $type): string
    {
        return openssl_decrypt(
            $type == 'pro' ? config('rajaongkir_testing.pro') : config('rajaongkir_testing.starter'),
            'AES-128-CTR',
            config('rajaongkir_testing.enc_key'),
            0,
            config('rajaongkir_testing.enc_iv')
        );
    }
}
