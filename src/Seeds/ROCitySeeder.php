<?php

namespace Dipantry\Rajaongkir\Seeds;

use Dipantry\Rajaongkir\Helper\SystemSecurity;
use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;

class ROCitySeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = config('rajaongkir.table_prefix').'cities';
        $this->filename = dirname(__FILE__, 3).'/resources/csv/city.csv';
        $this->csv_delimiter = ',';
        $this->offset_rows = 1;
        $this->mapping = [
            0 => 'id',
            1 => 'province_id',
            3 => 'type',
            4 => 'name',
            5 => 'postal_code',
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if (!SystemSecurity::allowCitySeeding()) {
            return;
        }

        DB::disableQueryLog();
        DB::table($this->table);

        parent::run();
    }
}
