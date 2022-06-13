<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Pegawai;
use Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function showDataPegawai()
    {
        $data = DB::table('pegawai')->select('*')->orderBy('nik', 'ASC')->paginate(4);   
        
        return view('admin.show_data_pegawai', compact('data'));
    }

    public function showDataAbsensi()
    {
        $data = DB::table('absensi')
                ->select('absensi.id_absensi', 'pegawai.nik', 'absensi.tanggal', 'absensi.jam_masuk', 'absensi.jam_pulang')
                ->join('pegawai', 'pegawai.nik', '=', 'absensi.nik')
                ->orderBy('absensi.tanggal', 'DESC')
                ->orderBy('absensi.jam_masuk', 'DESC')
                ->orderBy('absensi.jam_pulang', 'DESC')
                ->paginate(4);   
        
        return view('admin.show_data_absensi', compact('data'));
    }

    public function showDataCuti()
    {
        $data = DB::table('cuti')
                ->select('cuti.id_permintaan_cuti', 'pegawai.nik', 'cuti.tgl_pengajuan', 'cuti.tgl_mulai_cuti', 
                        'cuti.tgl_selesai_cuti', 'cuti.alasan_cuti', 'status')
                ->join('pegawai', 'pegawai.nik', '=', 'cuti.nik')
                ->orderBy('cuti.tgl_pengajuan', 'DESC')  
                ->paginate(4);   
        
        return view('admin.show_data_cuti', compact('data'));
    }

    public function showDataAngkaKredit()   
    {
        $data = DB::table('penilaian_angka_kredit')
                ->select('penilaian_angka_kredit.no_dupak', 'pegawai.nik', 'penilaian_angka_kredit.masa_penilaian_awal', 'penilaian_angka_kredit.masa_penilaian_akhir', 
                        'penilaian_angka_kredit.tanggal_usulan')
                ->join('pegawai', 'pegawai.nik', '=', 'penilaian_angka_kredit.nik')
                ->orderBy('penilaian_angka_kredit.tanggal_usulan', 'DESC')  
                ->paginate(4);  
        
        return view('admin.show_data_angka_kredit', compact('data'));
    }

    public function showDataKegiatan()
    {
        $data = DB::table('kegiatan')
                ->select('kegiatan.id_kegiatan', 'pegawai.nik', 'kegiatan.nama_kegiatan', 'kegiatan.asal_kegiatan', 
                        'kegiatan.target', 'kegiatan.realisasi', 'kegiatan.satuan', 'kegiatan.batas_waktu',
                        'kegiatan.tgl_realisasi', 'kegiatan.keterangan')
                ->join('pegawai', 'pegawai.nik', '=', 'kegiatan.nik')
                ->orderBy('kegiatan.created_at', 'DESC')  
                ->paginate(4);  
        
        return view('admin.show_data_kegiatan', compact('data'));
    }
 
    public function showDataCapaianKinerja()
    {
        $data = DB::table('capaian_kinerja')
                ->select('capaian_kinerja.id_ckp', 'pegawai.nik', 'capaian_kinerja.kategori', 'capaian_kinerja.periode', 
                        'capaian_kinerja.detail_pekerjaan', 'capaian_kinerja.tgl_pelaksanaan', 'capaian_kinerja.tgl_masuk', 'capaian_kinerja.catatan_operator',
                        'capaian_kinerja.nilai')
                ->join('pegawai', 'pegawai.nik', '=', 'capaian_kinerja.nik')
                ->orderBy('capaian_kinerja.tgl_masuk', 'DESC')  
                ->paginate(4);  
        
        return view('admin.show_data_capaian_kinerja', compact('data'));
    }
}
