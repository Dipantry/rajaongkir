<?php

namespace Dipantry\Rajaongkir\Seeds;

use Dipantry\Rajaongkir\Policies\PackagePolicy;
use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;

class ROSubDistrictSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = config('rajaongkir.table_prefix').'subdistricts';
        $this->filename = dirname(__FILE__, 3).'/resources/csv/subdistrict.csv';
        $this->csv_delimiter = ',';
        $this->offset_rows = 1;
        $this->mapping = [
            0 => 'id',
            3 => 'city_id',
            6 => 'name',
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $package = config('rajaongkir.package');
        if (!(new PackagePolicy($package))->allowGetDistricts()) {
            return;
        }

        DB::disableQueryLog();
        DB::table($this->table);

        parent::run();
    }
}
