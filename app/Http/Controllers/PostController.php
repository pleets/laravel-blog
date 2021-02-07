<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    public function read($title)
    {
        $title = hash('md5', $title);
        $post = Post::where('url_hash', $title)->firstOrFail();

        $categories = Category::all();

        return view('posts.read', ['post' => $post, 'categories' => $categories]);
    }
}
