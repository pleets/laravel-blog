@component('mail::message')
{{ __('contact.mail.hello') }},

{{ __('contact.mail.message') }}

@component('mail::panel')
    <strong>{{ __('contact.form.fields.first_name') }}:</strong> {{ $first_name }}<br>
    <strong>{{ __('contact.form.fields.last_name') }}:</strong> {{ $last_name }}<br>
    <strong>{{ __('contact.form.fields.email') }}:</strong> {{ $email }}<br>
    <strong>{{ __('contact.form.fields.phone') }}:</strong> {{ $phone }}<br>
    <strong>{{ __('contact.form.fields.message') }}:</strong> {{ $message }}<br>
@endcomponent

{{ __('contact.mail.footer') }},<br>
{{ config('app.name') }}
@endcomponent
