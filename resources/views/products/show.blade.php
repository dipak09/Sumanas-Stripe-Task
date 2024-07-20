@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->description }}</p>
                    <p class="card-text">${{ $product->price }}</p>
                    
                    <form action="{{ route('checkout', $product->id) }}" method="POST" id="payment-form">
                        @csrf
                        <div class="form-group">
                            <label for="card-element">Credit or debit card</label>
                            <div id="card-element" style="margin:10px 0px 10px 0px;border: 2px dashed;padding: 12px;">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>
                            <div id="card-errors" role="alert"></div>
                        </div>
                        <button id="btnSubmit" class="btn btn-primary">Submit Payment</button>
                        <a id="btnBack" class="btn btn-secondary" href="{{ url('/home') }}">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('{{ env('STRIPE_KEY') }}');
    var elements = stripe.elements();
    
    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };
    
    var card = elements.create('card', {style: style});
    card.mount('#card-element');
    
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
    
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        
        stripe.createPaymentMethod({
            type: 'card',
            card: card,
            billing_details: {
                name: '{{ auth()->user()->name }}',
                email: '{{ auth()->user()->email }}'
            },
        }).then(function(result) {
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                stripePaymentMethodHandler(result.paymentMethod.id);
            }
        });
    });
    
    function stripePaymentMethodHandler(paymentMethodId) {
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'payment_method_id');
        hiddenInput.setAttribute('value', paymentMethodId);
        form.appendChild(hiddenInput);
        
        var btnSubmitEleman = document.getElementById('btnSubmit');
        btnSubmitEleman.setAttribute("disabled", true);
        setTimeout(function () { btnSubmitEleman.setAttribute("disabled", false); }, 5000);

        form.submit();

    }
    </script>
@endsection
