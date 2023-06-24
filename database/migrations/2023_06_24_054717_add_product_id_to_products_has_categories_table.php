<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductIdToProductsHasCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products_has_categories', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('product_id');

            //Set kolom tersebut menjadi foreign key
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products_has_categories', function (Blueprint $table) {
            //
            $table->dropForeign(['product_id']);

            //Hapus kolom
            $table->dropColumn('product_id');
        });
    }
}
