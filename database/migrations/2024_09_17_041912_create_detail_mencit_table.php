<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailMencitTable extends Migration
{
    public function up()
    {
        Schema::create('detail_mencit', function (Blueprint $table) {
            $table->id();
            $table->decimal('berat', 8, 2); // Berat mencit
            $table->enum('gender', ['Male', 'Female']); // Gender mencit
            $table->enum('health_status', ['Healthy', 'Sick']); // Status kesehatan mencit
            $table->timestamps(); // Created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_mencit');
    }
}

