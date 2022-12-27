@extends('dashboard.layouts.main')

@section('konten')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Detail Postingan</h1>
</div>

<form action="/dashboard/postingan" id="search">
  @if (request('category'))
    <input type="hidden" name="category" value="{{ request('category') }}">   
  @endif
<div class="input-group mb-3">
    <input type="search" class="form-control" placeholder="Mau cari apa?" name="search" id="search" aria-describedby="button-addon2">
    <button class="btn btn-dark px-4" type="submit" id="button-addon2">Cari</button>
  </div>
</form>

<div class="table-responsive col-lg">
  <a href="/dashboard/postingan/create" class="btn btn-primary mb-3"><span data-feather="plus"></span> Tambah postingan baru</a>

  @if(session()->has('success'))
  <div class="alert alert-success col-lg-8" role="alert">
    {{ session('success') }}
  </div>
  @endif

  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Judul</th>
        <th scope="col">Kategori</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    @foreach ($postingan as $posts)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $posts->judul }}</td>
      <td>{{ $posts->category->name }} - {{ $posts->category->subcategories }}</td>
      <td>
          <a href="/dashboard/postingan/{{ $posts->slug }}" class="badge bg-info">
              <span data-feather="eye"></span>
          </a>
          <a href="/dashboard/postingan/{{ $posts->slug }}/edit" class="badge bg-warning">
            <span data-feather="edit"></span>
          </a>
          <form action="/dashboard/postingan/{{ $posts->slug }}" method="post" class="d-inline">
            @method('delete')
            @csrf
          <button class="badge bg-danger border-0" onclick="return confirm ('Apakah kamu yakin ingin menghapus postingan ini?')"><span data-feather="trash-2"></span></button>
          </form>
        </td>
      </td>
    </tr>
    @endforeach
  </table>
</div>
@endsection