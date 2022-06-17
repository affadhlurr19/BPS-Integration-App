@extends('layouts.admin_sidebar')

@section('title', 'Data Kegiatan')
@section('current-page', 'Data Kegiatan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Success!</h5>
                {{ session('success') }}
            </div>                                                                   
            @endif   
            <div class="card">
                <div class="card-header">      
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahKegiatan">
                        <i class="fas fa-plus"></i>
                    </button>
                    <div class="modal fade" id="tambahKegiatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kegiatan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('pegawai.post.data.kegiatan') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">ID Kegiatan</label>
                                            <input id="id_kegiatan" placeholder="Masukkan ID Kegiatan" pattern="\d*" maxlength="10" min=1 type="text" class="form-control form-control-sm @error('id_kegiatan') is-invalid @enderror" name="id_kegiatan" required autocomplete="id_kegiatan" autofocus>
                                            @error('id_kegiatan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </div>
                                        <div class="form-group">
                                            <label for="">NIP</label>
                                            <input id="nik" placeholder="Nomor Induk Pegawai" type="text" class="form-control form-control-sm @error('nik') is-invalid @enderror" name="nik" value="{{ Auth::user()->nik }}" required autocomplete="nik" autofocus readonly>
                                            @error('nik')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </div>  
                                        <div class="form-group">
                                            <label for="">Nama Kegiatan</label>
                                            <input id="nama_kegiatan" placeholder="Masukkan Nama Kegiatan" type="text" class="form-control form-control-sm @error('nama_kegiatan') is-invalid @enderror" name="nama_kegiatan" required autocomplete="nama_kegiatan" autofocus>
                                            @error('nama_kegiatan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </div> 
                                        <div class="form-group">
                                            <label for="">Asal Kegiatan</label>
                                            <input id="asal_kegiatan" placeholder="Masukkan Asal Kegiatan" type="text" class="form-control form-control-sm @error('asal_kegiatan') is-invalid @enderror" name="asal_kegiatan" required autocomplete="asal_kegiatan" autofocus>
                                            @error('asal_kegiatan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </div> 
                                        <div class="form-group">
                                            <label for="">Target</label>
                                            <input id="target" placeholder="Masukkan Target Kegiatan" type="number" min=0 class="form-control form-control-sm @error('target') is-invalid @enderror" name="target" required autocomplete="target" autofocus>
                                            @error('target')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </div> 
                                        <div class="form-group">
                                            <label for="">Realisasi</label>
                                            <input id="realisasi" placeholder="Masukkan Realiasi Kegiatan" type="number" min=0 class="form-control form-control-sm @error('realisasi') is-invalid @enderror" name="realisasi" required autocomplete="realisasi" autofocus>
                                            @error('realisasi')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </div>                                                                                                                                                                                                                              
                                        <div class="form-group">
                                            <label for="">Batas Waktu</label>                                                                                                                            
                                            <input id="batas_waktu" type="date" class="form-control form-control-sm @error('batas_waktu') is-invalid @enderror" name="batas_waktu" required autocomplete="batas_waktu" autofocus>
                                            @error('batas_waktu')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror                                                                                                                                                                                            
                                        </div>        
                                        <div class="form-group">
                                            <label for="">Tanggal Realisasi</label>                                                                                                                            
                                            <input id="tgl_realisasi" type="date" class="form-control form-control-sm @error('tgl_realisasi') is-invalid @enderror" name="tgl_realisasi" required autocomplete="tgl_realisasi" autofocus>
                                            @error('tgl_realisasi')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror                                                                                                                                                                                            
                                        </div>                                                           
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>                
                    <div class="card-tools">
                        <form action="{{ route('pegawai.cari.data.kegiatan') }}" method="get">
                            <div class="input-group input-group-sm" style="width: 310px;">
                                <select name="kategori" class="form-select">
                                    <option value="id_kegiatan ">ID Kegiatan</option>                                    
                                    <option value="nik">NIP</option>                                    
                                    <option value="nama_kegiatan">Nama Kegiatan</option>
                                    <option value="asal_kegiatan">Asal Kegiatan</option>
                                    <option value="target">Target</option>
                                    <option value="realisasi">Realisasi</option>
                                    <option value="batas_waktu">Batas Waktu</option>
                                    <option value="tgl_realisasi">Tanggal Realisasi</option>
                                    <option value="keterangan">Keterangan</option>                                                                        
                                </select>
                                <input type="text" name="search" class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>                
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>                                
                                <th>ID Kegiatan</th>
                                <th>NIP</th>
                                <th>Nama Kegiatan</th>
                                <th>Asal Kegiatan</th>
                                <th>Target</th>                                
                                <th>Realisasi</th>                                
                                <th>Batas Waktu</th>
                                <th>Tanggal Realisasi</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($data as $datas)
                            <tr>                                
                                <td>{{ $datas->id_kegiatan }}</td>
                                <td>{{ $datas->nik }}</td>                                
                                <td>{{ $datas->nama_kegiatan }}</td>                                
                                <td>{{ $datas->asal_kegiatan }}</td>                                
                                <td>{{ $datas->target }}</td>                                
                                <td>{{ $datas->realisasi }}</td>                                                                                            
                                <td>
                                    <?php 
                                        $batas_waktu = date('d F Y', strtotime($datas->batas_waktu)); 
                                    ?>                                    
                                    {{ $batas_waktu }}
                                </td>
                                <td>
                                    <?php 
                                        $tgl_realisasi = date('d F Y', strtotime($datas->tgl_realisasi)); 
                                    ?>                                    
                                    {{ $tgl_realisasi }}
                                </td>      
                                <td>
                                    @if($datas->keterangan == "Terlaksana")
                                        <span class="badge badge-success">{{ $datas->keterangan }}</span>
                                    @elseif($datas->keterangan == "Belum Terlaksana")
                                        <span class="badge badge-danger">{{ $datas->keterangan }}</span>                                   
                                    @endif                                    
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editKegiatan_{{ $datas->id_kegiatan }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <div class="modal fade" id="editKegiatan_{{ $datas->id_kegiatan }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Kegiatan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ url('/pegawai/data-kegiatan/update/'.$datas->id_kegiatan) }}" method="post">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="">ID Kegiatan</label>
                                                            <input id="id_kegiatan" type="text" class="form-control form-control-sm @error('id_kegiatan') is-invalid @enderror" name="id_kegiatan" value="{{ $datas->id_kegiatan }}" required autocomplete="id_kegiatan" autofocus readonly>
                                                            @error('id_kegiatan')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror 
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">NIP</label>
                                                            <input id="nik" placeholder="Nomor Induk Pegawai" type="text" class="form-control form-control-sm @error('nik') is-invalid @enderror" name="nik" value="{{ $datas->nik }}" required autocomplete="nik" autofocus readonly>
                                                            @error('nik')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror 
                                                        </div>  
                                                        <div class="form-group">
                                                            <label for="">Nama Kegiatan</label>
                                                            <input id="nama_kegiatan" placeholder="Masukkan Nama Kegiatan" type="text" class="form-control form-control-sm @error('nama_kegiatan') is-invalid @enderror" name="nama_kegiatan" value="{{ $datas->nama_kegiatan }}" required autocomplete="nama_kegiatan" autofocus>
                                                            @error('nama_kegiatan')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror 
                                                        </div> 
                                                        <div class="form-group">
                                                            <label for="">Asal Kegiatan</label>
                                                            <input id="asal_kegiatan" placeholder="Masukkan Asal Kegiatan" type="text" class="form-control form-control-sm @error('asal_kegiatan') is-invalid @enderror" name="asal_kegiatan" value="{{ $datas->asal_kegiatan }}" required autocomplete="asal_kegiatan" autofocus>
                                                            @error('asal_kegiatan')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror 
                                                        </div> 
                                                        <div class="form-group">
                                                            <label for="">Target</label>
                                                            <input id="target" placeholder="Masukkan Target Kegiatan" type="number" min=0 class="form-control form-control-sm @error('target') is-invalid @enderror" name="target" value="{{ $datas->target }}" required autocomplete="target" autofocus>
                                                            @error('target')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror 
                                                        </div> 
                                                        <div class="form-group">
                                                            <label for="">Realisasi</label>
                                                            <input id="realisasi" placeholder="Masukkan Realiasi Kegiatan" type="number" min=0 class="form-control form-control-sm @error('realisasi') is-invalid @enderror" name="realisasi" value="{{ $datas->realisasi }}" required autocomplete="realisasi" autofocus>
                                                            @error('realisasi')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror 
                                                        </div>                                                                                                                                                                                                                              
                                                        <div class="form-group">
                                                            <label for="">Batas Waktu</label>                                                                                                                            
                                                            <input id="batas_waktu" type="date" class="form-control form-control-sm @error('batas_waktu') is-invalid @enderror" name="batas_waktu" value="{{ $datas->batas_waktu }}" required autocomplete="batas_waktu" autofocus>
                                                            @error('batas_waktu')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror                                                                                                                                                                                            
                                                        </div>        
                                                        <div class="form-group">
                                                            <label for="">Tanggal Realisasi</label>                                                                                                                            
                                                            <input id="tgl_realisasi" type="date" class="form-control form-control-sm @error('tgl_realisasi') is-invalid @enderror" name="tgl_realisasi" value="{{ $datas->tgl_realisasi }}" required autocomplete="tgl_realisasi" autofocus>
                                                            @error('tgl_realisasi')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror                                                                                                                                                                                            
                                                        </div>                                                           
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-sm btn-warning">Ubah</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                    <a href="{{ url('pegawai/data-kegiatan/delete/'.$datas->id_kegiatan) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                </td>                                
                            </tr>                   
                            @endforeach         
                        </tbody>                        
                    </table>
                </div>                          
                <div class="card-footer clearfix">                    
                    <div class="row">
                        <div class="col-9">
                            {{ $data->links() }}
                        </div>
                        <div class="col-3 text-end text-muted" style="font-size:14px;">                            
                            Jumlah Data: {{ $data->total() }}                            
                        </div>
                    </div>
                </div>      
            </div>            
        </div>
    </div>
</div>
@endsection