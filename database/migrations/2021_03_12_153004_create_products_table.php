<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->unsignedBigInteger('collection_id')->index();
            $table->boolean('standout')->default(0);
            $table->boolean('outlet')->default(0);
            $table->unsignedBigInteger('type_id')->index();
            $table->string('color');
            $table->string('size');
            $table->string('price');
            $table->float('weight');
            $table->integer('stock');
            $table->string('thumbnail');
            $table->string('images')->nullable();
            $table->boolean('visible')->default(1);
            $table->text('description');
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
        Schema::dropIfExists('products');
    }
}
