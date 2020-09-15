@extends('layouts.blog')

@section('content')
    <div class="container mt-3">
        @php
            use Illuminate\Support\Facades\Session;
            $errorBag = Session::get('errors');
            $message = Session::get('success');
        @endphp
        @if (isset($message))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif
        @if (isset($errorBag))
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errorBag->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card card-default">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title mb-0">{{ __('categories.titles.index') }}</h5>
                <div class="btn-toolbar" role="toolbar">
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-primary">
                        {{ __('common.create') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ __('categories.fields.name') }}</th>
                            <th>{{ __('categories.fields.slug') }}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary">
                                            {{ __('common.edit') }}
                                        </a>
                                        <a class="btn btn-danger" href="{{ route('admin.categories.destroy', $category) }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('delete-form-{{ $category->category_id }}').submit();">
                                            {{ __('common.delete') }}
                                        </a>
                                    </div>
                                    <form id="delete-form-{{ $category->category_id }}" action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">{{ __('categories.messages.empty') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection
