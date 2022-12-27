@extends('dashboard.layouts.main')

@section('konten')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Selamat Datang, {{ auth()->user()->name }}</h1>
</div>

<div class="row row-cols-1 row-cols-md-3 g-4 justify-content-start">
  <div class="col">
    <div class="card h-100">
      <div class="card-body">
        <h5 class="card-title fs-3">Postingan</h5>
        <p class="card-text">Jumlah postingan anda berjumlah</p>
        <p class="h2 text-center">{{ $postingan }}</p>
        <a href="/dashboard/postingan" class="btn btn-primary container mt-3">Cek Data</a>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <div class="card-body">
        <h5 class="card-title fs-3">User</h5>
        <p class="card-text">Jumlah user yang terdaftar</p>
        <p class="h2 text-center">{{ $user }}</p>
        <a href="/dashboard/user" class="btn btn-primary container mt-3">Cek Data</a>
      </div>
    </div>
  </div>
</div>
@endsection