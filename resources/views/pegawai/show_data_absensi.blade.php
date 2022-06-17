@extends('layouts.admin_sidebar')

@section('title', 'Data Absensi')
@section('current-page', 'Data Absensi')

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
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahAbsensi">
                        <i class="fas fa-plus"></i>
                    </button>
                    <div class="modal fade" id="tambahAbsensi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Absensi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('pegawai.post.data.absensi') }}" method="post">
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
                                            <label for="">Tanggal</label>                                                                                                                            
                                            <input id="tanggal" type="date" class="form-control form-control-sm @error('tanggal') is-invalid @enderror" name="tanggal" required autocomplete="tanggal" autofocus>
                                            @error('tanggal')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror                                                                                                                                                                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jam Masuk dan Jam Pulang</label>
                                            <div class="row no-gutters">
                                                <div class="col-6 col-md-6 col-lg-6">
                                                    <input id="jam_masuk" type="time" class="form-control form-control-sm @error('jam_masuk') is-invalid @enderror" name="jam_masuk" required autocomplete="jam_masuk" autofocus>
                                                    @error('jam_masuk')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-6 col-md-6 col-lg-6">
                                                    <input id="jam_pulang" type="time" class="form-control form-control-sm @error('jam_pulang') is-invalid @enderror" name="jam_pulang" required autocomplete="jam_pulang" autofocus>
                                                    @error('jam_pulang')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>                                                                                                                        
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
                        <form action="{{ route('pegawai.cari.data.absensi') }}" method="get">
                            <div class="input-group input-group-sm" style="width: 300px;">
                                <select name="kategori" class="form-select">
                                    <option value="id_absensi">ID Absensi</option>                                    
                                    <option value="nik">NIP</option>                                    
                                    <option value="tanggal">Tanggal</option>
                                    <option value="jam_masuk">Jam Masuk</option>
                                    <option value="jam_pulang">Jam Pulang</option>                                    
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
                                <th>ID Absensi</th>
                                <th>NIP</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Pulang</th>                                
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($data as $datas)
                            <tr>                                
                                <td>{{ $datas->id_absensi }}</td>
                                <td>{{ $datas->nik }}</td>                                
                                <td>
                                    <?php 
                                        $tanggal = date('d F Y', strtotime($datas->tanggal)); 
                                    ?>                                    
                                    {{ $tanggal }}
                                </td>
                                <td>{{ $datas->jam_masuk }}</td>
                                <td>{{ $datas->jam_pulang }}</td>                                
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editAbsensi_{{ $datas->id_absensi }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <div class="modal fade" id="editAbsensi_{{ $datas->id_absensi }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Absensi</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ url('/pegawai/data-absensi/update/'.$datas->id_absensi) }}" method="post">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="">ID Absensi</label>
                                                            <input id="id_absensi" type="text" placeholder="ID Absensi Pegawai" class="form-control form-control-sm @error('id_absensi') is-invalid @enderror" name="id_absensi" value="{{ $datas->id_absensi }}" required autocomplete="id_absensi" autofocus readonly>
                                                            @error('id_absensi')
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
                                                            <label for="">Tanggal</label>                                                                                                                            
                                                            <input id="tanggal" type="date" class="form-control form-control-sm @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ $datas->tanggal }}" required autocomplete="tanggal" autofocus>
                                                            @error('tanggal')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror                                                                                                                                                                                            
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Jam Masuk dan Jam Pulang</label>
                                                            <div class="row no-gutters">
                                                                <div class="col-6 col-md-6 col-lg-6">
                                                                    <input id="jam_masuk" type="time" class="form-control form-control-sm @error('jam_masuk') is-invalid @enderror" name="jam_masuk" value="{{ $datas->jam_masuk }}" required autocomplete="jam_masuk" autofocus>
                                                                    @error('jam_masuk')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-6 col-md-6 col-lg-6">
                                                                    <input id="jam_pulang" type="time" class="form-control form-control-sm @error('jam_pulang') is-invalid @enderror" name="jam_pulang" value="{{ $datas->jam_pulang }}" required autocomplete="jam_pulang" autofocus>
                                                                    @error('jam_pulang')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>                                                                                                                        
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
                                    <a href="{{ url('/pegawai/data-absensi/delete/'.$datas->id_absensi) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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