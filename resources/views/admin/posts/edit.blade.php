@extends('layouts.blog-admin')

@section('content')

    <div class="container">
        {{ Form::open([
                'id' => 'frm-article',
                'url' => route('admin.posts.store'),
                'data-role' => 'ajax-request',
                'data-callback' => 'v = { success: function(response) { if (response.post_id !== undefined) window.location = response.redirect_to; else { $("#post-content").html($("#content").val()); } } }'
            ])
        }}
        <div class="row">
            <div class="col-sm-9" style="border-right: dashed 1px #d6d6d6">
                {{ Form::hidden('post_id', $post->post_id) }}
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            {{ Form::label('title', __('posts.fields.title')) }}
                            {{ Form::text('title', $post->title, [
                                'class' => 'form-control',
                                'placeholder' => strtolower(__('posts.fields.title')),
                                ]) }}
                        </div>
                        <div class="form-group col-sm-6">
                            {{ Form::label('category', __('posts.fields.category')) }}
                            {{ Form::select('category', $categories, $post->category_id, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            {{ Form::label('tags', __('posts.fields.tags')) }}
                            {{ Form::select('tags[]', $tags, $post->tags->pluck('tag_id'), [
                                'class' => 'custom-select',
                                'multiple' => 'multiple',
                                'size' => 3
                                ]) }}
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            {{ Form::label('content', __('posts.fields.content')) }}
                            {{ Form::textarea('content', $post->content, ['class' => 'form-control']) }}
                        </div>
                    </div>
            </div>
            <div class="col-sm-3">
                <div class="form-row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('published_at', __('posts.fields.published_at')) }}
                        {{ Form::date('published_at', $post->published_at ?? date('Y-m-d'), [
                            'class' => 'form-control'
                            ]) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('url', __('posts.fields.url')) }}
                        {{ Form::text('url', $post->url_path, [
                            'class' => 'form-control',
                            ]) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('description', __('posts.fields.description')) }}
                        {{ Form::text('description', $post->description, [
                            'class' => 'form-control',
                            'placeholder' => strtolower(__('posts.fields.description')),
                            ]) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('image', __('posts.fields.image')) }}
                        {{ Form::text('image', $post->image, [
                            'class' => 'form-control',
                            ]) }}
                    </div>
                </div>
            </div>
        </div>
        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
        <div id="post-content" class="mt-5">{!! $post->content !!}</div>
    </div>
@endsection
