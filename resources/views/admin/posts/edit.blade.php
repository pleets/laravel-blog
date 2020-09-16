@extends('layouts.blog-admin')

@section('content')

    <div class="container">
        {{ Form::open([
                'id' => 'frm-article',
                'url' => route('admin.posts.update', $post),
                'data-role' => 'ajax-request',
                //'data-method' => 'PATCH',
                'data-callback' => 'v = { success: function(response) { if (response.post_id !== undefined) window.location = response.redirect_to; else { $("#post-content").html($("#content").val()); } } }'
            ])
        }}
        @method('PATCH')
        @include('admin.posts.__form')
        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
        <div id="post-content" class="mt-5">{!! $post->content !!}</div>
    </div>
@endsection
