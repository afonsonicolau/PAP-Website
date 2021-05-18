<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_number');
            $table->unsignedBigInteger('cart_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('delivery_id')->index();
            $table->unsignedBigInteger('billing_id')->index();
            $table->string('additional')->nullable();
            $table->float('total_price');
            $table->date('date_bought');
            $table->string('payment_method');
            $table->string('delivery_method');
            $table->string('state')->default('Em Processamento');
            $table->boolean('paid')->default('0');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
