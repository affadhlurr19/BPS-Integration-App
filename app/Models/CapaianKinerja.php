<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapaianKinerja extends Model
{
    use HasFactory;
    protected $table="capaian_kinerja";
    public $primaryKey = 'id_ckp';
    protected $fillable = [
        'nik', 'kategori','periode','detail_pekerjaan','tgl_pelaksanaan','tgl_masuk','catatan_operator','nilai'
    ];
}
