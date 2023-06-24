<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBuyerIdToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            //
            //Buat kolom yang akan menjadi foreign key
            $table->unsignedBigInteger('buyer_id');

            //Set kolom tersebut menjadi foreign key
            $table->foreign('buyer_id')->references('id')->on('buyers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            //            //Hilangkan dulu foreign keynya
            $table->dropForeign(['buyer_id']);

            //Hapus kolom
            $table->dropColumn('buyer_id');
        });
    }
}
