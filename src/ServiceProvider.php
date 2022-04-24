<?php

namespace Dipantry\Rajaongkir;

use Dipantry\Rajaongkir\Commands\SeedCommand;
use Illuminate\Foundation\Application;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->app->bind('rajaongkir', function (){
            return new Rajaongkir();
        });

        $this->commands([
            SeedCommand::class,
        ]);
    }

    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/rajaongkir.php', 'rajaongkir',
        );
        $this->mergeConfigFrom(
            __DIR__.'/../config/rajaongkir_testing.php', 'rajaongkir_testing',
        );

        $databasePath = __DIR__.'/../database/migrations';
        if ($this->isLumen()){
            $this->loadMigrationsFrom($databasePath);
        } else {
            $this->publishes(
                [$databasePath => database_path('migrations')],
                'migrations'
            );
        }

        if (class_exists(Application::class)){
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