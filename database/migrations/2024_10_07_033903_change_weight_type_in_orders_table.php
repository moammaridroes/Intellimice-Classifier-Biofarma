<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
        {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('weight')->change();
            });
        }

        public function down()
        {
            Schema::table('orders', function (Blueprint $table) {
                $table->integer('weight')->change(); // ubah kembali jika perlu revert
            });
        }

};
