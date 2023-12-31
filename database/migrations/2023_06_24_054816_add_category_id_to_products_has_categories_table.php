<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToProductsHasCategoriesTable extends Migration
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
            $table->unsignedBigInteger('category_id');

            //Set kolom tersebut menjadi foreign key
            $table->foreign('category_id')->references('id')->on('categories');
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
            $table->dropForeign(['category_id']);

            //Hapus kolom
            $table->dropColumn('category_id');
        });
    }
}
