@extends('layouts.main')


@section('container')
    <h1 class="mb-5">Post Categories</h1>


    <div class="container">
        <div class="row">
            @foreach ($categories as $category)
                
            <div class="col-md-4">
                <a href="/posts?category={{ $category->slug }}" class="text-decoration-none">
                <div class="card bg-dark text-white">
                        <img src="https://source.unsplash.com/500x350?{{ $category->name }}" class="card-img" style="filter:blur(1px); -webkit-filter:blur(1px);" alt="{{ $category->name }}">
                        <div class="card-img-overlay d-flex align-items-center p-0">     
                            <h5 class="card-title text-white text-center flex-fill p-2 fs-4" style="background-color: rgba(0,0,0,0.7)">{{ $category->name }}</h5>
                        </div>
                </div>
                </a>
            </div>

            @endforeach
        </div>
    </div>

   
    
@endsection

