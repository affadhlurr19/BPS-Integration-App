@extends('layouts.admin_sidebar')

@section('title', 'Data Pegawai')
@section('current-page', 'Data Pegawai')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">                    
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
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
                                    <a href="" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <a href="" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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