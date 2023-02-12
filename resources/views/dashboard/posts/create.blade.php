@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Post</h1>
</div>

<div class="col-lg-8">
    {{-- pake enctype=multipart untuk bisa upload gambar/image --}}
    <form method="post" action="/dashboard/posts" enctype="multipart/form-data">
        @csrf
        {{-- Title/judul --}}
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          {{-- kalo eror, munculin class 'is-invalid'. @error('namainput') namaclass @enderror --}}
          <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title') }}">
          {{-- untuk munculin pesan error nya --}}
          @error('title')
              <div class="invalid-feedback">
                {{-- $message diambil dari rules di Controller yg dibawa @error --}}
                {{ $message }}
              </div>
          @enderror
        </div>
        {{-- Slug --}}
        <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" readonly value="{{ old('title') }}">
          @error('slug')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
        </div>
        {{-- Kategori --}}
        <div class="mb-3">
          <label for="Category" class="form-label">Category</label>
          <select class="form-select" name="category_id">
            {{-- lakukan looping, ngambil dari method 'create' di controller --}}
            @foreach ($categories as $category)
            {{-- kalo ada kesalahan setelah pencet tombol create --}}
              @if (old('category_id') == $category->id)
              <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
              @else
              <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endif
            @endforeach
          </select>
        </div>
        {{-- Image --}}
        <div class="mb-3">
          <label for="image" class="form-label">Post Image</label>
          <img class="img-preview img-fluid mb-3 col-sm-5">
          <input class="form-control @error('image') is-invalid @enderror" name="image" type="file" id="image" onchange="previewImage()">
          @error('image')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
        </div>
        {{-- body --}}
        <div class="mb-3">
          <label for="body" class="form-label">Body</label>
          @error('body')
            <p class="text-danger">{{ $message }}</p>
          @enderror
          <input id="body" type="hidden" name="body" value="{{ old('body') }}">
          <trix-editor input="body"></trix-editor>
        </div>
      {{-- tombol create --}}
        <button type="submit" class="btn btn-primary mb-4">Create Post</button>
      </form>
</div>
<script>
  const title = document.querySelector('#title');
  const slugs = document.querySelector('#slug');

  title.addEventListener('change', function () {
    fetch('/dashboard/post/checkSlug?title=' + title.value)
    .then(response => response.json())
    .then(data => slugs.value = data.slug)
  });

  document.addEventListener('trix-file-accept', function(e){
    e.preventDefault();
  })

  function previewImage() {
    const image = document.querySelector('#image')
    const imgPreview = document.querySelector('.img-preview')
    
    imgPreview.style.display = 'block';

    const oFReader = new FileReader()
    oFReader.readAsDataURL(image.files[0])

    oFReader.onload = function(oFREvent){
      imgPreview.src = oFREvent.target.result;
    }
  }
</script>
@endsection