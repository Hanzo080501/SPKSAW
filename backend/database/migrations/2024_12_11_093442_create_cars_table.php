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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('name');
            $table->string('brand');
            $table->decimal('price', 20, 2); // C1
            $table->integer('range'); // C2
            $table->string('battery_type'); // C3
            $table->string('drive_type'); // C4
            $table->string('dealer_availability'); // C5
            $table->string('spare_part_availability'); // C6
            $table->integer('top_speed'); // C7
            $table->integer('charging_time'); // C8
            $table->decimal('preferensi', 20, 2)->default(0.0);
            $table->integer('ranking')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
