<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('serah_terima', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_rumah_id')->nullable()->constrained('unit_rumah')->nullOnDelete();
            $table->string('customer')->nullable();
            $table->string('image');
            $table->string('caption')->nullable();
            $table->date('handover_date')->nullable();
            $table->boolean('active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->index(['active', 'sort_order']);
            $table->index('handover_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('serah_terima');
    }
};