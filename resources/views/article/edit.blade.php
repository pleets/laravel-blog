@extends('layouts.blog-admin')

@section('content')

<div class="container">
    {{ Form::open([
            'id' => 'frm-article',
            'url' => 'article/save',
            'data-role' => 'ajax-request',
            'data-callback' => 'v = { success: function(response) { if (response.post_id !== undefined) window.location = response.redirect_to; } }'
        ])
    }}
        <div class="row">
            <div class="col-sm-9" style="border-right: dashed 1px #d6d6d6">
                {{ Form::hidden('post_id', $post->post_id) }}
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            {{ Form::label('title', 'Post title') }}
                            {{ Form::text('title', $post->title, [
                                'class' => 'form-control',
                                'placeholder' => 'post title',
                                ]) }}
                        </div>
                        <div class="form-group col-sm-6">
                            {{ Form::label('category', 'Category') }}
                            {{ Form::select('category', $categories, $post->category_id, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            {{ Form::label('content', 'Post content') }}
                            {{ Form::textarea('content', $post->content, ['class' => 'form-control']) }}
                        </div>
                    </div>
            </div>
            <div class="col-sm-3">
                <div class="form-row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('published_at', 'Published') }}
                        {{ Form::date('published_at', $post->published_at ?? date('Y-m-d'), [
                            'class' => 'form-control'
                            ]) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('url', 'Url') }}
                        {{ Form::text('url', $post->url_path, [
                            'class' => 'form-control',
                            'placeholder' => 'post title',
                            ]) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('description', 'description') }}
                        {{ Form::text('description', $post->description, [
                            'class' => 'form-control',
                            'placeholder' => 'post description',
                            ]) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('image', 'image') }}
                        {{ Form::text('image', $post->image, [
                            'class' => 'form-control',
                            'placeholder' => 'post image',
                            ]) }}
                    </div>
                </div>
            </div>
        </div>
        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
</div>
@endsection
