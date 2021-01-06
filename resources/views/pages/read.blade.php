@extends('layouts.blog')

@section('meta_title', $page->title)
@section('meta_description', $page->description)
@section('fb_image', !is_null($page->image) ? asset($page->image) : asset('img/laravel-icon.png'))

@section('content')

    <div class="container pt-3 bg-white">
        <div class="row">
            <div class="col-sm-12">
                <article>
                    <h1 style="font-family: 'Fjalla One', sans-serif;" class="pltsword">{{ $page->title }}</h1>
                    <br />
                    {!! $page->content !!}
                </article>
            </div>
        </div>
    </div>
@endsection
