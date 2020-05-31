@if(request()->routeIs('posts'))
<!-- PayPay checkout sdk -->
<script src="https://www.paypal.com/sdk/js?client-id={{ config('paypal.client_id') }}"></script>
@endif
