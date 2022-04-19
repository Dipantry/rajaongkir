<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('dipantry.rajaongkir.table_prefix').'subdistricts', function ($table) {
            $table->increments('id');
            $table->string('subdistrict_id');
            $table->string('province_id');
            $table->string('province');
            $table->string('city_id');
            $table->string('city');
            $table->string('type');
            $table->string('subdistrict_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('dipantry.rajaongkir.table_prefix').'subdistricts');
    }
};