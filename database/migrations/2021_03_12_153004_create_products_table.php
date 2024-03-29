<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('collection_id')->index();
            $table->boolean('standout')->default(0);
            $table->boolean('outlet')->default(0);
            $table->unsignedBigInteger('type_id')->index();
            $table->string('color');
            $table->string('size');
            $table->float('price');
            $table->float('iva');
            $table->float('weight');
            $table->integer('stock');
            $table->string('thumbnail');
            $table->text('images')->nullable();
            $table->boolean('visible')->default(1);
            $table->boolean('disabled')->default(0);
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
