<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Show the blog dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $posts = Post::search($request->search)->orderBy('published_at', 'desc')->paginate();
        $categories = Category::all();

        return view('posts.index', ['posts' => $posts, 'categories' => $categories]);
    }

    /**
     * Show all posts with a particular caterogy
     *
     * @param Category $category
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function category(Category $category)
    {
        $posts = Post::where('category_id', $category->category_id)
            ->orderBy('published_at', 'desc')->paginate();
        $categories = Category::all();

        return view('posts.index', [
            'posts' => $posts,
            'categories' => $categories,
            'showing' => $category,
        ]);
    }
}
