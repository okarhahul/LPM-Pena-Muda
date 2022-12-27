@extends('dashboard.layouts.main')

@section('konten')

<a href="/dashboard/postingan" class="btn btn-success my-3"><span data-feather="arrow-left"></span> Kembali ke Detail Postingan</a>
<a href="/dashboard/postingan/{{ $singlepost->slug }}/edit" class="btn btn-warning my-3"><span data-feather="edit"></span> Edit Postingan</a>
<form action="/dashboard/postingan/{{ $singlepost->slug }}" method="post" class="d-inline">
    @method('delete')
    @csrf
  <button class="btn btn-danger border-0" onclick="return confirm ('Apakah kamu yakin ingin menghapus postingan ini?')"><span data-feather="trash-2"></span> Hapus Postingan</button>
  </form>

  @if ($singlepost->image)
  <img src="{{ asset('storage/' . $singlepost->image) }}" alt="" class="img-fluid d-flex">
  @else
  <img src="https://picsum.photos/200/300?grayscale" alt="" class="img-fluid d-flex">
  @endif

<h1 class="mb-3">{{ $singlepost->judul }}</h1>
<p>Kategori <a href="/?category={{ $singlepost->category->slug }}">{{ $singlepost->category->name }} - {{ $singlepost->category->subcategories }}</a></p>
<div class="mb-3">
    {!! $singlepost->body !!}
</div>


@endsection