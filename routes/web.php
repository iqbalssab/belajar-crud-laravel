<?php

use App\Http\Controllers\AdminCategoryController;
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
});

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

// Halaman daftar postingan berdasarkan user
Route::get('/authors/{author:username}', function(User $author){
    return view('posts', [
        'title' =>  "Post by Author : $author->name",
        'posts' => $author->post->load('category','user')
    ]);
});

// Menampilkan halaman login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');

// Autentikasi user yg sudah terdaftar/belum
Route::post('/login', [LoginController::class, 'authenticate']);

// proses logout
Route::post('/logout', [LoginController::class, 'logout']);

// Menampilkan halaman Register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
// memproses register user baru
Route::post('/register', [RegisterController::class, 'store']);

// Tampilkan halaman utama dashboard
Route::get('/dashboard', function (){
    return view('dashboard.index');
})->middleware('auth');

// Mengatasi CRUD
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

// Route untuk mendapatkan slug di create Post
Route::get('/dashboard/post/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');

Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('is_admin');