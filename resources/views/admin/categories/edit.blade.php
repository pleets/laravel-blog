@extends('layouts.blog-admin')

@section('content')
    <div class="container mt-3">
        <div class="card card-default">
            <div class="card-header d-flex justify-content-between">
                <h5>{{ __('categories.titles.edit') }}</h5>
                <div class="btn-toolbar" role="toolbar">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-primary">
                        {{ __('common.back') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.update', $category) }}" method="post" class="form">
                    @csrf
                    @method('PATCH')
                    @include('admin.categories.__form', $category)
                    <input type="submit" value="{{ __('common.save') }}" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
