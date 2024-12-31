<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // Tambah foreign key ke tabel orders
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('detail_mencit_id')->nullable()->after('is_paid');
            $table->foreign('detail_mencit_id')->references('id')->on('detail_mencit');
        });

        // Tambah foreign key ke tabel customer_orders
        Schema::table('customer_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('detail_mencit_id')->nullable()->after('is_paid');
            $table->foreign('detail_mencit_id')->references('id')->on('detail_mencit');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['detail_mencit_id']);
            $table->dropColumn('detail_mencit_id');
        });

        Schema::table('customer_orders', function (Blueprint $table) {
            $table->dropForeign(['detail_mencit_id']);
            $table->dropColumn('detail_mencit_id');
        });
    }
};
