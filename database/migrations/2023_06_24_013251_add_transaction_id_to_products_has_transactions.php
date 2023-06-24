<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransactionIdToProductsHasTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products_has_transactions', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('transaction_id');
            $table->foreign('transaction_id')->references('id')->on('transactions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products_has_transactions', function (Blueprint $table) {
            //
            $table->dropForeign(['transaction_id']);

            //Hapus kolom
            $table->dropColumn('transaction_id');
        });
    }
}
