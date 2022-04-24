<?php

namespace Dipantry\Rajaongkir;

use Dipantry\Rajaongkir\Commands\SeedCommand;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->app->bind('rajaongkir', function () {
            return new RajaongkirService();
        });

        $this->commands([
            SeedCommand::class,
        ]);
    }

    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/rajaongkir.php',
            'rajaongkir',
        );

        $databasePath = __DIR__.'/../database/migrations';
        if ($this->isLumen()) {
            $this->loadMigrationsFrom($databasePath);
        } else {
            $this->publishes(
                [$databasePath => database_path('migrations')],
                'migrations'
            );
        }

        if (class_exists(Application::class)) {
            $this->publishes([
                __DIR__.'/../config/rajaongkir.php' => config_path('rajaongkir.php'),
            ], 'config');
        }
    }

    protected function isLaravel(): bool
    {
        return app() instanceof Application;
    }

    protected function isLumen(): bool
    {
        return !$this->isLaravel();
    }
}
