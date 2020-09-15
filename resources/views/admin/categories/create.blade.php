@extends('layouts.blog-admin')

@section('content')
    <div class="container mt-3">
        <div class="card card-default">
            <div class="card-header d-flex justify-content-between">
                <h5>{{ __('categories.titles.create') }}</h5>
                <div class="btn-toolbar" role="toolbar">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-primary">
                        {{ __('common.back') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.store') }}" method="post" class="form">
                    @csrf
                    @include('admin.categories.__form')
                    <input type="submit" value="{{ __('common.save') }}" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
