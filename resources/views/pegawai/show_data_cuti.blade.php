@extends('layouts.admin_sidebar')

@section('title', 'Data Cuti')
@section('current-page', 'Data Cuti')

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
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahCuti">
                        <i class="fas fa-plus"></i>
                    </button>
                    <div class="modal fade" id="tambahCuti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Cuti</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('pegawai.post.data.cuti') }}" method="post">
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
                                            <label for="">Tanggal Pengajuan</label>                                                                                                                            
                                            <input id="tanggal" type="date" class="form-control form-control-sm @error('tgl_pengajuan') is-invalid @enderror" name="tgl_pengajuan" required autocomplete="tgl_pengajuan" autofocus>
                                            @error('tgl_pengajuan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror                                                                                                                                                                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tanggal Mulai dan Tanggal Selesai Cuti</label>
                                            <div class="row no-gutters">
                                                <div class="col-6 col-md-6 col-lg-6">
                                                    <input id="tgl_mulai_cuti" type="date" class="form-control form-control-sm @error('tgl_mulai_cuti') is-invalid @enderror" name="tgl_mulai_cuti" required autocomplete="tgl_mulai_cuti" autofocus>
                                                    @error('tgl_mulai_cuti')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-6 col-md-6 col-lg-6">
                                                    <input id="tgl_selesai_cuti" type="date" class="form-control form-control-sm @error('tgl_selesai_cuti') is-invalid @enderror" name="tgl_selesai_cuti" required autocomplete="tgl_selesai_cuti" autofocus>
                                                    @error('tgl_selesai_cuti')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>                                                                                                                        
                                        </div>  
                                        <div class="form-group">
                                            <label for="">Alasan Cuti</label>
                                            <textarea style="resize:none;" placeholder="Masukkan Alasan Cuti" name="alasan_cuti" id="alasan_cuti" class="form-control form-control-sm @error('alasan_cuti') is-invalid @enderror"  required autocomplete="alasan_cuti" autofocus></textarea>                                                                                       
                                            @error('alasan_cuti')
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
                        <form action="{{ route('pegawai.cari.data.cuti') }}" method="get">
                            <div class="input-group input-group-sm" style="width: 310px;">
                                <select name="kategori" class="form-select">
                                    <option value="id_permintaan_cuti">ID Permintaan Cuti</option>                                    
                                    <option value="nik">NIP</option>                                    
                                    <option value="tgl_pengajuan">Tanggal Pengajuan</option>
                                    <option value="tgl_mulai_cuti">Tanggal Mulai Cuti</option>
                                    <option value="tgl_selesai_cuti">Tanggal Selesai Cuti</option>                                    
                                    <option value="alasan_cuti">Alasan Cuti</option>                                    
                                    <option value="status">Status</option>
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
                                <th>ID Permintaan Cuti</th>
                                <th>NIP</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Tanggal Mulai Cuti</th>
                                <th>Tanggal Selesai Cuti</th>                                
                                <th>Alasan Cuti</th>                                
                                <th>Status</th>                                
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($data as $datas)
                            <tr>                                
                                <td>{{ $datas->id_permintaan_cuti }}</td>
                                <td>{{ $datas->nik }}</td>                                
                                <td>
                                    <?php 
                                        $tanggal = date('d F Y', strtotime($datas->tgl_pengajuan)); 
                                    ?>                                    
                                    {{ $tanggal }}
                                </td>
                                <td>
                                    <?php 
                                        $tanggal_mulai = date('d F Y', strtotime($datas->tgl_mulai_cuti)); 
                                    ?>                                    
                                    {{ $tanggal_mulai }}
                                </td>
                                <td>
                                    <?php 
                                        $tanggal_selesai = date('d F Y', strtotime($datas->tgl_selesai_cuti)); 
                                    ?>                                    
                                    {{ $tanggal_selesai }}
                                </td>                                
                                <td>{{ $datas->alasan_cuti }}</td>                                
                                <td>
                                    @if($datas->status == "Sudah Di Acc")
                                        <span class="badge badge-success">{{ $datas->status }}</span>
                                    @elseif($datas->status == "Belum Di Acc")
                                        <span class="badge badge-warning">{{ $datas->status }}</span>
                                    @elseif($datas->status == "Gagal Di Acc")
                                        <span class="badge badge-danger">{{ $datas->status }}</span>
                                    @endif
                                </td>                                
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editCuti_{{ $datas->id_permintaan_cuti }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <div class="modal fade" id="editCuti_{{ $datas->id_permintaan_cuti }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Cuti</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ url('/pegawai/data-cuti/update/'.$datas->id_permintaan_cuti) }}" method="post">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="">ID Permintaan Cuti</label>
                                                            <input id="id_permintaan_cuti" type="text" class="form-control form-control-sm @error('id_permintaan_cuti') is-invalid @enderror" name="id_permintaan_cuti" value="{{ $datas->id_permintaan_cuti }}" required autocomplete="id_absensi" autofocus readonly>
                                                            @error('id_permintaan_cuti')
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
                                                            <label for="">Tanggal Pengajuan</label>                                                                                                                            
                                                            <input id="tanggal" type="date" class="form-control form-control-sm @error('tgl_pengajuan') is-invalid @enderror" name="tgl_pengajuan" value="{{ $datas->tgl_pengajuan }}" required autocomplete="tgl_pengajuan" autofocus>
                                                            @error('tgl_pengajuan')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror                                                                                                                                                                                            
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Tanggal Mulai dan Tanggal Selesai Cuti</label>
                                                            <div class="row no-gutters">
                                                                <div class="col-6 col-md-6 col-lg-6">
                                                                    <input id="tgl_mulai_cuti" type="date" class="form-control form-control-sm @error('tgl_mulai_cuti') is-invalid @enderror" name="tgl_mulai_cuti" value="{{ $datas->tgl_mulai_cuti }}" required autocomplete="tgl_mulai_cuti" autofocus>
                                                                    @error('tgl_mulai_cuti')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-6 col-md-6 col-lg-6">
                                                                    <input id="tgl_selesai_cuti" type="date" class="form-control form-control-sm @error('tgl_selesai_cuti') is-invalid @enderror" name="tgl_selesai_cuti" value="{{ $datas->tgl_selesai_cuti }}" required autocomplete="tgl_selesai_cuti" autofocus>
                                                                    @error('tgl_selesai_cuti')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>                                                                                                                        
                                                        </div>  
                                                        <div class="form-group">
                                                            <label for="">Alasan Cuti</label>
                                                            <textarea style="resize:none;" placeholder="Masukkan Alasan Cuti" name="alasan_cuti" id="alasan_cuti" class="form-control form-control-sm @error('alasan_cuti') is-invalid @enderror"  required autocomplete="alasan_cuti" autofocus>{{ $datas->alasan_cuti }}</textarea>                                                                                       
                                                            @error('alasan_cuti')
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
                                    <a href="{{ url('pegawai/data-cuti/delete/'.$datas->id_permintaan_cuti) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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
