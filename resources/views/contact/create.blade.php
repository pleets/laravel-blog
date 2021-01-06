@extends('layouts.blog')

@section('meta_title', 'Contact Us')

@section('content')
    <div class="container pt-3 bg-white" style="max-width: 550px;">
        <div class="container">
            <h3>{{ __('contact.title') }}</h3>
            <p class="text-justify">
                {{ __('contact.description') }}
            </p>
            <form action="{{ route('contact.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="first_name">{{ __('contact.form.fields.first_name') }} <span class="text-danger">*</span></label>
                    <input type="text"
                           required="required"
                           maxlength="50"
                           minlength="2"
                           id="first_name"
                           name="first_name"
                           value="{{ old('first_name') }}"
                           class="form-control @error('first_name') is-invalid @enderror">
                    @error('first_name') <div class="text-danger">{{ __($message) }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="last_name">{{ __('contact.form.fields.last_name') }} <span class="text-danger">*</span></label>
                    <input type="text"
                           required="required"
                           maxlength="50"
                           minlength="2"
                           id="last_name"
                           name="last_name"
                           value="{{ old('last_name') }}"
                           class="form-control @error('last_name') is-invalid @enderror">
                    @error('last_name') <div class="text-danger">{{ __($message) }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="email">{{ __('contact.form.fields.email') }} <span class="text-danger">*</span></label>
                    <input type="email"
                           required="required"
                           minlength="2"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           class="form-control @error('email') is-invalid @enderror">
                    @error('email') <div class="text-danger">{{ __($message) }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="phone">{{ __('contact.form.fields.phone') }}</label>
                    <input type="text"
                           minlength="6"
                           maxlength="10"
                           id="phone"
                           name="phone"
                           value="{{ old('phone') }}"
                           class="form-control @error('phone') is-invalid @enderror">
                    @error('phone') <div class="text-danger">{{ __($message) }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="message">{{ __('contact.form.fields.message') }} <span class="text-danger">*</span></label>
                    <textarea rows="3"
                              required="required"
                              maxlength="350"
                              minlength="10"
                              id="message"
                              name="message"
                              class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                    @error('message') <div class="text-danger">{{ __($message) }}</div> @enderror
                </div>
                @php $recaptcha = config('google.recaptcha.activated'); @endphp
                @includeWhen($recaptcha, 'layouts.forms.recaptcha')
                <button type="submit" class="btn btn-primary">{{ __('contact.form.fields.submit') }}</button>
            </form>
        </div>
    </div>
@endsection
