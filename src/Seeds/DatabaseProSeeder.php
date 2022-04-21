<?php

namespace Dipantry\Rajaongkir\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseProSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $this->reset();

        $this->call(ROProvinceSeeder::class);
        $this->call(ROCitiesSeeder::class);
        $this->call(ROSubDistrictSeeder::class);

        Schema::enableForeignKeyConstraints();
    }

    private function reset()
    {
        DB::table(config('rajaongkir.table_prefix').'provinces')->truncate();
        DB::table(config('rajaongkir.table_prefix').'cities')->truncate();
        DB::table(config('rajaongkir.table_prefix').'subdistricts')->truncate();
    }
}