<!-- PayPay checkout sdk -->
@if(\Pleets\LaravelPayPal\Helpers\Environment::isCheckoutActivated())
    <script src="https://www.paypal.com/sdk/js?client-id={{ \Pleets\LaravelPayPal\Helpers\Environment::getClientId() }}"></script>
@endif
