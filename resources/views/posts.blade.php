@extends('layouts.main')


@section('container')
    <h1 class="text-center">{{ $title }}</h1>

    <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <form action="/posts">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category')}}">  
                @endif
                @if (request('user'))
                    <input type="hidden" name="user" value="{{ request('user')}}">  
                @endif
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search..." name="search" value="{{ request('search') }}">
                    <button class="btn btn-outline-primary" type="submit" >Search</button>
                  </div>
            </form>
        </div>
    </div>
    
    @if ($posts->count())
    <div class="card mb-3">
            <img src="https://source.unsplash.com/1200x400?{{ $posts[0]->category->name }}" class="card-img-top" alt="{{ $posts[0]->category->name }}">
            <div class="card-body text-center">
                {{-- judul --}}
            <h2 class="card-title "><a class="text-decoration-none" href="/posts/{{ $posts[0]->slug }}">{{ $posts[0]->title }}</a>
            </h2>
            {{--nama author  --}}
            <p><b><small>
                By  <i><a href="/posts?user={{ $posts[0]->user->username }}" class="text-decoration-none text-success">{{ $posts[0]->user->name }}</a></i>
                in 
                {{-- kategori postingan --}}
                <i><a class="text-decoration-none text-danger" href="/posts?category={{ $posts[0]->category->slug }}"> {{ $posts[0]->category->name }} </a></i>
                {{-- waktu --}}
                <br/>
                <small class="text-muted -mt-3">Diunggah pada : {{ $posts[0]->created_at->diffForHumans() }}</small> 
            </small></b></p>
            {{-- excerpt --}}
            <p class="card-text">{{ $posts[0]->excerpt }}</p>

            

            <a href="/posts/{{ $posts[0]->slug }}" class="btn btn-primary mb-2">Read More</a>
        </div>
    </div>
    

    <div class="container">
        <div class="row">
            @foreach ($posts->skip(1) as $post)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="position-absolute bg-info mt-1 ms-1 p-2 rounded">
                        <small>
                          <a class="text-decoration-none text-light fw-bold" href="/posts?category={{ $post->category->slug }}">{{ $post->category->name }} </a>
                        </small>
                    </div>
                    <img src="https://source.unsplash.com/500x350?{{ $post->category->name }}" class="card-img-top" alt="{{ $post->category->name }}">
                    <div class="card-body">
                      <h5 class="card-title">
                        <a class="text-decoration-none text-dark" href="/posts/{{ $post->slug }}">{{ $post->title }} {{ $post->id }}</a>
                      </h5>
                        {{--nama author  --}}
                        <p><b><small>
                            By  <i><a href="/posts?user={{ $post->user->username }}" class="text-decoration-none text-success">{{ $post->user->name }}</a></i>
                        {{-- waktu --}}
                        <small class="text-muted">Diunggah pada : {{ $post->created_at->diffForHumans() }}</small>
                        
                        </small></b></p>
                        {{-- excerpt --}}
                        <p class="card-text">{{ $post->excerpt }}</p>

                        {{-- button --}}
                        <a href="/posts/{{ $post->slug }}" class="btn btn-primary mb-2">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    @else 
    <h3 class="text-center fs-4">No Post Found.</h3>
    @endif
    
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
    
@endsection

