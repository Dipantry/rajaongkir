<?php

namespace Dipantry\Rajaongkir\Tests;

use Dipantry\Rajaongkir\Facade;
use Dipantry\Rajaongkir\ServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public string $provinceSeeder = 'Dipantry\Rajaongkir\Seeds\ROProvinceSeeder';
    public string $citySeeder = 'Dipantry\Rajaongkir\Seeds\ROCitySeeder';
    public string $subDistrictSeeder = 'Dipantry\Rajaongkir\Seeds\ROSubDistrictSeeder';

    public function setUp(): void
    {
        parent::setUp();
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    public function getPackageProviders($app): array
    {
        return [
            ServiceProvider::class,
        ];
    }

    public function getPackageAliases($app)
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
}