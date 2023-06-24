<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStaffIdToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            //Buat kolom yang akan menjadi foreign key
            $table->unsignedBigInteger('staff_id');

            //Set kolom tersebut menjadi foreign key
            $table->foreign('staff_id')->references('id')->on('staffs');
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
            //
            //Hilangkan dulu foreign keynya
            $table->dropForeign(['staff_id']);

            //Hapus kolom
            $table->dropColumn('staff_id');
        });
    }
}
