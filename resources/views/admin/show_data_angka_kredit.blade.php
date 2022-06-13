@extends('layouts.admin_sidebar')

@section('title', 'Data Penilain Angka Kredit')
@section('current-page', 'Data Penilain Angka Kredit')

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