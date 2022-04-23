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
            __DIR__.'/../config/rajaongkir.php', 'rajaongkir'
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

        $this->registerMacro();
    }

    protected function registerMacro()
    {
        EloquentBuilder::macro('whereLike', function ($attributes, string $searchTerm){
            $this->where(function (EloquentBuilder $query) use ($attributes, $searchTerm){
                foreach (Arr::wrap($attributes) as $attribute){
                    $query->when(
                        Str::contains($attribute, '.'),
                        function (EloquentBuilder $query) use ($attribute, $searchTerm) {
                            [$relationName, $relationAttribute] = explode('.', $attribute);

                            $query->orWhereHas(
                                $relationName,
                                function (EloquentBuilder $query) use ($relationAttribute, $searchTerm) {
                                    $query->where($relationAttribute, 'LIKE', "%{$searchTerm}%");
                                }
                            );
                        },
                        function (EloquentBuilder $query) use ($attribute, $searchTerm) {
                            $table = $query->getModel()->getTable();
                            $query->orWhere(sprintf('%s.%s', $table, $attribute), 'LIKE', "%{$searchTerm}%");
                        }
                    );
                }
            });

            return $this;
        });
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