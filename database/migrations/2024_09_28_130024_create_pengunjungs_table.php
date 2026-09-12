<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengunjungs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('telepon');
            $table->string('instansi');
            $table->string('gender');
            $table->string('alamat');
            $table->string('pekerjaan');
            $table->string('keperluan');
            $table->string('bertemu');
            $table->string('photo')->nullable();
            $table->integer('skor_kepuasan')->nullable();
            $table->string('komentar_kepuasan')->nullable();
            $table->boolean('akses_kepuasan')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengunjungs');
    }
};
