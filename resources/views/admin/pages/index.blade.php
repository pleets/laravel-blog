@extends('layouts.blog')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <a href="{{ url('/admin/pages/new') }}" class="btn btn-success">New</a><br /><br />

                @if ($pages->count())
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($pages as $page)
                            <tr>
                                <td>{{ $page->page_id }}</td>
                                <td>{{ $page->title }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('pages', ['title' => str_replace(' ', '-', $page->url_path)]) }}" target="_blank" class="btn btn-success btn-sm">Ver</a>
                                        <a href="{{ url('/admin/pages/edit') .'/'. $page->page_id }}" class="btn btn-primary btn-sm">Editar</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info">
                        There are no pages yet.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection('content')
