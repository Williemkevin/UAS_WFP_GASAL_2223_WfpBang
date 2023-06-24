<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeIdToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            //            //Buat kolom yang akan menjadi foreign key
            $table->unsignedBigInteger('type_id');

            //Set kolom tersebut menjadi foreign key
            $table->foreign('type_id')->references('id')->on('types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //Hilangkan dulu foreign keynya
            $table->dropForeign(['type_id']);

            //Hapus kolom
            $table->dropColumn('type_id');
        });
    }
}
