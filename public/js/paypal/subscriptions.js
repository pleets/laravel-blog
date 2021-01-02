paypal.Buttons({
    createSubscription: function(data, actions) {
        return actions.subscription.create({
            'plan_id': 'P-2UF78835G6983425GLSM44MA'
        });
    },
    onApprove: function(data, actions) {
        alert('You have successfully created subscription ' + data.subscriptionID);
    }
}).render('#paypal-subscription-button');
