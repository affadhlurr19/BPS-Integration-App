@extends('layouts.admin_sidebar')

@section('title', 'Data Pegawai')
@section('current-page', 'Data Pegawai')

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
                    <div class="card-tools">
                        <form action="{{ route('admin.cari.data.pegawai') }}" method="get">
                            <div class="input-group input-group-sm" style="width: 300px;">
                                <select name="kategori" class="form-select">
                                    <option value="nik">NIK</option>
                                    <option value="nama_pegawai">Nama Pegawai</option>
                                    <option value="jenis_kelamin">Jenis Kelamin</option>
                                    <option value="alamat">Alamat</option>
                                    <option value="tim">Tim</option>
                                    <option value="agama">Agama</option>
                                    <option value="tempat_lahir">Tempat Lahir</option>
                                    <option value="nomor_telepon">Nomor Telepon</option>
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
                                <th>NIP</th>
                                <th>Nama Pegawai</th>
                                <th>Alamat Email</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Tim</th>
                                <th>Agama</th>
                                <th>Tempat, Tanggal Lahir</th>
                                <th>Nomor Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($data as $datas)
                            <tr>                                
                                <td>{{ $datas->nik }}</td>
                                <td>{{ $datas->nama_pegawai }}</td>
                                <td>{{ $datas->email }}</td>
                                <td>{{ $datas->jenis_kelamin }}</td>
                                <td>{{ $datas->alamat }}</td>
                                <td>{{ $datas->tim }}</td>
                                <td>{{ $datas->agama }}</td>
                                <td>{{ $datas->tempat_lahir }}, {{ $datas->tanggal_lahir }}</td>
                                <td>{{ $datas->nomor_telepon }}</td>
                                <td>                                    
                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editPegawai_{{ $datas->nik }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <div class="modal fade" id="editPegawai_{{ $datas->nik }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Pegawai</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ url('admin/data-pegawai/update/'.$datas->nik) }}" method="post">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="">NIP</label>
                                                            <input min="1" id="nik" type="text" pattern="\d*" maxlength="10" placeholder="Nomor Induk Pegawai" class="form-control form-control-sm @error('nik') is-invalid @enderror" name="nik" value="{{ $datas->nik }}" required autocomplete="nik" autofocus readonly>
                                                            @error('nik')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror 
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Nama Pegawai</label>
                                                            <input id="nama_pegawai" placeholder="Nama Lengkap Pegawai" type="text" class="form-control form-control-sm @error('nama_pegawai') is-invalid @enderror" name="nama_pegawai" value="{{ $datas->nama_pegawai }}" required autocomplete="nama_pegawai" autofocus>
                                                            @error('nama_pegawai')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror 
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Alamat Email</label>
                                                            <input id="email" placeholder="Alamat Email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ $datas->email }}" required autocomplete="email">
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror 
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Jenis Kelamin</label><br>
                                                            <div class="form-check form-check-inline" style="font-size:14px;">
                                                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Laki-Laki"  {{ ($datas->jenis_kelamin=="Laki-Laki")? "checked" : "" }}>
                                                                <label class="form-check-label" for="jenis_kelamin">Laki-Laki</label>
                                                            </div>
                                                            <div class="form-check form-check-inline" style="font-size:14px;">
                                                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Perempuan" {{ ($datas->jenis_kelamin=="Perempuan")? "checked" : "" }}>
                                                                <label class="form-check-label" for="jenis_kelamin">Perempuan</label>
                                                            </div>  
                                                            @error('jenis_kelamin')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror 
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Alamat Rumah</label>
                                                            <textarea style="resize:none;" placeholder="Alamat Rumah" name="alamat" id="alamat" class="form-control form-control-sm @error('alamat') is-invalid @enderror"  required autocomplete="alamat" autofocus>{{ $datas->alamat }}</textarea>                                
                                                            @error('alamat')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror 
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Nama Tim</label>
                                                            <input id="tim" placeholder="Nama Tim" type="text" class="form-control form-control-sm @error('tim') is-invalid @enderror" name="tim" value="{{ $datas->tim }}" required autocomplete="tim" autofocus>
                                                            @error('tim')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror 
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Agama</label>
                                                            <select class="form-select form-select-sm @error('agama') is-invalid @enderror" name="agama" required autocomplete="agama" autofocus>
                                                                <option value="Islam" {{ $datas->agama == "Islam" ? 'selected' : '' }}>Islam</option>
                                                                <option value="Protestan" {{ $datas->agama == "Protestan" ? 'selected' : '' }}>Protestan</option>
                                                                <option value="Katolik" {{ $datas->agama == "Katolik" ? 'selected' : '' }}>Katolik</option>
                                                                <option value="Hindu" {{ $datas->agama == "Hindu" ? 'selected' : '' }}>Hindu</option>
                                                                <option value="Buddha" {{ $datas->agama == "Buddha" ? 'selected' : '' }}>Buddha</option>
                                                                <option value="Khonghucu" {{ $datas->agama == "Khonghucu" ? 'selected' : '' }}>Khonghucu</option>
                                                                <option value="Lainnya" {{ $datas->agama == "Lainnya" ? 'selected' : '' }}>Lainnya</option>
                                                            </select>
                                                            @error('agama')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror                                                           
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Tempat, Tanggal Lahir</label>
                                                            <div class="row no-gutters">
                                                                <div class="col-12 col-md-12 col-lg-7">
                                                                    <input id="tempat_lahir" placeholder="Tempat Lahir" type="text" class="form-control form-control-sm @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" value="{{ $datas->tempat_lahir }}" required autocomplete="tempat_lahir" autofocus>
                                                                    @error('tempat_lahir')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-12 col-md-12 col-lg-5">
                                                                    <input id="tanggal_lahir" placeholder="Tanggal Lahir" type="date" class="form-control form-control-sm @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ $datas->tanggal_lahir }}" required autocomplete="tanggal_lahir" autofocus>
                                                                    @error('tanggal_lahir')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>                                                                                                                        
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Nomor Telepon</label>
                                                            <input id="nomor_telepon" placeholder="Nomor Telepon" type="text" pattern="\d*" maxlength="13" class="form-control form-control-sm @error('nomor_telepon') is-invalid @enderror" name="nomor_telepon" value="{{ $datas->nomor_telepon }}" required autocomplete="nomor_telepon" autofocus>
                                                            @error('nomor_telepon')
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
                                    <a href="{{ url('admin/data-pegawai/delete/'.$datas->nik) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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