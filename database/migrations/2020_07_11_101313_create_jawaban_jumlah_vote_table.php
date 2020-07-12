<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabanJumlahVoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban_jumlah_vote', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('jawaban_id');
            $table->unsignedBigInteger('jumlah_vote_id');
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
        Schema::dropIfExists('jawaban_jumlah_vote');
    }
}
