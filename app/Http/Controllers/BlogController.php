<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;

class BlogController extends Controller
{
    /**
     * Show the blog dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::orderBy('published_at', 'desc')->get();
        $categories = Category::all();

        return view('blog.index', ['posts' => $posts, 'categories' => $categories]);
    }

    /**
     * Show all posts with a particular caterogy
     *
     * @param mixed $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function category($id)
    {
        $category = Category::findOrFail($id);
        $posts = Post::where('category_id', $category->category_id)->orderBy('published_at', 'desc')->get();
        $categories = Category::all();

        return view('blog.index', [
            'posts' => $posts,
            'categories' => $categories,
            'showing' => $category,
        ]);
    }
}
