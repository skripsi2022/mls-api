<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban', function (Blueprint $table) {
            $table->increments('id_jawaban');
            $table->integer('soal_id')->unsigned();
            $table->integer('ujian_id')->unsigned();
            $table->integer('siswa_id')->unsigned();
            $table->string('isi_jawaban');
            $table->string('ket_jawaban');
            $table->string('opsi_jawaban');
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('soal_id')->references('id_soal')->on('soal');
            $table->foreign('ujian_id')->references('id_ujian')->on('ujian');
            $table->foreign('siswa_id')->references('id_siswa')->on('siswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jawaban');
    }
}
