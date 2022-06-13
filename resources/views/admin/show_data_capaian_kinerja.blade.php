@extends('layouts.admin_sidebar')

@section('title', 'Data Capaian Kinerja')
@section('current-page', 'Data Capaian Kinerja')

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