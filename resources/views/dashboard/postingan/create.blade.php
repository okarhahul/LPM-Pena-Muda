@extends('dashboard.layouts.main')

@section('konten')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah postingan</h1>
    </div>

    <div class="col-lg-8">
        <form method="post" action="/dashboard/postingan" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="judul" class="form-label">Judul</label>
              <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" required autofocus value="{{ old('judul') }}">
              @error('judul')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Kategori</label>
                <select class="form-select" name="category_id">
                  @foreach ($categories as $category)
                  {{-- <option value="{{ $category->id }}">{{ $category->name }}</option> --}}
                    @if(old('category_id') == $category->id)
                      <option value="{{ $category->id }}" selected>{{ $category->name }} - {{ $category->subcategories }} </option>
                    @else
                      <option value="{{ $category->id }}">{{ $category->name }} - {{ $category->subcategories }}</option>
                    @endif
                  @endforeach
                </select>
              </div>

              <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control @error('penulis') is-invalid @enderror" id="penulis" name="penulis" required autofocus value="{{ old('penulis') }}">
                @error('penulis')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="mb-3">
                <label for="editor" class="form-label">Editor</label>
                <input type="text" class="form-control @error('editor') is-invalid @enderror" id="editor" name="editor" required autofocus value="{{ old('editor') }}">
                @error('editor')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
  
              <div class="mb-3">
                <label for="image" class="form-label">Pilih gambar</label>
                <img class="img-preview img-fluid mb-3 col-md-7">
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
                @error('image')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
  
              <div class="mb-3 w-25">
                <label for="waktu" class="form-label">Waktu</label>
                <input type="date" class="form-control @error('waktu') is-invalid @enderror" id="waktu" name="waktu" required autofocus value="{{ old('waktu') }}">
                @error('waktu')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
  
              <div class="mb-3">
                <label for="body" class="form-label">Isi</label>
                @error('body')
                <p class="text-danger">{{ $message }}</p>
                @enderror
                <input id="body" type="hidden" name="body" value="{{ old('body') }}" required>
                <trix-editor input="body"></trix-editor>
              </div>
              <button type="submit" class="btn btn-primary">Tambahkan postingan <span data-feather="send"></span> </button>
            </form>
        </form>
    </div>

    <script>
      document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
      })


      function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent){
          imgPreview.src = oFREvent.target.result;
        }
      }
    </script>

@endsection