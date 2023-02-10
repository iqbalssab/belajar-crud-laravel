@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ auth()->user()->name }}'s Posts</h1>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
          {{ session('success') }}
        </div>
    @endif

  <div class="table-responsive col-lg">
    <a href="/dashboard/posts/create" class="btn btn-outline-primary mb-3"> Create New Post</a>
    <table class="table table-hover table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Category</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($posts as $post)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td><a href="/posts/{{ $post->slug }}" class="fs-6 text-decoration-none text-dark">{{ $post->title }}</a></td>
            <td><a href="/posts?category={{ $post->category->slug }}&user={{ $post->user->username }}">{{ $post->category->name }}</a></td>
            <td>
              <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info text-light mb-1"><span class="" data-feather="eye"></span></a>
              <a href="#" class="badge bg-warning text-light fw-bold mb-1"><span class="" data-feather="edit"></span></a>
              <a href="#" class="badge bg-danger text-light fw-bold mb-1"><span class="" data-feather="trash-2"></span></a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection