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

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {        
        //STATISTIK CUTI
        $belum_acc = DB::table('cuti')                                        
                            ->select(DB::raw('count(*) AS total'))
                            ->where('status', '=', 'Belum Di Acc')                        
                            ->groupBy('status')                                                    
                            ->get(); 
        $sudah_acc = DB::table('cuti')                                        
                            ->select(DB::raw('count(*) AS total'))
                            ->where('status', '=', 'Sudah Di Acc')                        
                            ->groupBy('status')                                                    
                            ->get(); 
        $data_belum_acc = [];   
        $data_sudah_acc = [];   
        foreach($belum_acc as $value){
            $data_belum_acc[] = $value->total;            
        }   
        foreach($sudah_acc as $value2){
            $data_sudah_acc[] = $value2->total;            
        }         
        
        //STATISTIK ABSENSI
        $masuk_tepat = DB::table('absensi')                                        
                            ->select(DB::raw('count(*) AS total'))
                            ->where('jam_masuk', '<=', '08:00:00')                                                                                                      
                            ->get();         
        $masuk_telat = DB::table('absensi')                                        
                            ->select(DB::raw('count(*) AS total'))
                            ->where('jam_masuk', '>', '08:00:00')                                                                                                   
                            ->get(); 
        $pulang_tepat = DB::table('absensi')                                        
                            ->select(DB::raw('count(*) AS total'))
                            ->where('jam_pulang', '<=', '17:00:00')                                                                                                   
                            ->get(); 
        $pulang_telat = DB::table('absensi')                                        
                            ->select(DB::raw('count(*) AS total'))
                            ->where('jam_pulang', '>', '17:00:00')                                                                                                   
                            ->get();     
        $data_masuk_tepat = [];   
        $data_masuk_telat = [];   
        $data_pulang_tepat = [];   
        $data_pulang_telat = [];   
        foreach($masuk_tepat as $value){
            $data_masuk_tepat[] = $value->total;            
        }   
        foreach($masuk_telat as $value2){
            $data_masuk_telat[] = $value2->total;            
        }  
        foreach($pulang_tepat as $value3){
            $data_pulang_tepat[] = $value3->total;            
        }  
        foreach($pulang_telat as $value4){
            $data_pulang_telat[] = $value4->total;            
        }  
        
        //STATISTIK KEGIATAN
        $kegiatan_terlaksana = DB::table('kegiatan')                                        
                                ->select(DB::raw('count(*) AS total'))
                                ->where('keterangan', '=', 'Terlaksana')    
                                ->groupBy('keterangan')                                                                                                  
                                ->get(); 
        $kegiatan_blm_terlaksana = DB::table('kegiatan')                                        
                                ->select(DB::raw('count(*) AS total'))
                                ->where('keterangan', '=', 'Belum Terlaksana')    
                                ->groupBy('keterangan')                                                                                                  
                                ->get(); 
        $data_kegiatan_terlaksana = [];   
        $data_kegiatan_blm_terlaksana = [];   
        foreach($kegiatan_terlaksana as $value){
            $data_kegiatan_terlaksana[] = $value->total;            
        }   
        foreach($kegiatan_blm_terlaksana as $value2){
            $data_kegiatan_blm_terlaksana[] = $value2->total;            
        }                  

        //STATISTIK CAPAIAN KINERJA
        $nilai_100 = DB::table('capaian_kinerja')                                        
                    ->select(DB::raw('count(*) AS total'))
                    ->where('nilai', '=', '100')                                                                                                                        
                    ->get(); 
        $nilai_90 = DB::table('capaian_kinerja')                                        
                    ->select(DB::raw('count(*) AS total'))
                    ->where('nilai', '>=', '90')
                    ->where('nilai', '<', '100')
                    ->get(); 
        $nilai_80 = DB::table('capaian_kinerja')                                        
                    ->select(DB::raw('count(*) AS total'))
                    ->where('nilai', '>=', '80')
                    ->where('nilai', '<', '90')
                    ->get(); 
        $nilai_70 = DB::table('capaian_kinerja')                                        
                    ->select(DB::raw('count(*) AS total'))
                    ->where('nilai', '>=', '70')
                    ->where('nilai', '<', '80')
                    ->get();
        $nilai_60 = DB::table('capaian_kinerja')                                        
                    ->select(DB::raw('count(*) AS total'))
                    ->where('nilai', '>=', '60')
                    ->where('nilai', '<', '70')
                    ->get();  
        $nilai_50 = DB::table('capaian_kinerja')                                        
                    ->select(DB::raw('count(*) AS total'))
                    ->where('nilai', '>=', '50')
                    ->where('nilai', '<', '60')
                    ->get();  
        $nilai_40 = DB::table('capaian_kinerja')                                        
                    ->select(DB::raw('count(*) AS total'))
                    ->where('nilai', '>=', '40')
                    ->where('nilai', '<', '50')
                    ->get(); 
        $nilai_30 = DB::table('capaian_kinerja')                                        
                    ->select(DB::raw('count(*) AS total'))
                    ->where('nilai', '>=', '30')
                    ->where('nilai', '<', '40')
                    ->get();   
        $nilai_20 = DB::table('capaian_kinerja')                                        
                    ->select(DB::raw('count(*) AS total'))
                    ->where('nilai', '>=', '20')
                    ->where('nilai', '<', '30')
                    ->get();
        $nilai_10 = DB::table('capaian_kinerja')                                        
                    ->select(DB::raw('count(*) AS total'))
                    ->where('nilai', '>=', '10')
                    ->where('nilai', '<', '20')
                    ->get();
        $nilai_0 = DB::table('capaian_kinerja')                                        
                    ->select(DB::raw('count(*) AS total'))
                    ->where('nilai', '=', '0')                    
                    ->get();                
        $data_nilai_100 = []; 
        $data_nilai_90 = []; 
        $data_nilai_80 = []; 
        $data_nilai_70 = []; 
        $data_nilai_60 = []; 
        $data_nilai_50 = []; 
        $data_nilai_40 = []; 
        $data_nilai_30 = []; 
        $data_nilai_20 = []; 
        $data_nilai_10 = []; 
        $data_nilai_0 = []; 
        foreach($nilai_100 as $value){
            $data_nilai_100[] = $value->total;            
        }   
        foreach($nilai_90 as $value2){
            $data_nilai_90[] = $value2->total;            
        }
        foreach($nilai_80 as $value3){
            $data_nilai_80[] = $value3->total;            
        }
        foreach($nilai_70 as $value4){
            $data_nilai_70[] = $value4->total;            
        }
        foreach($nilai_60 as $value5){
            $data_nilai_60[] = $value5->total;            
        }
        foreach($nilai_50 as $value6){
            $data_nilai_50[] = $value6->total;            
        }
        foreach($nilai_40 as $value7){
            $data_nilai_40[] = $value7->total;            
        }
        foreach($nilai_30 as $value8){
            $data_nilai_30[] = $value8->total;            
        }
        foreach($nilai_20 as $value9){
            $data_nilai_20[] = $value9->total;            
        }
        foreach($nilai_10 as $value10){
            $data_nilai_10[] = $value10->total;            
        }
        foreach($nilai_0 as $value11){
            $data_nilai_0[] = $value11->total;            
        }

        //DATA ANGKA KREDIT
        $kredit_jan = DB::table('penilaian_angka_kredit')                                        
                        ->select(DB::raw('count(*) AS total'))
                        ->whereBetween('tanggal_usulan', ['2022-01-01', '2022-01-31'])                    
                        ->get();  
        $kredit_feb = DB::table('penilaian_angka_kredit')                                        
                        ->select(DB::raw('count(*) AS total'))
                        ->whereBetween('tanggal_usulan', ['2022-02-01', '2022-02-28'])                    
                        ->get();  
        $kredit_mar = DB::table('penilaian_angka_kredit')                                        
                        ->select(DB::raw('count(*) AS total'))
                        ->whereBetween('tanggal_usulan', ['2022-03-01', '2022-03-31'])                    
                        ->get();  
        $kredit_apr = DB::table('penilaian_angka_kredit')                                        
                        ->select(DB::raw('count(*) AS total'))
                        ->whereBetween('tanggal_usulan', ['2022-04-01', '2022-04-30'])                    
                        ->get();  
        $kredit_mei = DB::table('penilaian_angka_kredit')                                        
                        ->select(DB::raw('count(*) AS total'))
                        ->whereBetween('tanggal_usulan', ['2022-05-01', '2022-05-31'])                    
                        ->get();  
        $kredit_jun = DB::table('penilaian_angka_kredit')                                        
                        ->select(DB::raw('count(*) AS total'))
                        ->whereBetween('tanggal_usulan', ['2022-06-01', '2022-06-30'])                    
                        ->get();  
        $kredit_jul = DB::table('penilaian_angka_kredit')                                        
                        ->select(DB::raw('count(*) AS total'))
                        ->whereBetween('tanggal_usulan', ['2022-07-01', '2022-07-31'])                    
                        ->get();          
        $kredit_agu = DB::table('penilaian_angka_kredit')                                        
                        ->select(DB::raw('count(*) AS total'))
                        ->whereBetween('tanggal_usulan', ['2022-08-01', '2022-08-31'])                    
                        ->get();  
        $kredit_sep = DB::table('penilaian_angka_kredit')                                        
                        ->select(DB::raw('count(*) AS total'))
                        ->whereBetween('tanggal_usulan', ['2022-09-01', '2022-09-30'])                    
                        ->get();  
        $kredit_okt = DB::table('penilaian_angka_kredit')                                        
                        ->select(DB::raw('count(*) AS total'))
                        ->whereBetween('tanggal_usulan', ['2022-10-01', '2022-10-31'])                    
                        ->get();  
        $kredit_nov = DB::table('penilaian_angka_kredit')                                        
                        ->select(DB::raw('count(*) AS total'))
                        ->whereBetween('tanggal_usulan', ['2022-11-01', '2022-11-30'])                    
                        ->get();  
        $kredit_des = DB::table('penilaian_angka_kredit')                                        
                        ->select(DB::raw('count(*) AS total'))
                        ->whereBetween('tanggal_usulan', ['2022-12-01', '2022-12-31'])                    
                        ->get();  
        $data_kredit_jan = []; 
        $data_kredit_feb = []; 
        $data_kredit_mar = []; 
        $data_kredit_apr = []; 
        $data_kredit_mei = []; 
        $data_kredit_jun = []; 
        $data_kredit_jul = []; 
        $data_kredit_agu = []; 
        $data_kredit_sep = []; 
        $data_kredit_okt = []; 
        $data_kredit_nov = []; 
        $data_kredit_des = []; 
        foreach($kredit_jan as $value){
            $data_kredit_jan[] = $value->total;            
        }
        foreach($kredit_feb as $value2){
            $data_kredit_feb[] = $value2->total;            
        }
        foreach($kredit_mar as $value3){
            $data_kredit_mar[] = $value3->total;            
        }
        foreach($kredit_apr as $value4){
            $data_kredit_apr[] = $value4->total;            
        }
        foreach($kredit_mei as $value5){
            $data_kredit_mei[] = $value5->total;            
        }
        foreach($kredit_jun as $value6){
            $data_kredit_jun[] = $value6->total;            
        }
        foreach($kredit_jul as $value7){
            $data_kredit_jul[] = $value7->total;            
        }
        foreach($kredit_agu as $value8){
            $data_kredit_agu[] = $value8->total;            
        }
        foreach($kredit_sep as $value9){
            $data_kredit_sep[] = $value9->total;            
        }
        foreach($kredit_okt as $value10){
            $data_kredit_okt[] = $value10->total;            
        }
        foreach($kredit_nov as $value11){
            $data_kredit_nov[] = $value11->total;            
        }
        foreach($kredit_des as $value12){
            $data_kredit_des[] = $value12->total;            
        }

        return view('admin.index', [
            //DATA CUTI
            'data_belum_acc' => $data_belum_acc, 
            'data_sudah_acc' => $data_sudah_acc,

            //DATA ABSENSI
            'data_masuk_tepat' => $data_masuk_tepat,
            'data_masuk_telat' => $data_masuk_telat,
            'data_pulang_tepat' => $data_pulang_tepat,
            'data_pulang_telat' => $data_pulang_telat,

            //DATA KEGIATAN
            'data_kegiatan_terlaksana' => $data_kegiatan_terlaksana,
            'data_kegiatan_blm_terlaksana' => $data_kegiatan_blm_terlaksana,

            //DATA CKP
            'data_nilai_100' => $data_nilai_100,
            'data_nilai_90' => $data_nilai_90,
            'data_nilai_80' => $data_nilai_80,
            'data_nilai_70' => $data_nilai_70,
            'data_nilai_60' => $data_nilai_60,
            'data_nilai_50' => $data_nilai_50,
            'data_nilai_40' => $data_nilai_40,
            'data_nilai_30' => $data_nilai_30,
            'data_nilai_20' => $data_nilai_20,
            'data_nilai_10' => $data_nilai_10,
            'data_nilai_0' => $data_nilai_0,  
            
            //DATA PENILAIAN ANGKA KREDIT
            'data_kredit_jan' => $data_kredit_jan,  
            'data_kredit_feb' => $data_kredit_feb,
            'data_kredit_mar' => $data_kredit_mar,
            'data_kredit_apr' => $data_kredit_apr,
            'data_kredit_mei' => $data_kredit_mei,
            'data_kredit_jun' => $data_kredit_jun,
            'data_kredit_jul' => $data_kredit_jul,
            'data_kredit_agu' => $data_kredit_agu,
            'data_kredit_sep' => $data_kredit_sep,
            'data_kredit_okt' => $data_kredit_okt,
            'data_kredit_nov' => $data_kredit_nov,
            'data_kredit_des' => $data_kredit_des,
        ]);        
    }

    public function showDataPegawai()
    {
        $data = DB::table('pegawai')->select('*')->orderBy('nik', 'ASC')->paginate(4);   
        
        return view('admin.show_data_pegawai', compact('data'));
    }
    
    public function cariDataPegawai(Request $request)
    {
        $keyword = $request->search;
        $kategori = $request->kategori;

        $data = DB::table('pegawai')
                ->select('*')
                ->orderBy('nik', 'ASC')
                ->where($kategori, 'like', "%". $keyword . "%")
                ->paginate();   
        
        return view('admin.show_data_pegawai', compact('data'));
    }   
    
    public function updateDataPegawai(Request $request, $id)
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

    public function deleteDataPegawai($id)
    {
        $data = Pegawai::find($id);
        $data->delete();

        return redirect(route('admin.show.data.pegawai'))->with('success', 'Data Berhasil Dihapus!');
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

    public function cariDataAbsensi(Request $request)
    {
        $keyword = $request->search;
        $kategori = $request->kategori;
                                
        if($kategori == "nik"){
            $data = DB::table('absensi')
                ->select('absensi.id_absensi', 'pegawai.nik', 'absensi.tanggal', 'absensi.jam_masuk', 'absensi.jam_pulang')
                ->join('pegawai', 'pegawai.nik', '=', 'absensi.nik')
                ->where('pegawai.'.$kategori, 'like', "%". $keyword . "%")
                ->orderBy('absensi.tanggal', 'DESC')
                ->orderBy('absensi.jam_masuk', 'DESC')
                ->orderBy('absensi.jam_pulang', 'DESC')
                ->paginate();       
        }else{
            $data = DB::table('absensi')
                ->select('absensi.id_absensi', 'pegawai.nik', 'absensi.tanggal', 'absensi.jam_masuk', 'absensi.jam_pulang')
                ->join('pegawai', 'pegawai.nik', '=', 'absensi.nik')
                ->where($kategori, 'like', "%". $keyword . "%")
                ->orderBy('absensi.tanggal', 'DESC')
                ->orderBy('absensi.jam_masuk', 'DESC')
                ->orderBy('absensi.jam_pulang', 'DESC')
                ->paginate();   
        }        
        
        return view('admin.show_data_absensi', compact('data'));
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

        return redirect(route('admin.show.data.absensi'))->with('success', 'Data Berhasil Dihapus!');
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

    public function cariDataCuti(Request $request)
    {
        $keyword = $request->search;
        $kategori = $request->kategori;
                                
        if($kategori == "nik"){
            $data = DB::table('cuti')
                ->select('cuti.id_permintaan_cuti', 'pegawai.nik', 'cuti.tgl_pengajuan', 'cuti.tgl_mulai_cuti', 
                        'cuti.tgl_selesai_cuti', 'cuti.alasan_cuti', 'status')
                ->join('pegawai', 'pegawai.nik', '=', 'cuti.nik')
                ->where('pegawai.'.$kategori, 'like', "%". $keyword . "%")
                ->orderBy('cuti.tgl_pengajuan', 'DESC')  
                ->paginate();     
        }else{
            $data = DB::table('cuti')
                ->select('cuti.id_permintaan_cuti', 'pegawai.nik', 'cuti.tgl_pengajuan', 'cuti.tgl_mulai_cuti', 
                        'cuti.tgl_selesai_cuti', 'cuti.alasan_cuti', 'status')
                ->join('pegawai', 'pegawai.nik', '=', 'cuti.nik')
                ->where($kategori, 'like', "%". $keyword . "%")
                ->orderBy('cuti.tgl_pengajuan', 'DESC')  
                ->paginate();   
        }        
        
        return view('admin.show_data_cuti', compact('data'));
    }   
    
    public function updateDataCuti(Request $request, $id)
    {
        $data = Cuti::find($id);                    

        $validate = $request->validate([            
            'tgl_pengajuan' => ['required'],
            'tgl_mulai_cuti' => ['required'],            
            'tgl_selesai_cuti' => ['required'],                       
            'alasan_cuti' => ['required'],
            'status' => ['required']
        ]);

        $data->tgl_pengajuan = $request->tgl_pengajuan;
        $data->tgl_mulai_cuti = $request->tgl_mulai_cuti;        
        $data->tgl_selesai_cuti = $request->tgl_selesai_cuti;            
        $data->alasan_cuti = $request->alasan_cuti;  
        $data->status = $request->status;  
        $data->save();    
        
        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }

    public function deleteDataCuti($id)
    {
        $data = Cuti::find($id);
        $data->delete();

        return redirect(route('admin.show.data.cuti'))->with('success', 'Data Berhasil Dihapus!');
    }

    public function showDataAngkaKredit()   
    {
        $data = DB::table('penilaian_angka_kredit')
                ->select('penilaian_angka_kredit.no_dupak', 'pegawai.nik', 'penilaian_angka_kredit.masa_penilaian_awal', 'penilaian_angka_kredit.masa_penilaian_akhir', 
                        'penilaian_angka_kredit.tanggal_usulan')
                ->join('pegawai', 'pegawai.nik', '=', 'penilaian_angka_kredit.nik')
                ->orderBy('penilaian_angka_kredit.created_at', 'DESC')  
                ->paginate(4);  
        
        return view('admin.show_data_angka_kredit', compact('data'));
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
                ->where('pegawai.'.$kategori, 'like', "%". $keyword . "%")
                ->orderBy('penilaian_angka_kredit.created_at', 'DESC')  
                ->paginate();             
        }else{
            $data = DB::table('penilaian_angka_kredit')
                ->select('penilaian_angka_kredit.no_dupak', 'pegawai.nik', 'penilaian_angka_kredit.masa_penilaian_awal', 'penilaian_angka_kredit.masa_penilaian_akhir', 
                        'penilaian_angka_kredit.tanggal_usulan')
                ->join('pegawai', 'pegawai.nik', '=', 'penilaian_angka_kredit.nik')
                ->where($kategori, 'like', "%". $keyword . "%")
                ->orderBy('penilaian_angka_kredit.created_at', 'DESC')  
                ->paginate();               
        }        
        
        return view('admin.show_data_angka_kredit', compact('data'));
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

        return redirect(route('admin.show.data.angka.kredit'))->with('success', 'Data Berhasil Dihapus!');
    }

    public function showDataKegiatan()
    {
        $data = DB::table('kegiatan')
                ->select('kegiatan.id_kegiatan', 'pegawai.nik', 'kegiatan.nama_kegiatan', 'kegiatan.asal_kegiatan', 
                        'kegiatan.target', 'kegiatan.realisasi', 'kegiatan.batas_waktu',
                        'kegiatan.tgl_realisasi', 'kegiatan.keterangan')
                ->join('pegawai', 'pegawai.nik', '=', 'kegiatan.nik')
                ->orderBy('kegiatan.created_at', 'DESC')  
                ->paginate(4);  
        
        return view('admin.show_data_kegiatan', compact('data'));
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
                    ->where('pegawai.'.$kategori, 'like', "%". $keyword . "%")
                    ->orderBy('kegiatan.created_at', 'DESC')  
                    ->paginate();                    
        }else{
            $data = DB::table('kegiatan')
            ->select('kegiatan.id_kegiatan', 'pegawai.nik', 'kegiatan.nama_kegiatan', 'kegiatan.asal_kegiatan', 
                    'kegiatan.target', 'kegiatan.realisasi', 'kegiatan.batas_waktu',
                    'kegiatan.tgl_realisasi', 'kegiatan.keterangan')
            ->join('pegawai', 'pegawai.nik', '=', 'kegiatan.nik')
            ->where($kategori, 'like', "%". $keyword . "%")
            ->orderBy('kegiatan.created_at', 'DESC')  
            ->paginate();                
        }        
        
        return view('admin.show_data_kegiatan', compact('data'));
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
            'tgl_realisasi' => ['required'],
            'keterangan' => ['required']
        ]);

        $data->nama_kegiatan = $request->nama_kegiatan;
        $data->asal_kegiatan = $request->asal_kegiatan;        
        $data->target = $request->target;                
        $data->realisasi = $request->realisasi;            
        $data->batas_waktu = $request->batas_waktu;            
        $data->tgl_realisasi = $request->tgl_realisasi;            
        $data->keterangan = $request->keterangan;            
        $data->save();    
        
        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }

    public function deleteDataKegiatan($id)
    {
        $data = Kegiatan::find($id);
        $data->delete();

        return redirect(route('admin.show.data.kegiatan'))->with('success', 'Data Berhasil Dihapus!');
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
                    ->where('pegawai.'.$kategori, 'like', "%". $keyword . "%")
                    ->orderBy('capaian_kinerja.tgl_masuk', 'DESC')  
                    ->paginate();                                
        }else{
            $data = DB::table('capaian_kinerja')
                    ->select('capaian_kinerja.id_ckp', 'pegawai.nik', 'capaian_kinerja.kategori', 'capaian_kinerja.periode', 
                            'capaian_kinerja.detail_pekerjaan', 'capaian_kinerja.tgl_pelaksanaan', 'capaian_kinerja.tgl_masuk', 'capaian_kinerja.catatan_operator',
                            'capaian_kinerja.nilai')
                    ->join('pegawai', 'pegawai.nik', '=', 'capaian_kinerja.nik')
                    ->where($kategori, 'like', "%". $keyword . "%")
                    ->orderBy('capaian_kinerja.tgl_masuk', 'DESC')  
                    ->paginate();               
        }        
        
        return view('admin.show_data_capaian_kinerja', compact('data'));
    }   
    
    public function updateDataCapaianKinerja(Request $request, $id)
    {
        $data = CapaianKinerja::find($id);                    

        $validate = $request->validate([            
            'kategori' => ['required'],
            'periode' => ['required'],            
            'detail_pekerjaan' => ['required'],
            'tgl_pelaksanaan' => ['required'],
            'tgl_masuk' => ['required'],
            'catatan_operator' => ['required'],
            'nilai' => ['required']
        ]);

        $data->kategori = $request->kategori;
        $data->periode = $request->periode;        
        $data->detail_pekerjaan = $request->detail_pekerjaan;                
        $data->tgl_pelaksanaan = $request->tgl_pelaksanaan;            
        $data->tgl_masuk = $request->tgl_masuk;            
        $data->catatan_operator = $request->catatan_operator;            
        $data->nilai = $request->nilai;            
        $data->save();    
        
        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }

    public function deleteDataCapaianKinerja($id)
    {
        $data = CapaianKinerja::find($id);
        $data->delete();

        return redirect(route('admin.show.data.capaian.kinerja'))->with('success', 'Data Berhasil Dihapus!');
    }
}

