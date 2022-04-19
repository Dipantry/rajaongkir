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
            $table->string('subdistrict_id', 255);
            $table->string('province_id', 255);
            $table->string('province', 255);
            $table->string('city_id', 255);
            $table->string('city', 255);
            $table->string('type', 255);
            $table->string('subdistrict_name', 255);
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