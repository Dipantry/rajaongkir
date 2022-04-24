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
        Schema::create(config('rajaongkir.table_prefix').'cities', function ($table) {
            $table->id();
            $table->string('type', 255);
            $table->string('name', 255);
            $table->string('postal_code', 255);
            $table->bigInteger('province_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop(config('rajaongkir.table_prefix').'cities');
    }
};
