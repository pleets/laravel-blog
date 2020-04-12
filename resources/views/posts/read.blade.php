@extends('layouts.blog')

@section('meta_title', $post->title)
@section('meta_description', $post->description)
@section('fb_image', !is_null($post->image) ? asset($post->image) : asset('img/laravel-icon.png'))

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-9">
            <article>
                <h1 style="font-family: 'Fjalla One', sans-serif;" class="pltsword">{{ $post->title }}</h1>
                <div>
                    <span class="badge badge-success">{{ $post->published_at }}</span>
                    <span class="badge badge-primary">{{ $post->category->name }}</span>
                </div>
                @if ($post->tags->count())
                    <div>
                        Tags &nbsp;
                        @foreach ($post->tags as $tag)
                            <span class="badge badge-light">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                @endif
                <br />

                <!-- FB Social Plugin -->
                @if(config('facebook.posts.activated'))
                    <div class="fb-like"
                         data-href="{{ url()->current() }}"
                         data-width=""
                         data-layout="{{ config('facebook.posts.layout') }}"
                         data-action="{{ config('facebook.posts.action') }}"
                         data-size="{{ config('facebook.posts.size') }}"
                         data-share="{{ config('facebook.posts.share_button') }}"
                         style="float: left; margin-right: 10px;">
                    </div>
                @endif

                {!! $post->content !!}
                <footer class="pt-5">
                    <h4>Acerca de {{ $post->author->user->name }}</h4>
                    <div class="row">
                        <div class="col-sm-auto">
                            <img src="{{ asset('img/authors/fermius.jpg') }}" alt="Author" class="rounded-circle" width="70" class="d-flex">
                        </div>
                        <div class="col">
                            <p class="text-justify">
                                {!! $post->author->about !!}
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <blockquote class="custom" cite="{{ $post->author->user->name }}">
                                <p class="mb-0 text-justify" style="font-size: 15px">
                                    {!! $post->author->citation !!}
                                </p>
                            </blockquote>
                        </div>
                    </div>
                </footer>
            </article>
        </div>
        <div class="col-sm-3">
            <div class="widget">
                <h5>Categorías</h5>
                <ul style="list-style: none; padding: 0;">
                    @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('category', ['id' => $category->category_id]) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
