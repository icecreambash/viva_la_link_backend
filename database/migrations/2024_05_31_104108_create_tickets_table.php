<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignUuid('airline_id');
            $table->string('code');
            $table->dateTime('flight_time');
            $table->dateTime('start_time');
            $table->foreignUuid('start_city_id');
            $table->foreignUuid('end_city_id');
            $table->integer('count_step');
            $table->foreignUuid('country_id');
            $table->foreignUuid('category_id');
            $table->dateTime('start_fly');
            $table->dateTime('end_fly');
            $table->decimal('price',64,2);
            $table->boolean('is_reserved')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
