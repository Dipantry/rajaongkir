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
            $table->id();
            $table->string('name', 255);

            $table->foreignId('city_id')->references('id')
                ->on(config('dipantry.rajaongkir.table_prefix').'cities')
                ->onDelete('cascade');
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