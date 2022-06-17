@extends('layouts.admin_sidebar')

@section('title', 'Admin Dashboard')
@section('current-page', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="col-12 col-md-12 col-lg-12 mb-3">
        <div id="data_cuti" style="width:100%"></div>
    </div>    
    <div class="row">
        <div class="col-12 col-md-12 col-lg-7 mb-3">
            <div id="data_absensi" style="width:100%"></div>
        </div>
        <div class="col-12 col-md-12 col-lg-5 mb-3">
            <div id="data_kegiatan" style="width:100%"></div>
        </div>
        <div class="col-12 col-md-12 col-lg-5 mb-3">
            <div id="data_capaian" style="width:100%"></div>
        </div>
        <div class="col-12 col-md-12 col-lg-7 mb-3">
            <div id="data_kredit" style="width:100%"></div>
        </div>
    </div>    
</div>
@endsection

@section('charts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    Highcharts.chart('data_cuti', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Statisik Data Cuti yang Sudah di Acc dan Belum di Acc'
        },        
        xAxis: {
            categories: [
                'Belum di Acc',
                'Sudah di Acc'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total Karyawan'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Jumlah Data',
            data: [{!! json_encode($data_belum_acc) !!}, {!! json_encode($data_sudah_acc) !!}]

        }]
    });
</script>
<script>
    Highcharts.chart('data_absensi', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Data Statistik Ketepatan Absensi Pegawai'
        },        
        xAxis: {
            categories: [
                'Jam Masuk',
                'Jam Pulang'                
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Tepat',
            data: [{!! json_encode($data_masuk_tepat) !!}, {!! json_encode($data_pulang_tepat) !!}]

        }, {
            name: 'Telat',
            data: [{!! json_encode($data_masuk_telat) !!}, {!! json_encode($data_pulang_telat) !!}]

        }]
    });
</script>
<script>
    Highcharts.chart('data_kegiatan', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Statistik Data Kegiatan yang Sudah Terlaksana dan Belum Terlaksana'
        },        
        xAxis: {
            categories: ['Terlaksana', 'Belum Terlaksana'],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' Kegiatan'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },        
        credits: {
            enabled: false
        },
        series: [{
            name: 'Kegiatan',
            data: [{!! json_encode($data_kegiatan_terlaksana) !!}, {!! json_encode($data_kegiatan_blm_terlaksana) !!}]
        }]
    });
</script>
<script>
    Highcharts.chart('data_capaian', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Statisik Data Nilai Dari Capaian Kinerja Pegawai di Tahun 2022'
        },        
        xAxis: {
            categories: [
                '0',
                '10',
                '20',
                '30',
                '40',
                '50',
                '60',
                '70',
                '80',
                '90',
                '100'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total Karyawan'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Nilai',
            data: [{!! json_encode($data_nilai_0) !!}, {!! json_encode($data_nilai_10) !!}, {!! json_encode($data_nilai_20) !!}, {!! json_encode($data_nilai_30) !!}, {!! json_encode($data_nilai_40) !!}, {!! json_encode($data_nilai_50) !!}, {!! json_encode($data_nilai_60) !!}, {!! json_encode($data_nilai_70) !!}, {!! json_encode($data_nilai_80) !!}, {!! json_encode($data_nilai_90) !!}, {!! json_encode($data_nilai_100) !!}]

        }]
    });
</script>
<script>
    Highcharts.chart('data_kredit', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Statistik Tanggal Usulan Penilaian Angka Kredit di Tahun 2022'
        },        
        xAxis: {
            categories: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' Kegiatan'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },        
        credits: {
            enabled: false
        },
        series: [{
            name: 'Tanggal Usulan',
            data: [
                    {!! json_encode($data_kredit_jan) !!}, 
                    {!! json_encode($data_kredit_feb) !!}, 
                    {!! json_encode($data_kredit_mar) !!}, 
                    {!! json_encode($data_kredit_apr) !!}, 
                    {!! json_encode($data_kredit_mei) !!}, 
                    {!! json_encode($data_kredit_jun) !!}, 
                    {!! json_encode($data_kredit_jul) !!}, 
                    {!! json_encode($data_kredit_agu) !!}, 
                    {!! json_encode($data_kredit_sep) !!}, 
                    {!! json_encode($data_kredit_okt) !!}, 
                    {!! json_encode($data_kredit_nov) !!}, 
                    {!! json_encode($data_kredit_des) !!}
                ]
        }]
    });
</script>

@endsection