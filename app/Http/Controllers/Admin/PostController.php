<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Constants\Resource;
use App\Helpers\CollectionParser;
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

    public function create()
    {
        $this->authorize(Resource::POST_CREATE);

        $post = new Post();

        return view('admin.posts.create', [
            'post'       => $post,
            'categories' => CollectionParser::toKeyPair(Category::all(), 'category_id', 'name'),
            'tags'       => CollectionParser::toKeyPair(Tag::all(), 'tag_id', 'name'),
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize(Resource::POST_CREATE);

        $data = $request->except('_token');
        // TODO: Handle when author does not exists
        $data['author_id'] = Auth::user()->author->author_id;
        $data['url_hash'] = hash('md5', $request->input('url_path'));
        $data['updated_at'] = date('Y-m-d h:i:s');

        $post = Post::create($data);

        $tags = $request->input('tags')
            ? Tag::whereIn('tag_id', $request->input('tags'))->get()
            : [];
        $post->tags()->attach($tags);
        $post->save();

        return [
            'process'     => 'success',
            'post_id'     => $post->post_id,
            'redirect_to' => route('admin.posts.edit', $post->post_id),
        ];
    }

    public function edit(Post $post)
    {
        $this->authorize(Resource::POST_UPDATE);

        return view('admin.posts.edit', [
            'post'       => $post,
            'categories' => CollectionParser::toKeyPair(Category::all(), 'category_id', 'name'),
            'tags'       => CollectionParser::toKeyPair(Tag::all(), 'tag_id', 'name'),
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize(Resource::POST_UPDATE);

        $data = $request->toArray();
        $data['url_hash'] = hash('md5', $request->input('url_path'));
        $data['updated_at'] = date('Y-m-d h:i:s');

        $post->update($data);

        $tags = $request->input('tags')
            ? Tag::whereIn('tag_id', $request->input('tags'))->get()
            : [];
        $post->tags()->sync($tags);

        return ['process' => 'success'];
    }
}
