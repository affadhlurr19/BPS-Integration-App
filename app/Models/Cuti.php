<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;
    protected $table = "cuti";
    public $primaryKey = "id_permintaan_cuti";
    protected $fillable = [
        'nik', 'tgl_pengajuan','tgl_mulai_cuti','tgl_selesai_cuti','alasan_cuti', 'status'
    ];
}
