@extends('layouts.main')

@section('konten')
<h1 class="h3 mb-3 fw-normal text-center mt-3">Silahkan Masuk!</h1>
<div class="row justify-content-center">
    <div class="col-md-5">
        <main class="form-signin">

            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
  
            @if(session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('loginError') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <form accept="/login" method="post">
            @csrf
            <div class="form-floating">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}"> 
                <label for="email">Alamat Email</label>
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
                <label for="password">Kata Sandi</label>
                </div>
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            <button class="w-100 btn btn-lg btn-primary" type="submit">Masuk!</button>
            </form>

            <small class="d-block text-center mt-3">Belum punya akun? <a href="/register">Daftar Sekarang!</p>
        </main>
    </div>
</div>
@endsection