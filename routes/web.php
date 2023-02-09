<?php

use App\Http\Controllers\DashboardPostController;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home', [
        "title" => "Home",
        "active" => "home",
    ]);
})->middleware('auth');

Route::get('/about', function () {
    return view('about', [
        "name" => "mark Zuckerberg",
        "email" => "mark@facebook.com",
        "image" => "mark-zuckerberg.jpg",
        "title" => "About",
        "active" => "about",
    ]);
})->middleware('auth');

// halaman semua Blog Post
Route::get('/posts', [PostController::class, 'index'])->middleware('auth');

// halaman single post
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->middleware('auth');

// Halaman daftar categories
Route::get('/categories', function() {
    return view('categories', [
        "title" => 'Post Categories',
        'categories' => Category::all(),
        "active" => "categories",
    ]);
});

// Halaman daftar postingan berdasarkan category
Route::get('/categories/{category:slug}', function(Category $category){
    return view('posts', [
        "title" => " Post by Category : $category->name",
        "posts" => $category->posts->load('category', 'user'),
        "active" => "categories"
    ]);
});

Route::get('/authors/{author:username}', function(User $author){
    return view('posts', [
        'title' =>  "Post by Author : $author->name",
        'posts' => $author->post->load('category','user')
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
 
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function (){
    return view('dashboard.index');
})->middleware('auth');

Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');