<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    protected $table="kegiatan";
    public $primaryKey = 'id_kegiatan';
    protected $fillable = [
        'id_kegiatan', 'nik','nama_kegiatan','asal_kegiatan','target',
        'realisasi', 'satuan', 'batas_waktu', 'tgl_realisasi', 'keterangan'
    ];
}
