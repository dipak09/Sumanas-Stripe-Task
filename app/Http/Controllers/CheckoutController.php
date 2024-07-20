<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Stripe\Exception\CardException;
use Alert;

class CheckoutController extends Controller
{
    public function checkout(Request $request, Product $product)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $user = auth()->user();
        $paymentAmount = $product->price * 100;

        // Create a new Stripe customer if not already created
        if (!$user->stripe_id) {
            $user->createAsStripeCustomer();
        }

        try {
            $paymentMethodId = $request->payment_method_id;
            $paymentMethod = PaymentMethod::retrieve($paymentMethodId);
            $paymentMethod->attach(['customer' => $user->stripe_id]);

            try {
                
                // Create and confirm a Payment Intent with a return URL (if needed)
                $paymentIntent = \Stripe\PaymentIntent::create([
                    'amount' => $paymentAmount,
                    'currency' => 'usd',
                    'payment_method' => $paymentMethodId,
                    'description' => $product->name,
                    'receipt_email' => $user->email,
                    'customer' => $user->stripe_id,
                    'confirmation_method' => 'automatic',
                    'confirm' => true,
                    'return_url' => route('home'), // Adjust this route to your needs
                ]);

                // Check the status of the PaymentIntent
                if ($paymentIntent->status != 'succeeded') {
                    Alert::error('Payment Failed', "Please try again");
                    return redirect('/home');
                }
            } catch (\Throwable $th) {
                \Log::error($th);
                Alert::error('Payment Failed', $th->getMessage());
                return redirect('/home');
            }
            Alert::success('Payment Successful', 'Thank you for your purchase!');
            return redirect('/home');
        } catch (CardException $e) {
            \Log::error($e);
            Alert::error('Payment Failed', $e->getMessage());
            return back();
        }
    }
}