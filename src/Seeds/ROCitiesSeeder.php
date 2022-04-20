<?php

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;

class ROCitiesSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = config('dipantry.rajaongkir.table_prefix').'cities';
        $this->filename = '../../../resources/csv/city.csv';
        $this->csv_delimiter = ',';
        $this->offset_rows = 1;
        $this->mapping = [
            0 => 'id',
            3 => 'city_id',
            6 => 'subdistrict_name'
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        DB::table($this->table);

        parent::run();
    }
}