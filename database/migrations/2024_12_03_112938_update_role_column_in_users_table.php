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
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan role 'master_data' pada enum
            $table->enum('role', ['admin', 'customer', 'master_data'])->default('customer')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Mengembalikan ke nilai enum sebelumnya tanpa 'master_data'
            $table->enum('role', ['admin', 'customer'])->default('customer')->change();
        });
    }
};
