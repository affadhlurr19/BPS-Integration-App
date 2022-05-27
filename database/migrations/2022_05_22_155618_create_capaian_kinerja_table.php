<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapaianKinerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capaian_kinerja', function (Blueprint $table) {
            $table->id('id_ckp');
            $table->string('nik', 10);
            $table->foreign('nik')->references('nik')->on('pegawai')->onUpdate('cascade')->onDelete('cascade');
            $table->string('kategori');
            $table->string('periode');
            $table->string('detail_pekerjaan');
            $table->date('tgl_pelaksanaan');
            $table->date('tgl_masuk');
            $table->string('catatan_operator');
            $table->integer('nilai');
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
        Schema::dropIfExists('capaian_kinerja');
    }
}
