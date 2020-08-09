<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Constants\Resource;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $this->authorize(Resource::POST_INDEX);

        $posts = Post::all();

        return view('admin.posts.index', ['posts' => $posts]);
    }

    public function new()
    {
        $post = new Post();
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

        return view('admin.posts.edit', [
            'post'       => $post,
            'categories' => $categoriesDropDown,
            'tags'       => $tagsDropDown,
        ]);
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

        return view('admin.posts.edit', [
            'post'       => $post,
            'categories' => $categoriesDropDown,
            'tags'       => $tagsDropDown,
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

        if (!is_null($request->input('post_id'))) {
            $tags = $request->input('tags')
                ? Tag::whereIn('tag_id', $request->input('tags'))->get()
                : [];
            $post->tags()->sync($tags);
        }

        $post->save();

        if (is_null($request->input('post_id'))) {
            $tags = $request->input('tags')
                ? Tag::whereIn('tag_id', $request->input('tags'))->get()
                : [];
            $post->tags()->attach($tags);
            $post->save();

            return [
                'process'     => 'success',
                'post_id'     => $post->post_id,
                'redirect_to' => route('posts.edit', $post->post_id),
            ];
        } else {
            return ['process' => 'success'];
        }
    }
}
