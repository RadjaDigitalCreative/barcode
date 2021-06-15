<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('role_id')->nullable();
            $table->string('category_id')->nullable();
            $table->string('product')->nullable();
            $table->string('brand')->nullable();
            $table->integer('price')->nullable();
            $table->integer('purchase_price')->nullable();
            $table->integer('status')->nullable();
            $table->integer('stock')->nullable();
            $table->integer('unit')->nullable();
            $table->string('image')->nullable();
            $table->date('time_act')->nullable();
            $table->date('time_exp')->nullable();
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
        Schema::dropIfExists('product');
    }
}
