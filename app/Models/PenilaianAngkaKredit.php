<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianAngkaKredit extends Model
{
    protected $table="penilaian_angka_kredit";
    public $primaryKey = 'no_dupak';
    protected $fillable = [
        'no_dupak','nik','masa_penilaian_awal','masa_penilaian_akhir','tanggal_usulan'
    ];
}
