<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(config('rajaongkir.table_prefix').'subdistricts', function ($table) {
            $table->id();
            $table->string('name', 255);
            $table->bigInteger('city_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(config('rajaongkir.table_prefix').'subdistricts');
    }
};
