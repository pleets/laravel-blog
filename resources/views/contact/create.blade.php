@extends('layouts.blog')

@section('meta_title', 'Contact Us')

@section('content')
    <div class="container" style="max-width: 550px;">
        <div class="container">
            <h3>{{ __('contact.title') }}</h3>
            <p class="text-justify">
                {{ __('contact.description') }}
            </p>
            <form action="">
                <div class="form-group">
                    <label for="firstName">{{ __('contact.form.fields.firstName') }}</label>
                    <input type="text" class="form-control" id="firstName" name="firstname" placeholder="">
                </div>
                <div class="form-group">
                    <label for="lastName">{{ __('contact.form.fields.lastName') }}</label>
                    <input type="text" class="form-control" id="lastName" name="lastname" placeholder="">
                </div>
                <div class="form-group">
                    <label for="email">{{ __('contact.form.fields.email') }}</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="">
                </div>
                <div class="form-group">
                    <label for="phone">{{ __('contact.form.fields.phone') }}</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="">
                </div>
                <div class="form-group">
                    <label for="message">{{ __('contact.form.fields.message') }}</label>
                    <textarea rows="3" class="form-control" id="message" name="phone"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">{{ __('contact.form.fields.submit') }}</button>
            </form>
        </div>
    </div>
@endsection
