<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('galeri', 'foto_rumah');

        Schema::table('foto_rumah', function (Blueprint $table) {
            $table->foreignId('tipe_rumah_id')->nullable()->after('id')->constrained('tipe_rumah')->nullOnDelete();
            $table->enum('kategori', ['unit', 'serah_terima', 'siteplan'])->default('unit')->after('tipe_rumah_id');
        });

        Schema::table('tipe_rumah', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('name');
            $table->unsignedTinyInteger('bedrooms')->nullable()->after('building_area');
            $table->unsignedTinyInteger('bathrooms')->nullable()->after('bedrooms');
            $table->string('brochure_pdf')->nullable()->after('description');
            $table->string('pricelist_pdf')->nullable()->after('brochure_pdf');
        });

        Schema::table('pengguna', function (Blueprint $table) {
            $table->enum('role', ['admin', 'marketing'])->default('admin')->after('email');
        });

        Schema::create('prospek', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipe_rumah_id')->nullable()->constrained('tipe_rumah')->nullOnDelete();
            $table->string('nama_lengkap');
            $table->string('nomor_wa');
            $table->enum('sumber', ['brosur', 'pricelist', 'kontak'])->default('brosur');
            $table->enum('status', ['baru', 'dihubungi', 'deal', 'gugur'])->default('baru');
            $table->timestamps();
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prospek');

        Schema::table('pengguna', function (Blueprint $table) {
            $table->dropColumn('role');
        });

        Schema::table('tipe_rumah', function (Blueprint $table) {
            $table->dropColumn(['slug', 'bedrooms', 'bathrooms', 'brochure_pdf', 'pricelist_pdf']);
        });

        Schema::table('foto_rumah', function (Blueprint $table) {
            $table->dropConstrainedForeignId('tipe_rumah_id');
            $table->dropColumn('kategori');
        });

        Schema::rename('foto_rumah', 'galeri');
    }
};