<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_orders', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('phone_number');
            $table->string('email');
            $table->string('item_name');
            $table->string('agency_name');
            $table->date('pick_up_date'); 
            $table->integer('weight');
            $table->integer('male_quantity')->default(0);
            $table->integer('female_quantity')->default(0);
            $table->integer('total_price');
            $table->boolean('is_paid')->default(false);
            $table->text('notes')->nullable(); // Catatan dari customer
            $table->string('status')->default('pending'); 
            $table->unsignedBigInteger('approved_by')->nullable(); // Admin yang menyetujui
            $table->timestamps();

            // Relasi ke tabel users (admin)
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_orders');
    }
}
