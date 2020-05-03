@extends('layouts.blog')

@section('meta_title', 'Thank you for submitting your information')

@section('content')
    <div class="container" style="max-width: 550px;">
        <div class="container">
            <h3>{{ __('contact.title') }}</h3>
            <p class="text-justify">
                {{ __('contact.requested') }}
            </p>

            <a class="btn btn-primary" href="{{ route('home') }}">{{ __('contact.back') }}</a>
        </div>
    </div>
@endsection
