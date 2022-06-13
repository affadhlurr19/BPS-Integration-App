@extends('layouts.app')

@section('title', 'Register Page')
@section('style-body', 'hold-transition register-page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="register-box" style="width:600px;">
            <div class="card card-outline card-success">
                <div class="card-header text-center">
                    <a href="{{ url('/') }}" class="h1" style="color:black;"><b>BPS</b> Integration</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Daftar data pegawai</p>                    
                    <form method="POST" action="{{ route('register') }}">
                        @csrf               
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <input min="1" id="nik" type="text" pattern="\d*" maxlength="10" placeholder="Nomor Induk Pegawai" class="form-control form-control-sm @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" required autocomplete="nik" autofocus>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-id-card"></span>                                            
                                        </div>
                                    </div>   
                                    @error('nik')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                         
                                </div>
                                <div class="input-group mb-3">
                                    <input id="nama_pegawai" placeholder="Nama Lengkap Pegawai" type="text" class="form-control form-control-sm @error('nama_pegawai') is-invalid @enderror" name="nama_pegawai" value="{{ old('nama_pegawai') }}" required autocomplete="nama_pegawai" autofocus>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    @error('nama_pegawai')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <input id="email" placeholder="Alamat Email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <input id="password" placeholder="Password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">                            
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                            
                                </div>
                                <div class="input-group mb-3">
                                    <input id="password-confirm" placeholder="Masukkan Ulang Password" type="password" class="form-control form-control-sm" name="password_confirmation" required autocomplete="new-password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>                                                  
                                </div>
                                <div class="input-group mb-3">
                                    <div class="form-check form-check-inline" style="font-size:14px;">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Laki-Laki">
                                        <label class="form-check-label" for="jenis_kelamin">Laki-Laki</label>
                                    </div>
                                    <div class="form-check form-check-inline" style="font-size:14px;">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Perempuan" >
                                        <label class="form-check-label" for="jenis_kelamin">Perempuan</label>
                                    </div>                                
                                    @error('jenis_kelamin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                                                
                                </div> 
                                <div class="input-group mb-3">
                                    <textarea style="resize:none;" placeholder="Alamat Rumah" name="alamat" id="alamat" class="form-control form-control-sm @error('alamat') is-invalid @enderror"  required autocomplete="alamat" autofocus>{{ old('alamat') }}</textarea>                                
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-location-arrow"></span>                                        
                                        </div>
                                    </div>
                                    @error('alamat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">                                                                             
                                <div class="input-group mb-3">
                                    <input id="tim" placeholder="Nama Tim" type="text" class="form-control form-control-sm @error('tim') is-invalid @enderror" name="tim" value="{{ old('tim') }}" required autocomplete="tim" autofocus>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-users"></span>                                            
                                        </div>
                                    </div>
                                    @error('tim')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                                <div class="input-group mb-3">
                                    <select class="form-select form-select-sm @error('agama') is-invalid @enderror" name="agama" value="{{ old('agama') }}" required autocomplete="agama" autofocus>
                                        <option value="Islam">Islam</option>
                                        <option value="Protestan">Protestan</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Khonghucu">Khonghucu</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                    @error('agama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                                <div class="input-group mb-3">
                                    <input id="tempat_lahir" placeholder="Tempat Lahir" type="text" class="form-control form-control-sm @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required autocomplete="tempat_lahir" autofocus>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-map"></span>                                            
                                        </div>
                                    </div>
                                    @error('tempat_lahir')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>          
                                <div class="input-group mb-3">
                                    <input id="tanggal_lahir" placeholder="Tanggal Lahir" type="date" class="form-control form-control-sm @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required autocomplete="tanggal_lahir" autofocus>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-calendar"></span>                                            
                                        </div>
                                    </div>
                                    @error('tanggal_lahir')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>    
                                <div class="input-group mb-3">
                                    <input id="nomor_telepon" placeholder="Nomor Telepon" type="text" pattern="\d*" maxlength="13" class="form-control form-control-sm @error('nomor_telepon') is-invalid @enderror" name="nomor_telepon" value="{{ old('nomor_telepon') }}" required autocomplete="nomor_telepon" autofocus>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-phone"></span>                                            
                                        </div>
                                    </div>
                                    @error('nomor_telepon')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>                                                  
                                <button type="submit" class=" mt-2 btn btn-sm btn-success">Daftar</button>                           
                                <p class="mt-3 mb-0">
                                    <a href="{{ url('login') }}" class="text-center">Masuk Disini</a>
                                </p> 
                            </div>
                        </div>                             
                    </form>                                                           
                </div>                
            </div>
        </div>        
    </div>
</div>
@endsection
