<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('block')->nullable();
            $table->string('type');
            $table->decimal('land_area', 10, 2)->nullable();
            $table->decimal('building_area', 10, 2)->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->enum('status', ['tersedia', 'dipesan', 'terjual'])->default('tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};