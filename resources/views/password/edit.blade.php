@extends('layouts.main')

@section ('konten')

<div class="row justify-content-center">
    <div class="col-lg-5">
        <main class="form-signin">

          @if(session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif

          @if(session()->has('gagal'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('gagal') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif

            <h3 class="h3 mb-3 fw-normal text-center">Silahkan ganti password</h3>
            <form action="/password.edit" method="post">
            @method("put")
            @csrf
                <div class="form-floating">
                    <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" placeholder="current_Password">
                    <label for="current_password">Password Lama</label>
                    @error ('current_password') 
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @endif
                </div>

                <div class="form-floating">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                    <label for="password">Password Baru</label>
                    @error ('password') 
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @endif
                </div>

                <div class="form-floating">
                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Password_confirmation">
                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                    @error ('password_confirmation') 
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @endif
                </div>
              <button class="w-100 btn btn-lg btn-primary" type="submit">Ganti password</button>
              <a href="/" class="w-100 btn btn-lg btn-light my-3"> Kembali ke halaman utama</a>
              
            </form>
            {{-- <small class="d-block text-center mt-4">Belum punya akun? <a href="/register">Daftar Sekarang</a></small> --}}
          </main> 
    </div>
</div>


@endsection