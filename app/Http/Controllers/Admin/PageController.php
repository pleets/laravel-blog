<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();

        return view('admin.pages.index', ['pages' => $pages]);
    }

    public function new()
    {
        $page = new Page();

        return view('admin.pages.edit', [
            'page' => $page,
        ]);
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);

        return view('admin.pages.edit', [
            'page' => $page,
        ]);
    }

    public function save(Request $request)
    {
        if (is_null($request->input('page_id'))) {
            $page = new Page();
        } else {
            $page = Page::findOrFail($request->input('page_id'));
        }

        $page->title        = $request->input('title');
        $page->content      = $request->input('content');
        $page->description  = $request->input('description');
        $page->image        = $request->input('image');
        $page->url_path     = $request->input('url');
        $page->url_hash     = hash('md5', $request->input('url'));
        $page->updated_at   = date('Y-m-d h:i:s');
        $page->save();

        if (is_null($request->input('page_id'))) {
            $page->save();

            return [
                'process'     => 'success',
                'page_id'     => $page->page_id,
                'redirect_to' => route('pages.edit', $page->page_id),
            ];
        } else {
            return ['process' => 'success'];
        }
    }
}
