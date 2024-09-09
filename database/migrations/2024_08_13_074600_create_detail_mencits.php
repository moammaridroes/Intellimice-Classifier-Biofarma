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
        Schema::create('detail_mencits', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_kelamin');
            $table->decimal('berat');
            $table->integer('kuantitas');
            $table->integer('id_order');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_mencits');
    }
};
