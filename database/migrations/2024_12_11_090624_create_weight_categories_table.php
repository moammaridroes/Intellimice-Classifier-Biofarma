<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeightCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weight_categories', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->enum('gender', ['Male', 'Female'])->comment('Gender of the category');
            $table->string('name', 255)->comment('Name of the weight category');
            $table->string('weight_range', 50)->comment('Range of the weight, e.g., 10-20g');
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weight_categories');
    }
}
