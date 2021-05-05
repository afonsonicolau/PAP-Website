<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_number');
            $table->string('cart_ids');
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('delivery_id')->index();
            $table->unsignedBigInteger('billing_id')->index();
            $table->string('additional')->nullable();
            $table->string('total_price');
            $table->date('date_bought');
            $table->string('payment_method');
            $table->string('delivery_method');
            $table->string('state')->default('Em Processamento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
