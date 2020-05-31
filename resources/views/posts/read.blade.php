@extends('layouts.blog')

@section('meta_title', $post->title)
@section('meta_description', $post->description)
@section('fb_image', !is_null($post->image) ? asset($post->image) : asset('img/laravel-icon.png'))

@section('content')
    @includeIf('posts.layout.' . config('posts.template'))
@endsection
