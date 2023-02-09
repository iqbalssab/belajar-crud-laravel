<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $title = '';
        if(request('category')){
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in '. $category->name;
        }
        
        if(request('user')){
            $user = User::firstWhere('username', request('user'));
            $title = ' oleh '. $user->name;
        }

        return view('posts', [
            "title" => "All Post". $title,
            "posts" => Post::latest()->filter(request(['search', 'category','user']))->paginate(7)->withQueryString(),
            "active" => "posts"
        ]);
    }

    public function show(Post $post)
    {
        return view('post', [
            "title" => $post->title,
            "post" => $post,
            "active" => "posts",
        ]);
    }
}
