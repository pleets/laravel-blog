<!-- PayPay checkout sdk -->
@if(\Pleets\LaravelPayPal\Helpers\Environment::areSubscriptionsActivated())
    <script src="https://www.paypal.com/sdk/js?client-id={{ config('paypal.api.credentials.client_id') }}&vault=true"></script>
@endif
