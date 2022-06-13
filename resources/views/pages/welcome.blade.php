@extends('layouts.app')

@section('title', 'Home Page')

@section('bg-image')
<style>
    body{
        background:url('https://patroon.co.id/wp-content/uploads/2021/04/Gedung-Badan-Pusat-Statistik-BPS-Jakarta-Pusatview_web.jpg') no-repeat center center fixed;        
        -webkit-background-size: cover;
        -moz-background-size: cover;
        background-size: cover;
        -o-background-size: cover;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="col d-flex justify-content-center">
        <div class="card" style="background-color: rgba(245, 245, 245, 1); opacity: 0.8; margin-top:160px;">
            <div class="card-body">
                <div class="login-logo">
                    <a href="#" class="display-3"><b>BPS </b>Integration</a>
                </div>
                <div class="text-center mt-4">
                    @guest
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="me-1 btn btn-lg btn-outline-success">Login</a>
                        @endif

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ms-1 btn btn-lg btn-success">Daftar</a>
                        @endif
                    @else        
                        <div class="fs-4">Selamat Datang, {{ Auth::user()->nama_pegawai }}</div>                                    
                        <a href="" class="btn btn-outline-success mt-2">Lihat Dashboard</a>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endguest
                                        
                </div>
            </div>            
        </div>    
    </div>
</div>
@endsection