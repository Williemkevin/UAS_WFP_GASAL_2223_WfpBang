<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('owners', function (Blueprint $table) {
            //Buat kolom yang akan menjadi foreign key
            $table->unsignedBigInteger('user_id');

            //Set kolom tersebut menjadi foreign key
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('owners', function (Blueprint $table) {
            //Hilangkan dulu foreign keynya
            $table->dropForeign(['user_id']);

            //Hapus kolom
            $table->dropColumn('user_id');
        });
    }
}
