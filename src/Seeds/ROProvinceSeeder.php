<?php

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;

class ROProvinceSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = config('dipantry.rajaongkir.table_prefix').'provinces';
        $this->filename = '../../../resources/csv/province.csv';
        $this->csv_delimiter = ',';
        $this->offset_rows = 1;
        $this->mapping = [
            0 => 'id',
            1 => 'name'
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