@extends('dashboard.layouts.main')

@section('container')

    <div class="row mt-3 mb-5">
        <div class="col-lg-8 mb-4">
            <h2>{{ $post->title }}</h2> 
            <p><b><i> 
                <small class="text-muted">Diunggah pada : {{ $post->created_at->diffForHumans() }}</small>
            </i></b></p>
            
            <a class="btn btn-outline-success mt-2" href="/dashboard/posts" role="button"><span class="" data-feather="arrow-left"></span> Kembali ke Dashboard</a>
            <a class="btn btn-outline-warning mt-2" href="/dashboard/posts" role="button"><span class="" data-feather="edit"></span> Edit</a>
            <a class="btn btn-outline-danger mt-2" href="/dashboard/posts" role="button"><span class="" data-feather="trash-2"></span> Delete</a>

            <img src="https://source.unsplash.com/1080x720?{{ $post->category->name }}" class="card-img-top mb-3 mt-3" alt="{{ $post->category->name }}">
            
            <article>
                {!! $post->body !!}
            </article>
            
        </div>
    </div>

@endsection