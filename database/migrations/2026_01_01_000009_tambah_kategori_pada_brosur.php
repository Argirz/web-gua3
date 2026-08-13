<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('brosur', function (Blueprint $table) {
            $table->enum('kategori', ['brosur', 'pricelist'])->default('brosur')->after('id');
            $table->index('kategori');
        });
    }

    public function down(): void
    {
        Schema::table('brosur', function (Blueprint $table) {
            $table->dropIndex(['kategori']);
            $table->dropColumn('kategori');
        });
    }
};