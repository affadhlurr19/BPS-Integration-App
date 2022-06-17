<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->string('id_kegiatan', 10)->primary();
            $table->string('nik', 10);
            $table->foreign('nik')->references('nik')->on('pegawai')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama_kegiatan');
            $table->string('asal_kegiatan');
            $table->integer('target');
            $table->integer('realisasi');            
            $table->date('batas_waktu');
            $table->date('tgl_realisasi');
            $table->text('keterangan')->default('Belum Terlaksana');
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
        Schema::dropIfExists('kegiatan');
    }
}

