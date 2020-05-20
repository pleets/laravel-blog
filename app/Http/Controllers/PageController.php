<?php

namespace App\Http\Controllers;

use App\Page;

class PageController extends Controller
{
    public function read($title)
    {
        $title = hash('md5', $title);
        $page = Page::where('url_hash', $title)->firstOrFail();

        return view('pages.read', ['page' => $page]);
    }
}
