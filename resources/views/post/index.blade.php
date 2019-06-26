@extends('layouts.blog')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-9">
            <a href="{{ url('/article/new') }}" class="btn btn-success">New</a><br /><br />
            @if ($posts->count())
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Pusblished</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->post_id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>
                                    <span class="badge badge-primary">{{ $post->category->name }}</span>
                                </td>
                                <td>{{ $post->published_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('post', ['title' => str_replace(' ', '-', $post->url_path)]) }}" target="_blank" class="btn btn-success btn-sm">Ver</a>
                                        <a href="{{ url('/article/edit') .'/'. $post->post_id }}" class="btn btn-primary btn-sm">Editar</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info">
                    There are no posts yet.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection('content')