<div class="mb-3">
    <div class="g-recaptcha"
         data-sitekey="{{ config('google.recaptcha.site_key') }}"
         data-theme="{{ config('google.recaptcha.checkbox.theme') }}"
         data-size="{{ config('google.recaptcha.checkbox.size') }}"></div>
    @error('recaptcha') <div class="text-danger">{{ __($message) }}</div> @enderror
</div>
