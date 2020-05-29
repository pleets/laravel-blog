@extends('layouts.blog-admin')

@section('content')

    <div class="container">
        {{ Form::open([
                'id' => 'frm-page',
                'url' => 'admin/pages/save',
                'data-role' => 'ajax-request',
                'data-callback' => 'v = { success: function(response) { if (response.post_id !== undefined) window.location = response.redirect_to; else { $("#post-content").html($("#content").val()); } } }'
            ])
        }}
        <div class="row">
            <div class="col-sm-9" style="border-right: dashed 1px #d6d6d6">
                {{ Form::hidden('page_id', $page->page_id) }}
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        {{ Form::label('title', 'Page title') }}
                        {{ Form::text('title', $page->title, [
                            'class' => 'form-control',
                            'placeholder' => 'page title',
                            ]) }}
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('content', 'Page content') }}
                        {{ Form::textarea('content', $page->content, ['class' => 'form-control']) }}
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('url', 'Url') }}
                        {{ Form::text('url', $page->url_path, [
                            'class' => 'form-control',
                            'placeholder' => 'page title',
                            ]) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('description', 'description') }}
                        {{ Form::text('description', $page->description, [
                            'class' => 'form-control',
                            'placeholder' => 'page description',
                            ]) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('image', 'image') }}
                        {{ Form::text('image', $page->image, [
                            'class' => 'form-control',
                            'placeholder' => 'page image',
                            ]) }}
                    </div>
                </div>
            </div>
        </div>
        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
        <div id="post-content" class="mt-5">{!! $page->content !!}</div>
    </div>
@endsection
