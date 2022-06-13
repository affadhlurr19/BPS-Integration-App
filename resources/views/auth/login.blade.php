@extends('layouts.app')

@section('title', 'Login Page')
@section('style-body', 'hold-transition login-page')

@section('content')
<div class="container">
    <div class="row justify-content-center">       
        <div class="login-box">            
            <div class="card card-outline card-success">
                <div class="card-header text-center">
                    <a href="{{ url('/') }}" class="h1" style="color:black;"><b>BPS</b> Integration</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Masuk untuk memulai sesi</p>
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" placeholder="Alamat Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-4">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>                                                
                        <button type="submit" class="btn btn-success btn-block">Masuk</button>                                                
                    </form>                                                      
                    <p class="mt-3 mb-0">
                        <a href="{{ url('register') }}" class="text-center">Daftar Akun</a>
                    </p>
                </div>                
            </div>            
        </div>        
    </div>
</div>
@endsection
