<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Pegawai;
use App\Models\Absensi;
use App\Models\Cuti;
use App\Models\PenilaianAngkaKredit;
use App\Models\Kegiatan;
use App\Models\CapaianKinerja;
use Auth;

class PegawaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function showMyProfile()
    {
        $data = DB::table('pegawai')->where('nik', Auth::user()->nik)->first();

        return view('pegawai.index', compact('data'));
    }

    public function updateMyProfile(Request $request, $id)
    {
        $data = Pegawai::find($id);                    

        $validate = $request->validate([                        
            'nama_pegawai' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],            
            'jenis_kelamin' => ['required'],
            'alamat' => ['required'],
            'tim' => ['required'],
            'agama' => ['required'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'nomor_telepon' => ['required', 'string', 'max:13']                          
        ]);
        
        $data->nama_pegawai = $request->nama_pegawai;
        $data->email = $request->email;        
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->alamat = $request->alamat;
        $data->tim = $request->tim;
        $data->agama = $request->agama;
        $data->tempat_lahir = $request->tempat_lahir;
        $data->tanggal_lahir = $request->tanggal_lahir;
        $data->nomor_telepon = $request->nomor_telepon;        
        $data->save();    
        
        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }

    public function showDataAbsensi()
    {
        $data = DB::table('absensi')
                ->select('absensi.id_absensi', 'pegawai.nik', 'absensi.tanggal', 'absensi.jam_masuk', 'absensi.jam_pulang')
                ->join('pegawai', 'pegawai.nik', '=', 'absensi.nik')
                ->where('pegawai.nik', Auth::user()->nik)
                ->orderBy('absensi.tanggal', 'DESC')
                ->orderBy('absensi.jam_masuk', 'DESC')
                ->orderBy('absensi.jam_pulang', 'DESC')
                ->paginate(4);   
        
        return view('pegawai.show_data_absensi', compact('data'));
    }

    public function cariDataAbsensi(Request $request)
    {
        $keyword = $request->search;
        $kategori = $request->kategori;
                                
        if($kategori == "nik"){
            $data = DB::table('absensi')
                ->select('absensi.id_absensi', 'pegawai.nik', 'absensi.tanggal', 'absensi.jam_masuk', 'absensi.jam_pulang')
                ->join('pegawai', 'pegawai.nik', '=', 'absensi.nik')
                ->where('pegawai.nik', Auth::user()->nik)
                ->where('pegawai.'.$kategori, 'like', "%". $keyword . "%")
                ->orderBy('absensi.tanggal', 'DESC')
                ->orderBy('absensi.jam_masuk', 'DESC')
                ->orderBy('absensi.jam_pulang', 'DESC')
                ->paginate();       
        }else{
            $data = DB::table('absensi')
                ->select('absensi.id_absensi', 'pegawai.nik', 'absensi.tanggal', 'absensi.jam_masuk', 'absensi.jam_pulang')
                ->join('pegawai', 'pegawai.nik', '=', 'absensi.nik')
                ->where('pegawai.nik', Auth::user()->nik)
                ->where($kategori, 'like', "%". $keyword . "%")
                ->orderBy('absensi.tanggal', 'DESC')
                ->orderBy('absensi.jam_masuk', 'DESC')
                ->orderBy('absensi.jam_pulang', 'DESC')
                ->paginate();   
        }        
        
        return view('pegawai.show_data_absensi', compact('data'));
    }   
    
    public function postDataAbsensi(Request $request)
    {          
        $validate = $request->validate([     
            'nik' => ['required'],
            'tanggal' => ['required'],
            'jam_masuk' => ['required'],            
            'jam_pulang' => ['required']                       
        ]);

        $data = new Absensi;
        $data->nik = $request->nik;
        $data->tanggal = $request->tanggal;
        $data->jam_masuk = $request->jam_masuk;        
        $data->jam_pulang = $request->jam_pulang;            
        $data->save();    
        
        return redirect()->back()->with('success', 'Data Berhasil Ditambah');
    }

    public function updateDataAbsensi(Request $request, $id)
    {
        $data = Absensi::find($id);                    

        $validate = $request->validate([            
            'tanggal' => ['required'],
            'jam_masuk' => ['required'],            
            'jam_pulang' => ['required']                       
        ]);

        $data->tanggal = $request->tanggal;
        $data->jam_masuk = $request->jam_masuk;        
        $data->jam_pulang = $request->jam_pulang;            
        $data->save();    
        
        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }

    public function deleteDataAbsensi($id)
    {
        $data = Absensi::find($id);
        $data->delete();

        return redirect(route('pegawai.show.data.absensi'))->with('success', 'Data Berhasil Dihapus!');
    }

    public function showDataCuti()
    {
        $data = DB::table('cuti')
                ->select('cuti.id_permintaan_cuti', 'pegawai.nik', 'cuti.tgl_pengajuan', 'cuti.tgl_mulai_cuti', 
                        'cuti.tgl_selesai_cuti', 'cuti.alasan_cuti', 'status')
                ->join('pegawai', 'pegawai.nik', '=', 'cuti.nik')
                ->where('pegawai.nik', Auth::user()->nik)
                ->orderBy('cuti.tgl_pengajuan', 'DESC')  
                ->paginate(4);   
        
        return view('pegawai.show_data_cuti', compact('data'));
    }

    public function cariDataCuti(Request $request)
    {
        $keyword = $request->search;
        $kategori = $request->kategori;
                                
        if($kategori == "nik"){
            $data = DB::table('cuti')
                ->select('cuti.id_permintaan_cuti', 'pegawai.nik', 'cuti.tgl_pengajuan', 'cuti.tgl_mulai_cuti', 
                        'cuti.tgl_selesai_cuti', 'cuti.alasan_cuti', 'status')
                ->join('pegawai', 'pegawai.nik', '=', 'cuti.nik')
                ->where('pegawai.nik', Auth::user()->nik)
                ->where('pegawai.'.$kategori, 'like', "%". $keyword . "%")
                ->orderBy('cuti.tgl_pengajuan', 'DESC')  
                ->paginate();     
        }else{
            $data = DB::table('cuti')
                ->select('cuti.id_permintaan_cuti', 'pegawai.nik', 'cuti.tgl_pengajuan', 'cuti.tgl_mulai_cuti', 
                        'cuti.tgl_selesai_cuti', 'cuti.alasan_cuti', 'status')
                ->join('pegawai', 'pegawai.nik', '=', 'cuti.nik')
                ->where('pegawai.nik', Auth::user()->nik)
                ->where($kategori, 'like', "%". $keyword . "%")
                ->orderBy('cuti.tgl_pengajuan', 'DESC')  
                ->paginate();   
        }        
        
        return view('pegawai.show_data_cuti', compact('data'));
    }   

    public function postDataCuti(Request $request)
    {                          
        $validate = $request->validate([      
            'nik' => ['required'],      
            'tgl_pengajuan' => ['required'],
            'tgl_mulai_cuti' => ['required'],            
            'tgl_selesai_cuti' => ['required'],                       
            'alasan_cuti' => ['required']            
        ]);

        $data = new Cuti;        
        $data->nik = $request->nik;
        $data->tgl_pengajuan = $request->tgl_pengajuan;
        $data->tgl_mulai_cuti = $request->tgl_mulai_cuti;        
        $data->tgl_selesai_cuti = $request->tgl_selesai_cuti;            
        $data->alasan_cuti = $request->alasan_cuti;          
        $data->save();    
        
        return redirect()->back()->with('success', 'Data Berhasil Ditambah');
    }
    
    public function updateDataCuti(Request $request, $id)
    {
        $data = Cuti::find($id);                    

        $validate = $request->validate([            
            'tgl_pengajuan' => ['required'],
            'tgl_mulai_cuti' => ['required'],            
            'tgl_selesai_cuti' => ['required'],                       
            'alasan_cuti' => ['required']            
        ]);

        $data->tgl_pengajuan = $request->tgl_pengajuan;
        $data->tgl_mulai_cuti = $request->tgl_mulai_cuti;        
        $data->tgl_selesai_cuti = $request->tgl_selesai_cuti;            
        $data->alasan_cuti = $request->alasan_cuti;          
        $data->save();    
        
        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }

    public function deleteDataCuti($id)
    {
        $data = Cuti::find($id);
        $data->delete();

        return redirect(route('pegawai.show.data.cuti'))->with('success', 'Data Berhasil Dihapus!');
    }

    public function showDataAngkaKredit()   
    {
        $data = DB::table('penilaian_angka_kredit')
                ->select('penilaian_angka_kredit.no_dupak', 'pegawai.nik', 'penilaian_angka_kredit.masa_penilaian_awal', 'penilaian_angka_kredit.masa_penilaian_akhir', 
                        'penilaian_angka_kredit.tanggal_usulan')
                ->join('pegawai', 'pegawai.nik', '=', 'penilaian_angka_kredit.nik')
                ->where('pegawai.nik', Auth::user()->nik)
                ->orderBy('penilaian_angka_kredit.created_at', 'DESC')  
                ->paginate(4);  
        
        return view('pegawai.show_data_angka_kredit', compact('data'));
    }

    public function cariDataAngkaKredit(Request $request)
    {
        $keyword = $request->search;
        $kategori = $request->kategori;
                                
        if($kategori == "nik"){
            $data = DB::table('penilaian_angka_kredit')
                ->select('penilaian_angka_kredit.no_dupak', 'pegawai.nik', 'penilaian_angka_kredit.masa_penilaian_awal', 'penilaian_angka_kredit.masa_penilaian_akhir', 
                        'penilaian_angka_kredit.tanggal_usulan')
                ->join('pegawai', 'pegawai.nik', '=', 'penilaian_angka_kredit.nik')
                ->where('pegawai.nik', Auth::user()->nik)
                ->where('pegawai.'.$kategori, 'like', "%". $keyword . "%")
                ->orderBy('penilaian_angka_kredit.created_at', 'DESC')  
                ->paginate();             
        }else{
            $data = DB::table('penilaian_angka_kredit')
                ->select('penilaian_angka_kredit.no_dupak', 'pegawai.nik', 'penilaian_angka_kredit.masa_penilaian_awal', 'penilaian_angka_kredit.masa_penilaian_akhir', 
                        'penilaian_angka_kredit.tanggal_usulan')
                ->join('pegawai', 'pegawai.nik', '=', 'penilaian_angka_kredit.nik')
                ->where('pegawai.nik', Auth::user()->nik)
                ->where($kategori, 'like', "%". $keyword . "%")
                ->orderBy('penilaian_angka_kredit.created_at', 'DESC')  
                ->paginate();               
        }        
        
        return view('pegawai.show_data_angka_kredit', compact('data'));
    }   
    
    public function postDataAngkaKredit(Request $request)
    {    
        $validate = $request->validate([            
            'no_dupak' => ['required'],
            'nik' => ['required'],
            'masa_penilaian_awal' => ['required'],
            'masa_penilaian_akhir' => ['required'],            
            'tanggal_usulan' => ['required']                                             
        ]);

        $data = new PenilaianAngkaKredit;
        $data->no_dupak = $request->no_dupak;
        $data->nik = $request->nik;
        $data->masa_penilaian_awal = $request->masa_penilaian_awal;
        $data->masa_penilaian_akhir = $request->masa_penilaian_akhir;        
        $data->tanggal_usulan = $request->tanggal_usulan;                
        $data->save();    
        
        return redirect()->back()->with('success', 'Data Berhasil Ditambah');
    }

    public function updateDataAngkaKredit(Request $request, $id)
    {
        $data = PenilaianAngkaKredit::find($id);                    

        $validate = $request->validate([            
            'masa_penilaian_awal' => ['required'],
            'masa_penilaian_akhir' => ['required'],            
            'tanggal_usulan' => ['required']                                             
        ]);

        $data->masa_penilaian_awal = $request->masa_penilaian_awal;
        $data->masa_penilaian_akhir = $request->masa_penilaian_akhir;        
        $data->tanggal_usulan = $request->tanggal_usulan;                
        $data->save();    
        
        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }

    public function deleteDataAngkaKredit($id)
    {
        $data = PenilaianAngkaKredit::find($id);
        $data->delete();

        return redirect(route('pegawai.show.data.angka.kredit'))->with('success', 'Data Berhasil Dihapus!');
    }

    public function showDataKegiatan()
    {
        $data = DB::table('kegiatan')
                ->select('kegiatan.id_kegiatan', 'pegawai.nik', 'kegiatan.nama_kegiatan', 'kegiatan.asal_kegiatan', 
                        'kegiatan.target', 'kegiatan.realisasi', 'kegiatan.batas_waktu',
                        'kegiatan.tgl_realisasi', 'kegiatan.keterangan')
                ->join('pegawai', 'pegawai.nik', '=', 'kegiatan.nik')
                ->where('pegawai.nik', Auth::user()->nik)
                ->orderBy('kegiatan.created_at', 'DESC')  
                ->paginate(4);  
        
        return view('pegawai.show_data_kegiatan', compact('data'));
    }

    public function cariDataKegiatan(Request $request)
    {
        $keyword = $request->search;
        $kategori = $request->kategori;
                                
        if($kategori == "nik"){
            $data = DB::table('kegiatan')
                    ->select('kegiatan.id_kegiatan', 'pegawai.nik', 'kegiatan.nama_kegiatan', 'kegiatan.asal_kegiatan', 
                            'kegiatan.target', 'kegiatan.realisasi', 'kegiatan.batas_waktu',
                            'kegiatan.tgl_realisasi', 'kegiatan.keterangan')
                    ->join('pegawai', 'pegawai.nik', '=', 'kegiatan.nik')
                    ->where('pegawai.nik', Auth::user()->nik)
                    ->where('pegawai.'.$kategori, 'like', "%". $keyword . "%")
                    ->orderBy('kegiatan.created_at', 'DESC')  
                    ->paginate();                    
        }else{
            $data = DB::table('kegiatan')
                    ->select('kegiatan.id_kegiatan', 'pegawai.nik', 'kegiatan.nama_kegiatan', 'kegiatan.asal_kegiatan', 
                            'kegiatan.target', 'kegiatan.realisasi', 'kegiatan.batas_waktu',
                            'kegiatan.tgl_realisasi', 'kegiatan.keterangan')
                    ->join('pegawai', 'pegawai.nik', '=', 'kegiatan.nik')
                    ->where('pegawai.nik', Auth::user()->nik)
                    ->where($kategori, 'like', "%". $keyword . "%")
                    ->orderBy('kegiatan.created_at', 'DESC')  
                    ->paginate();                
        }        
        
        return view('pegawai.show_data_kegiatan', compact('data'));
    }   
    
    public function postDataKegiatan(Request $request)
    {                          
        $validate = $request->validate([            
            'id_kegiatan' => ['required'],
            'nik' => ['required'],
            'nama_kegiatan' => ['required'],
            'asal_kegiatan' => ['required'],            
            'target' => ['required'],
            'realisasi' => ['required'],
            'batas_waktu' => ['required'],
            'tgl_realisasi' => ['required']            
        ]);

        $data = new Kegiatan;
        $data->id_kegiatan = $request->id_kegiatan;
        $data->nik = $request->nik;
        $data->nama_kegiatan = $request->nama_kegiatan;
        $data->asal_kegiatan = $request->asal_kegiatan;        
        $data->target = $request->target;                
        $data->realisasi = $request->realisasi;            
        $data->batas_waktu = $request->batas_waktu;            
        $data->tgl_realisasi = $request->tgl_realisasi;                          
        $data->save();    
        
        return redirect()->back()->with('success', 'Data Berhasil Ditambah');
    }

    public function updateDataKegiatan(Request $request, $id)
    {
        $data = Kegiatan::find($id);                    

        $validate = $request->validate([            
            'nama_kegiatan' => ['required'],
            'asal_kegiatan' => ['required'],            
            'target' => ['required'],
            'realisasi' => ['required'],
            'batas_waktu' => ['required'],
            'tgl_realisasi' => ['required']            
        ]);

        $data->nama_kegiatan = $request->nama_kegiatan;
        $data->asal_kegiatan = $request->asal_kegiatan;        
        $data->target = $request->target;                
        $data->realisasi = $request->realisasi;            
        $data->batas_waktu = $request->batas_waktu;            
        $data->tgl_realisasi = $request->tgl_realisasi;                              
        $data->save();    
        
        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }

    public function deleteDataKegiatan($id)
    {
        $data = Kegiatan::find($id);
        $data->delete();

        return redirect(route('pegawai.show.data.kegiatan'))->with('success', 'Data Berhasil Dihapus!');
    }

    public function showDataCapaianKinerja()
    {
        $data = DB::table('capaian_kinerja')
                ->select('capaian_kinerja.id_ckp', 'pegawai.nik', 'capaian_kinerja.kategori', 'capaian_kinerja.periode', 
                        'capaian_kinerja.detail_pekerjaan', 'capaian_kinerja.tgl_pelaksanaan', 'capaian_kinerja.tgl_masuk', 'capaian_kinerja.catatan_operator',
                        'capaian_kinerja.nilai')
                ->join('pegawai', 'pegawai.nik', '=', 'capaian_kinerja.nik')
                ->where('pegawai.nik', Auth::user()->nik)
                ->orderBy('capaian_kinerja.tgl_masuk', 'DESC')  
                ->paginate(4);  
        
        return view('pegawai.show_data_capaian_kinerja', compact('data'));
    }

    public function cariDataCapaianKinerja(Request $request)
    {
        $keyword = $request->search;
        $kategori = $request->kategori;
                                
        if($kategori == "nik"){
            $data = DB::table('capaian_kinerja')
                    ->select('capaian_kinerja.id_ckp', 'pegawai.nik', 'capaian_kinerja.kategori', 'capaian_kinerja.periode', 
                            'capaian_kinerja.detail_pekerjaan', 'capaian_kinerja.tgl_pelaksanaan', 'capaian_kinerja.tgl_masuk', 'capaian_kinerja.catatan_operator',
                            'capaian_kinerja.nilai')
                    ->join('pegawai', 'pegawai.nik', '=', 'capaian_kinerja.nik')
                    ->where('pegawai.nik', Auth::user()->nik)
                    ->where('pegawai.'.$kategori, 'like', "%". $keyword . "%")
                    ->orderBy('capaian_kinerja.tgl_masuk', 'DESC')  
                    ->paginate();                                
        }else{
            $data = DB::table('capaian_kinerja')
                    ->select('capaian_kinerja.id_ckp', 'pegawai.nik', 'capaian_kinerja.kategori', 'capaian_kinerja.periode', 
                            'capaian_kinerja.detail_pekerjaan', 'capaian_kinerja.tgl_pelaksanaan', 'capaian_kinerja.tgl_masuk', 'capaian_kinerja.catatan_operator',
                            'capaian_kinerja.nilai')
                    ->join('pegawai', 'pegawai.nik', '=', 'capaian_kinerja.nik')
                    ->where('pegawai.nik', Auth::user()->nik)
                    ->where($kategori, 'like', "%". $keyword . "%")
                    ->orderBy('capaian_kinerja.tgl_masuk', 'DESC')  
                    ->paginate();               
        }        
        
        return view('pegawai.show_data_capaian_kinerja', compact('data'));
    }   
    
    public function postDataCapaianKinerja(Request $request)
    {
         $validate = $request->validate([            
            'nik' => ['required'],
            'kategori' => ['required'],
            'periode' => ['required'],            
            'detail_pekerjaan' => ['required'],
            'tgl_pelaksanaan' => ['required'],
            'tgl_masuk' => ['required']
        ]);

        $data = new CapaianKinerja;
        $data->nik = $request->nik;
        $data->kategori = $request->kategori;
        $data->periode = $request->periode;        
        $data->detail_pekerjaan = $request->detail_pekerjaan;                
        $data->tgl_pelaksanaan = $request->tgl_pelaksanaan;            
        $data->tgl_masuk = $request->tgl_masuk;                            
        $data->save();    
        
        return redirect()->back()->with('success', 'Data Berhasil Ditambah');
    }

    public function updateDataCapaianKinerja(Request $request, $id)
    {
        $data = CapaianKinerja::find($id);                    

        $validate = $request->validate([            
            'kategori' => ['required'],
            'periode' => ['required'],            
            'detail_pekerjaan' => ['required'],
            'tgl_pelaksanaan' => ['required'],
            'tgl_masuk' => ['required']
        ]);

        $data->kategori = $request->kategori;
        $data->periode = $request->periode;        
        $data->detail_pekerjaan = $request->detail_pekerjaan;                
        $data->tgl_pelaksanaan = $request->tgl_pelaksanaan;            
        $data->tgl_masuk = $request->tgl_masuk;                         
        $data->save();    
        
        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }

    public function deleteDataCapaianKinerja($id)
    {
        $data = CapaianKinerja::find($id);
        $data->delete();

        return redirect(route('pegawai.show.data.capaian.kinerja'))->with('success', 'Data Berhasil Dihapus!');
    }
}
