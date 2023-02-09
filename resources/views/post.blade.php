
@extends('layouts.main')

@section('container')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-4">
                <h2>{{ $post->title }}</h2>
                
                <p><b><i> 
                    By <a href="/authors/{{ $post->user->username }}" class="text-decoration-none">{{ $post->user->name }}</a>  
                    in 
                    <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none"> {{ $post->category->name }} </a> 
                    <br/>
                    <small class="text-muted">Diunggah pada : {{ $post->created_at->diffForHumans() }}</small>
                </i></b></p>
                
                <img src="https://source.unsplash.com/1080x720?{{ $post->category->name }}" class="card-img-top mb-3" alt="{{ $post->category->name }}">
                
                <article>
                    {!! $post->body !!}
                </article>
                
                <a class="btn btn-outline-success mt-4" href="/posts" role="button">Kembali ke Blog</a>
            </div>
        </div>
    </div>

    
@endsection

