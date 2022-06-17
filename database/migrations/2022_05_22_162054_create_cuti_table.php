<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCutiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuti', function (Blueprint $table) {
            $table->id('id_permintaan_cuti');
            $table->string('nik', 10);
            $table->foreign('nik')->references('nik')->on('pegawai')->onUpdate('cascade')->onDelete('cascade');
            $table->date('tgl_pengajuan');
            $table->date('tgl_mulai_cuti');
            $table->date('tgl_selesai_cuti');
            $table->text('alasan_cuti');
            $table->string('status')->default('Belum Di Acc');
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
        Schema::dropIfExists('cuti');
    }
}
