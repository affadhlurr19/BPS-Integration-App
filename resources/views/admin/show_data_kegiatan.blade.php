@extends('layouts.admin_sidebar')

@section('title', 'Data Kegiatan')
@section('current-page', 'Data Kegiatan')

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
                                <th>ID Kegiatan</th>
                                <th>NIP</th>
                                <th>Nama Kegiatan</th>
                                <th>Asal Kegiatan</th>
                                <th>Target</th>                                
                                <th>Realisasi</th>
                                <th>Satuan</th>
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
                                <td>{{ $datas->satuan }}</td>                                
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