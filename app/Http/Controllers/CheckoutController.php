<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Exception\CardException;
use Alert;

class CheckoutController extends Controller
{
    public function checkout(Request $request, Product $product)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = Charge::create([
                'amount' => $product->price * 100,
                'currency' => 'usd',
                'description' => $product->name,
                'receipt_email' => auth()->user()->email,
                'source' => $request->stripeToken,
            ]);

            // Handle successful charge here
            Alert::success('Payment Successful', 'Thank you for your purchase!');
            return redirect('/home');
        } catch (CardException $e) {
            // Handle card errors
            Alert::error('Payment Failed', $e->getMessage());
            return back();
        }
    }
}
