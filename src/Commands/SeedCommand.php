<?php

namespace Dipantry\Rajaongkir\Commands;

use Dipantry\Rajaongkir\Helper\SystemSecurity;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rajaongkir:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed RajaOngkir database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $userPackage = config('rajaongkir.package');

        if (!SystemSecurity::checkApiKey()) {
            $this->error('API Key is not valid');

            return;
        }

        if ($userPackage == 'starter') {
            Artisan::call('db:seed', ['--class' => 'Dipantry\Rajaongkir\Seeds\DatabaseSeeder', '--force' => true]);
            $this->info('Seeded: RajaOngkir Starter Package');
        } elseif ($userPackage == 'basic') {
            Artisan::call('db:seed', ['--class' => 'Dipantry\Rajaongkir\Seeds\DatabaseBasicSeeder', '--force' => true]);
            $this->info('Seeded: RajaOngkir Basic Package');
        } elseif ($userPackage == 'pro') {
            Artisan::call('db:seed', ['--class' => 'Dipantry\Rajaongkir\Seeds\DatabaseProSeeder', '--force' => true]);
            $this->info('Seeded: RajaOngkir Pro Package');
        } else {
            $this->info('Seeded Failed: Unknown Package');
        }
    }
}
