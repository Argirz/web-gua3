<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('unit_rumah', function (Blueprint $table) {
            $table->id();
            $table->string('block')->unique();
            $table->foreignId('unit_type_id')->constrained('tipe_rumah')->restrictOnDelete();
            $table->enum('status', ['tersedia', 'dipesan', 'terjual'])->default('tersedia');
            $table->timestamps();
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('unit_rumah');
    }
};