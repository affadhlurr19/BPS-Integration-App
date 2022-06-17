@extends('layouts.admin_sidebar')

@section('title', 'Data Capaian Kinerja')
@section('current-page', 'Data Capaian Kinerja')

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
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahCKP">
                        <i class="fas fa-plus"></i>
                    </button>
                    <div class="modal fade" id="tambahCKP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Capaian Kinerja</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('pegawai.post.data.capaian.kinerja') }}" method="post">
                                        @csrf                                        
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
                                            <label for="">Kategori</label>
                                            <input id="kategori" placeholder="Masukkan Kategori" type="text" class="form-control form-control-sm @error('kategori') is-invalid @enderror" name="kategori" required autocomplete="kategori" autofocus>
                                            @error('kategori')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </div> 
                                        <div class="form-group">
                                            <label for="">Periode</label>
                                            <input id="periode" placeholder="Masukkan Periode" type="text" class="form-control form-control-sm @error('periode') is-invalid @enderror" name="periode" required autocomplete="periode" autofocus>
                                            @error('periode')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </div> 
                                        <div class="form-group">
                                            <label for="">Detail Pekerjaan</label>
                                            <input id="detail_pekerjaan" placeholder="Masukkan Detail Pekerjaan" type="text" class="form-control form-control-sm @error('detail_pekerjaan') is-invalid @enderror" name="detail_pekerjaan" required autocomplete="detail_pekerjaan" autofocus>
                                            @error('detail_pekerjaan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </div>                                                                                                                                                                                                                                                                               
                                        <div class="form-group">
                                            <label for="">Tanggal Pelaksanaan</label>                                                                                                                            
                                            <input id="tgl_pelaksanaan" type="date" class="form-control form-control-sm @error('tgl_pelaksanaan') is-invalid @enderror" name="tgl_pelaksanaan" required autocomplete="tgl_pelaksanaan" autofocus>
                                            @error('tgl_pelaksanaan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror                                                                                                                                                                                            
                                        </div>        
                                        <div class="form-group">
                                            <label for="">Tanggal Masuk</label>                                                                                                                            
                                            <input id="tgl_masuk" type="date" class="form-control form-control-sm @error('tgl_masuk') is-invalid @enderror" name="tgl_masuk" required autocomplete="tgl_masuk" autofocus>
                                            @error('tgl_masuk')
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
                        <form action="{{ route('pegawai.cari.data.capaian.kinerja') }}" method="get">
                            <div class="input-group input-group-sm" style="width: 310px;">
                                <select name="kategori" class="form-select">
                                    <option value="id_ckp  ">ID CKP</option>                                    
                                    <option value="nik">NIP</option>                                    
                                    <option value="kategori">Kategori</option>
                                    <option value="periode">Periode</option>
                                    <option value="detail_pekerjaan">Detail Pekerjaan</option>
                                    <option value="tgl_pelaksanaan">Tanggal Pelaksanaan</option>
                                    <option value="tgl_masuk">Tanggal Masuk</option>
                                    <option value="catatan_operator	">Catatan Operator</option>
                                    <option value="nilai">Nilai</option>                                    
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
                                <th>ID CKP</th>
                                <th>NIP</th>
                                <th>Kategori</th>
                                <th>Periode</th>
                                <th>Detail Pekerjaan</th>                                
                                <th>Tanggal Pelaksanaan</th>
                                <th>Tanggal Masuk</th>
                                <th>Catatan Operator</th>
                                <th>Nilai</th>                                
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($data as $datas)
                            <tr>                                
                                <td>{{ $datas->id_ckp }}</td>
                                <td>{{ $datas->nik }}</td>                                
                                <td>{{ $datas->kategori }}</td>                                
                                <td>{{ $datas->periode }}</td>                                
                                <td>{{ $datas->detail_pekerjaan }}</td>                                
                                <td>
                                    <?php 
                                        $tgl_pelaksanaan = date('d F Y', strtotime($datas->tgl_pelaksanaan)); 
                                    ?>                                    
                                    {{ $tgl_pelaksanaan }}
                                </td>
                                <td>
                                    <?php 
                                        $tgl_masuk = date('d F Y', strtotime($datas->tgl_masuk)); 
                                    ?>                                    
                                    {{ $tgl_masuk }}
                                </td>                          
                                <td>{{ $datas->catatan_operator }}</td>                                               
                                <td>{{ $datas->nilai }}</td>    
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editCKP_{{ $datas->id_ckp }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <div class="modal fade" id="editCKP_{{ $datas->id_ckp }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Capaian Kinerja</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ url('/pegawai/data-capaian-kinerja/update/'.$datas->id_ckp) }}" method="post">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="">ID CKP</label>
                                                            <input id="id_ckp" type="text" class="form-control form-control-sm @error('id_ckp') is-invalid @enderror" name="id_ckp" value="{{ $datas->id_ckp }}" required autocomplete="id_ckp" autofocus readonly>
                                                            @error('id_ckp')
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
                                                            <label for="">Kategori</label>
                                                            <input id="kategori" placeholder="Masukkan Kategori" type="text" class="form-control form-control-sm @error('kategori') is-invalid @enderror" name="kategori" value="{{ $datas->kategori }}" required autocomplete="kategori" autofocus>
                                                            @error('kategori')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror 
                                                        </div> 
                                                        <div class="form-group">
                                                            <label for="">Periode</label>
                                                            <input id="periode" placeholder="Masukkan Periode" type="text" class="form-control form-control-sm @error('periode') is-invalid @enderror" name="periode" value="{{ $datas->periode }}" required autocomplete="periode" autofocus>
                                                            @error('periode')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror 
                                                        </div> 
                                                        <div class="form-group">
                                                            <label for="">Detail Pekerjaan</label>
                                                            <input id="detail_pekerjaan" placeholder="Masukkan Detail Pekerjaan" type="text" class="form-control form-control-sm @error('detail_pekerjaan') is-invalid @enderror" name="detail_pekerjaan" value="{{ $datas->detail_pekerjaan }}" required autocomplete="detail_pekerjaan" autofocus>
                                                            @error('detail_pekerjaan')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror 
                                                        </div>                                                                                                                                                                                                                                                                               
                                                        <div class="form-group">
                                                            <label for="">Tanggal Pelaksanaan</label>                                                                                                                            
                                                            <input id="tgl_pelaksanaan" type="date" class="form-control form-control-sm @error('tgl_pelaksanaan') is-invalid @enderror" name="tgl_pelaksanaan" value="{{ $datas->tgl_pelaksanaan }}" required autocomplete="tgl_pelaksanaan" autofocus>
                                                            @error('tgl_pelaksanaan')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror                                                                                                                                                                                            
                                                        </div>        
                                                        <div class="form-group">
                                                            <label for="">Tanggal Masuk</label>                                                                                                                            
                                                            <input id="tgl_masuk" type="date" class="form-control form-control-sm @error('tgl_masuk') is-invalid @enderror" name="tgl_masuk" value="{{ $datas->tgl_masuk }}" required autocomplete="tgl_masuk" autofocus>
                                                            @error('tgl_masuk')
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
                                    <a href="{{ url('/pegawai/data-capaian-kinerja/delete/'.$datas->id_ckp) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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