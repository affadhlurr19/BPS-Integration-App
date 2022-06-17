@extends('layouts.admin_sidebar')

@section('title', 'Data Penilain Angka Kredit')
@section('current-page', 'Data Penilain Angka Kredit')

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
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahKredit">
                        <i class="fas fa-plus"></i>
                    </button>
                    <div class="modal fade" id="tambahKredit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Angka Kredit</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('pegawai.post.data.angka.kredit') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Nomor Dupak</label>
                                            <input id="no_dupak" pattern="\d*" maxlength="10" type="text" class="form-control form-control-sm @error('no_dupak') is-invalid @enderror" name="no_dupak" required autocomplete="no_dupak" autofocus>
                                            @error('no_dupak')
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
                                            <label for="">Masa Penilaian Awal dan Masa Penilaian Akhir</label>
                                            <div class="row no-gutters">
                                                <div class="col-6 col-md-6 col-lg-6">
                                                    <input id="masa_penilaian_awal" type="date" class="form-control form-control-sm @error('masa_penilaian_awal') is-invalid @enderror" name="masa_penilaian_awal" required autocomplete="masa_penilaian_awal" autofocus>
                                                    @error('masa_penilaian_awal')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-6 col-md-6 col-lg-6">
                                                    <input id="masa_penilaian_akhir" type="date" class="form-control form-control-sm @error('masa_penilaian_akhir') is-invalid @enderror" name="masa_penilaian_akhir" required autocomplete="masa_penilaian_akhir" autofocus>
                                                    @error('masa_penilaian_akhir')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>                                                                                                                        
                                        </div>                                                                                                                                                                       
                                        <div class="form-group">
                                            <label for="">Tanggal Usulan</label>                                                                                                                            
                                            <input id="tanggal_usulan" type="date" class="form-control form-control-sm @error('tanggal_usulan') is-invalid @enderror" name="tanggal_usulan" required autocomplete="tanggal_usulan" autofocus>
                                            @error('tanggal_usulan')
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
                        <form action="{{ route('pegawai.cari.data.angka.kredit') }}" method="get">
                            <div class="input-group input-group-sm" style="width: 310px;">
                                <select name="kategori" class="form-select">
                                    <option value="no_dupak">Nomor Dupak</option>                                    
                                    <option value="nik">NIP</option>                                    
                                    <option value="masa_penilaian_awal">Masa Penilaian Awal</option>
                                    <option value="masa_penilaian_akhir">Masa Penilaian Akhir</option>
                                    <option value="tanggal_usulan">Tanggal Usulan</option>                                                                        
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
                                <th>No. Dupak</th>
                                <th>NIP</th>
                                <th>Masa Penilaian Awal</th>
                                <th>Masa Penilaian Akhir</th>
                                <th>Tanggal Usulan</th>                                
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($data as $datas)
                            <tr>                                
                                <td>{{ $datas->no_dupak }}</td>
                                <td>{{ $datas->nik }}</td>                                
                                <td>
                                    <?php 
                                        $p_awal = date('d F Y', strtotime($datas->masa_penilaian_awal)); 
                                    ?>                                    
                                    {{ $p_awal }}
                                </td>
                                <td>
                                    <?php 
                                        $p_akhir = date('d F Y', strtotime($datas->masa_penilaian_akhir)); 
                                    ?>                                    
                                    {{ $p_akhir }}
                                </td>
                                <td>
                                    <?php 
                                        $t_usulan = date('d F Y', strtotime($datas->tanggal_usulan)); 
                                    ?>                                    
                                    {{ $t_usulan }}
                                </td>                                
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editpak_{{ $datas->no_dupak }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <div class="modal fade" id="editpak_{{ $datas->no_dupak }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Angka Kredit</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ url('/pegawai/data-angka-kredit/update/'.$datas->no_dupak) }}" method="post">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="">Nomor Dupak</label>
                                                            <input id="no_dupak" type="text" class="form-control form-control-sm @error('no_dupak') is-invalid @enderror" name="no_dupak" value="{{ $datas->no_dupak }}" required autocomplete="no_dupak" autofocus readonly>
                                                            @error('no_dupak')
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
                                                            <label for="">Masa Penilaian Awal dan Masa Penilaian Akhir</label>
                                                            <div class="row no-gutters">
                                                                <div class="col-6 col-md-6 col-lg-6">
                                                                    <input id="masa_penilaian_awal" type="date" class="form-control form-control-sm @error('masa_penilaian_awal') is-invalid @enderror" name="masa_penilaian_awal" value="{{ $datas->masa_penilaian_awal }}" required autocomplete="masa_penilaian_awal" autofocus>
                                                                    @error('masa_penilaian_awal')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-6 col-md-6 col-lg-6">
                                                                    <input id="masa_penilaian_akhir" type="date" class="form-control form-control-sm @error('masa_penilaian_akhir') is-invalid @enderror" name="masa_penilaian_akhir" value="{{ $datas->masa_penilaian_akhir }}" required autocomplete="masa_penilaian_akhir" autofocus>
                                                                    @error('masa_penilaian_akhir')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>                                                                                                                        
                                                        </div>                                                                                                                                                                       
                                                        <div class="form-group">
                                                            <label for="">Tanggal Usulan</label>                                                                                                                            
                                                            <input id="tanggal_usulan" type="date" class="form-control form-control-sm @error('tanggal_usulan') is-invalid @enderror" name="tanggal_usulan" value="{{ $datas->tanggal_usulan }}" required autocomplete="tanggal_usulan" autofocus>
                                                            @error('tanggal_usulan')
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
                                    <a href="{{ url('pegawai/data-angka-kredit/delete/'.$datas->no_dupak) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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