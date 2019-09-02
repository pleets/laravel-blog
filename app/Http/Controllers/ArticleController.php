<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['new', 'edit', 'save']);
    }

    public function read($title)
    {
        $title = hash('md5', $title);
        $post = Post::where('url_hash', $title)->firstOrFail();

        $categories = Category::all();

        return view('article.read', ['post' => $post, 'categories' => $categories]);
    }

    public function new()
    {
        $post = new Post();
        $categories = Category::all();

        $categoriesDropDown = [];
        foreach ($categories as $category) {
            $categoriesDropDown[$category->category_id] = $category->name;
        }

        return view('article.edit', ['post' => $post, 'categories' => $categoriesDropDown]);
    }

    public function edit($id)
    {
        $post       = Post::findOrFail($id);
        $categories = Category::all();
        $tags       = Tag::all();

        $categoriesDropDown = [];
        foreach ($categories as $category) {
            $categoriesDropDown[$category->category_id] = $category->name;
        }

        $tagsDropDown = [];
        foreach ($tags as $tag) {
            $tagsDropDown[$tag->tag_id] = $tag->name;
        }

        return view('article.edit', [
            'post'       => $post,
            'categories' => $categoriesDropDown,
            'tags'       => $tagsDropDown
        ]);
    }

    public function save(Request $request)
    {
        if (is_null($request->input('post_id'))) {
            $post = new Post();
            // TODO: Handle when author does not exists
            $post->author_id = Auth::user()->author->author_id;
        } else {
            $post = Post::findOrFail($request->input('post_id'));
        }

        $post->title        = $request->input('title');
        $post->category_id  = $request->input('category');
        $post->content      = $request->input('content');
        $post->description  = $request->input('description');
        $post->image        = $request->input('image');
        $post->url_path     = $request->input('url');
        $post->url_hash     = hash('md5', $request->input('url'));
        $post->published_at = $request->input('published_at');
        $post->updated_at   = date('Y-m-d h:i:s');

        $tags = $request->input('tags')
            ? Tag::whereIn('tag_id', $request->input('tags'))->get()
            : [];

        $post->tags()->sync($tags);
        $post->save();

        if (is_null($request->input('post_id'))) {
            return [
                'process'     => 'success',
                'post_id'     => $post->post_id,
                'redirect_to' => route('article.edit', $post->post_id)
            ];
        } else {
            return ['process' => 'success'];
        }
    }
}
