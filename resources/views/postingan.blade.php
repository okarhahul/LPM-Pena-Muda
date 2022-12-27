@extends('layouts.main')

@section('konten')

<h4 class="mb-3 text-center">Anda sedang di halaman {{ $title }}</h4>

<form action="/" id="search">
  @if (request('category'))
    <input type="hidden" name="category" value="{{ request('category') }}">   
  @endif
<div class="input-group mb-3">
    <input type="search" class="form-control" placeholder="Mau cari apa?" name="search" id="search" aria-describedby="button-addon2">
    <button class="btn btn-dark px-4" type="submit" id="button-addon2">Cari</button>
  </div>
</form>

<div class="row row-cols-1 row-cols-md-3 g-4" id="result">
  @foreach ($postingan as $posts)
  <div class="col">
    <div class="card h-100">
      <img src="{{ asset('storage/' . $posts->image) }}" alt="" class="img-fluid d-flex">


        <div class="card-body">
          <h5 class="card-title">
            <a href="/singlepost/{{ $posts->slug }}" class="text-decoration-none">{{ $posts->judul }}</a></h5>
          
            <p class="fs-6 text-muted mb-1">Penulis {{ $posts->penulis }}</p>
            <p class="fs-6 text-muted mb-1">Editor {{ $posts->editor }}</p>

          <p>Kategori <a href="/?category={{ $posts->category->slug }}" class="text-decoration-none">{{ $posts->category->name }} - {{ $posts->category->subcategories }}</a></p>

          <p class="card-text">{{ $posts->headline }}</p>
        </div>
        <div class="card-footer">
          @php
          date_default_timezone_set("Asia/Jakarta");
          $date=date_create($posts->waktu);
          $format_date= date_format($date, "d/m/Y");
          @endphp
          <p class="fs-6 text-muted">Dipublikasikan {{ $format_date }}</p>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  
  <script>
    let form = document.getElementById('search');

    form.addEventListener('beforeinput', e => {
      var startTime = performance.now();

      const formdata = new FormData(form);
      let search = formdata.get('search');
      let url = "{{ route('search', "search=") }}"+search
  
      fetch(url)
      .then(response => response.json())
      .then(data => {
      let i;
      let result = "";
      if(data.length === 0){
        result += '<div class="mb-3">Data tidak ditemukan</div>'  
      }
      for (i=0; i < data.length; i++) {
        let postingan = data[i];
        result += `
              <div class="col">
                <div class="card h-100 shadow-sm">
                  <img src="storage/${data[i].image}" alt="" class="img-fluid d-flex">
                  <div class="card-body">
                        <h5 class="card-title">
                        <a href="/singlepost/${data[i].slug}" class="text-decoration-none">${data[i].judul}</a>
                        </h5>
                        <p class="fs-6 text-muted mb-1">Penulis ${data[i].penulis}</p>
                        <p class="fs-6 text-muted mb-1">Editor ${data[i].editor}</p>
                        <p>Category <a href="/postingan?category=${data[i].category.slug}" class="text-decoration-none">${data[i].category.name} - ${data[i].category.subcategories}</a></p>
                        <p class="card-text">${data[i].headline}</p>
                    </div>
                    <div class="card-footer">
                    <small class="text-muted">Dipublikasikan ${data[i].waktu}</small>
                    </div>
                    </div>
                </div>`;
          // console.log(data[i]);
          
      }
      document.getElementById('result').innerHTML = result;
      })
      .catch((err) => console.log(err))
      var endTime = performance.now();
      console.log(`Waktu hasil pencarian ${(endTime - startTime) / 1000} detik`)

      })
      console.log(form)
</script>


  
@endsection