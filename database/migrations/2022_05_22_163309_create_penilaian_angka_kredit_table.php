<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianAngkaKreditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_angka_kredit', function (Blueprint $table) {
            $table->string('no_dupak', 10)->primary();
            $table->string('nik', 10);
            $table->foreign('nik')->references('nik')->on('pegawai')->onUpdate('cascade')->onDelete('cascade');
            $table->date('masa_penilaian_awal');
            $table->date('masa_penilaian_akhir');
            $table->date('tanggal_usulan');
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
        Schema::dropIfExists('penilaian_angka_kredit');
    }
}
