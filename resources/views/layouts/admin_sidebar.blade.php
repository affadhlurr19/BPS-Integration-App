<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BPS Integration | @yield('title')</title>
    
    <script src="{{ asset('js/app.js') }}" defer></script> 
    <script src="https://kit.fontawesome.com/f1223f01a6.js" crossorigin="anonymous"></script>
    
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('css/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">       
    <link rel="stylesheet" href="{{ asset('css/OverlayScrollbars.min.css') }}"> 
</head>
<!-- <body class="@yield('style-body')">
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div> -->
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">        
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>       
            </ul>        
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">        
            <a href="{{ route('/') }}" class="brand-link text-center" >
            <!-- <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
                <span class="brand-text font-weight-light">BPS Integration</span>
            </a>        
            <div class="sidebar">            
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="https://cdn-icons-png.flaticon.com/512/219/219983.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block" style="font-size:14px;">{{ Auth::user()->nama_pegawai }}</a>
                    </div>
                </div>            
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">                
                        @if(Auth::user()->level == 'admin')
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->route()->getName() === 'admin.dashboard' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
                            </a>
                        </li>   
                        <li class="nav-item">
                            <a href="{{ route('admin.show.data.pegawai') }}" class="nav-link {{ request()->route()->getName() === 'admin.show.data.pegawai' || 
                                request()->route()->getName() === 'admin.cari.data.pegawai' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-briefcase"></i><p>Data Pegawai</p>
                            </a>
                        </li>   
                        <li class="nav-item">
                            <a href="{{ route('admin.show.data.absensi') }}" class="nav-link {{ request()->route()->getName() === 'admin.show.data.absensi' || 
                                request()->route()->getName() === 'admin.cari.data.absensi' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-concierge-bell"></i><p>Data Absensi</p>
                            </a>
                        </li>   
                        <li class="nav-item">
                            <a href="{{ route('admin.show.data.cuti') }}" class="nav-link {{ request()->route()->getName() === 'admin.show.data.cuti' || 
                                request()->route()->getName() === 'admin.cari.data.cuti' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-running"></i><p>Data Cuti</p>
                            </a>
                        </li>   
                        <li class="nav-item">
                            <a href="{{ route('admin.show.data.angka.kredit') }}" class="nav-link {{ request()->route()->getName() === 'admin.show.data.angka.kredit' || 
                                request()->route()->getName() === 'admin.cari.data.angka.kredit' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-sort-numeric-up"></i><p>Data Angka Kredit</p>
                            </a>
                        </li>   
                        <li class="nav-item">
                            <a href="{{ route('admin.show.data.kegiatan') }}" class="nav-link {{ request()->route()->getName() === 'admin.show.data.kegiatan' || 
                                request()->route()->getName() === 'admin.cari.data.kegiatan' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-line"></i><p>Data Kegiatan</p>
                            </a>
                        </li>                                                
                        <li class="nav-item">
                            <a href="{{ route('admin.show.data.capaian.kinerja') }}" class="nav-link {{ request()->route()->getName() === 'admin.show.data.capaian.kinerja' ||
                                request()->route()->getName() === 'admin.cari.data.capaian.kinerja' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-star-half-alt"></i><p>Data Capaian Kinerja</p>
                            </a>
                        </li>    
                        @elseif(Auth::user()->level == 'pegawai')       
                        <li class="nav-item">
                            <a href="{{ route('pegawai.show.profile') }}" class="nav-link {{ request()->route()->getName() === 'pegawai.show.profile' ? 'active' : '' }}">                                
                                <i class="nav-icon fas fa-user"></i><p>My Profile</p>
                            </a>
                        </li>   
                        <li class="nav-item">
                            <a href="{{ route('pegawai.show.data.absensi') }}" class="nav-link {{ request()->route()->getName() === 'pegawai.show.data.absensi' || 
                                request()->route()->getName() === 'pegawai.cari.data.absensi' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-concierge-bell"></i><p>Data Absensi</p>
                            </a>
                        </li>   
                        <li class="nav-item">
                            <a href="{{ route('pegawai.show.data.cuti') }}" class="nav-link {{ request()->route()->getName() === 'pegawai.show.data.cuti' || 
                                request()->route()->getName() === 'pegawai.cari.data.cuti' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-running"></i><p>Data Cuti</p>
                            </a>
                        </li>   
                        <li class="nav-item">
                            <a href="{{ route('pegawai.show.data.angka.kredit') }}" class="nav-link {{ request()->route()->getName() === 'pegawai.show.data.angka.kredit' || 
                                request()->route()->getName() === 'pegawai.cari.data.angka.kredit' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-sort-numeric-up"></i><p>Data Angka Kredit</p>
                            </a>
                        </li>   
                        <li class="nav-item">
                            <a href="{{ route('pegawai.show.data.kegiatan') }}" class="nav-link {{ request()->route()->getName() === 'pegawai.show.data.kegiatan' || 
                                request()->route()->getName() === 'pegawai.cari.data.kegiatan' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-line"></i><p>Data Kegiatan</p>
                            </a>
                        </li>                                                
                        <li class="nav-item">
                            <a href="{{ route('pegawai.show.data.capaian.kinerja') }}" class="nav-link {{ request()->route()->getName() === 'pegawai.show.data.capaian.kinerja' ||
                                request()->route()->getName() === 'pegawai.cari.data.capaian.kinerja' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-star-half-alt"></i><p>Data Capaian Kinerja</p>
                            </a>
                        </li>  
                        @endif
                        <li class="nav-header">LAINNYA</li>                               
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="nav-icon fas fa-sign-out-alt"></i><p>Logout</p>
                            </a>                            
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                            </form>                        
                        </li>                                                
                    </ul>
                </nav>            
            </div>        
        </aside>
        <div class="content-wrapper">        
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield('current-page')</h1>
                        </div>                        
                    </div>
                </div>
            </section>        
            <section class="content">
                @yield('content')                
            </section>        
        </div>    
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block"></div>
            <strong>Copyright &copy; 2022 <a href="{{ route('/') }}">BPS Integration</a>.</strong> All rights reserved.
        </footer>    
        <aside class="control-sidebar control-sidebar-dark"></aside>    
    </div>    
</body>
@yield('charts')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/adminlte.min.js') }}"></script>
<script src="{{ asset('js/demo.js') }}"></script>
<script src="{{ asset('js/jquery.overlayScrollbars.min.js') }}"></script>
</html>
