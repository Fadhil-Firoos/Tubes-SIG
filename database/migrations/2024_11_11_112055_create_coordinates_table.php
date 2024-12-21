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
        Schema::create('coordinates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unique_id')->nullable();
            $table->foreign('unique_id')->references('id')->on('users')
            ->constrained('coordinates');
            $table->uuid('uuid')->unique();
            $table->float('panjang_perbaikan')->nullable();
            $table->float('lebar_perbaikan')->nullable();
            $table->string('nama_lokasi')->nullable();
            $table->string('nama_company')->nullable();
            $table->jsonb('longlat')->nullable();
            $table->string('foto')->nullable();
            $table->dateTime('tgl_start')->nullable();
            $table->dateTime('tgl_end')->nullable();
            $table->enum('status', ['reported', 'process', 'finish', 'accepted', 'rejected'])->default('reported');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coordinates');
    }
};
