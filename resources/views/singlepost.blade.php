@extends('layouts.main')

@section('konten')

    <p class="fs-2 fw-bolder">{{ $singlepost->judul }}</p>
    <p class="fs-6 text-muted mb-1">Penulis {{ $singlepost->penulis }}</p>
    <p class="fs-6 text-muted mb-1">Editor {{ $singlepost->editor }}</p>
    <p class="fs-6 text-muted mb-1">Kategori {{ $singlepost->category->name }} - {{ $singlepost->category->subcategories }}</p>
    @php
        date_default_timezone_set("Asia/Jakarta");
        $date=date_create($singlepost->waktu);
        $format_date= date_format($date, "d/m/Y");
    @endphp
    <p class="fs-6 text-muted mb-2">Dipublikasikan {{ $format_date }}</p>

    @if ($singlepost->image)
    <img src="{{ asset('storage/' . $singlepost->image) }}" alt="" class="img-fluid d-flex">
    @else
    <img src="https://picsum.photos/200/300?grayscale" alt="" class="img-fluid d-flex">
    @endif


    {!! $singlepost->body !!}

    {{-- <a href="/">kembali ke postingan lainnya</a> --}}

    <div class="d-grid gap-2 d-md-block mb-3 mt-3">

        @guest
        <form action="/jurnalistik/like/{{ $singlepost->id }}" method="post" class="d-inline">
            @method('post')
            @csrf
          <button class="btn btn-danger justify-content-end" type="button" onclick="return confirm ('Mohon maaf, anda tidak bisa menyukai postingan ini. Silahkan login terlebih dahulu')"><i class="bi bi-heart"></i> {{ ($singlepost->is_liked() ? 'Tidak Suka' : 'Suka') }}</button>
        </form>
        @endguest

        @auth
            <button class="btn btn-danger justify-content-end" type="button" onclick="like({{ $singlepost->id }}, this)"><i class="bi bi-heart"></i> {{ ($singlepost->is_liked() ? 'Tidak Suka' : 'Suka') }} </button>      
        @endauth

        {{-- <button class="btn btn-danger justify-content-end" type="button" onclick="like({{ $singlepost->id }}, this)"><i class="bi bi-heart"></i> {{ ($singlepost->is_liked() ? 'Tidak Suka' : 'Suka') }} </button>     --}}

        {{-- <button class="btn btn-danger justify-content-end" type="button"><i class="bi bi-heart"></i> Like </button>   --}}

        <button class="btn btn-primary" id="btn-komentar-utama"><i class="bi bi-chat-square-text"></i> Komentar</button>
    </div>

    <input type="hidden" name="postingan_id" value="{{ $singlepost->id }}">
            <form action="/postingan/komentar" style="display:none;" id="komentar-utama" method="post">
                @csrf
                <input type="hidden" name="singlepost_id" value="{{ $singlepost->id }}">
                <textarea class="form-control mb-3" name="komentar" cols="30" rows="4"></textarea>
                <input type="submit" class="btn btn-primary" value="Kirim">
            </form>

    {{-- ini adalah ketika komentar itu sudah di kirim --}}
    <h6>Komentar</h6>
        <hr>
        <ul class="list-unstyled activity-list">
            @if ($singlepost->interaction_id)
            @foreach ($comments as $coment)
                    <div class="mb-3">
                        <h6>{{ $coment->user->name }}</h6>
                        <small>{{ $coment->komentar }}</small>
                        <small class="timestamp d-flex">{{ $coment->created_at->diffForHumans() }}</small>
                        <hr>
                    </div>
            @endforeach
                @else
                    <p class="text-center">belum ada komentar</p>
                @endif
        </ul>
    

    {{-- Jquery --}}
    {{-- Jquery perlu kita install saat kita membutuhkan saja, jika tidak maka tidak perlu --}}
    <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>

    <script>
        function like(id, el){
            fetch('/postingan/like/' + id)
            .then(response => response.json())
            .then(data => {
                el.innerHTML = (data.status == 'LIKE') ? '<i class="bi bi-heart"></i> Tidak Suka' : '<i class="bi bi-heart"></i> Suka'
            });
        }
    </script>

    <script>
        $(document).ready(function(){
            $('#btn-komentar-utama').click(function(){
                $('#komentar-utama').toggle('slide');
            });
        });
    </script>

  
@endsection