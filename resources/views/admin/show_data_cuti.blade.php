@extends('layouts.admin_sidebar')

@section('title', 'Data Cuti')
@section('current-page', 'Data Cuti')

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
                                    @elseif($datas->status == "Tidak Di Acc")
                                        <span class="badge badge-danger">{{ $datas->status }}</span>
                                    @endif
                                </td>                                
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