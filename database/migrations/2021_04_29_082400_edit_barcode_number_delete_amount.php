<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditBarcodeNumberDeleteAmount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barcode_products', function (Blueprint $table) {
            $table->dropColumn('barcode_number');
            $table->dropColumn('amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barcode_products', function (Blueprint $table) {
            $table->integer('barcode_number');
            $table->integer('number');
        });
    }
}
