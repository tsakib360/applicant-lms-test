<?php

namespace App\Http\Controllers\Gateway\stripe;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PaymentController;
use Stripe;

class ProcessController extends Controller
{
    public static function process($request,$stripe , $payingAmount, $deposit)
    {
        Stripe\Stripe::setApiKey($stripe->gateway_parameters->stripe_client_secret);

        $payment = Stripe\Charge::create([
            "amount" => $payingAmount * 100,
            "currency" => $stripe->gateway_parameters->gateway_currency,
            "source" => $request->stripeToken,
            "description" => "Payment For Booking {$deposit->transaction_id}"
        ]);

        $responseData = $payment->jsonSerialize();

        $transaction = $responseData['id'];

        $bal = \Stripe\BalanceTransaction::retrieve($responseData['balance_transaction']);

        $balJson = $bal->jsonSerialize();

        $fee_amount = number_format(($balJson['fee'] / 100), 4) /  $stripe->rate;

        if ($payment->status == 'succeeded') {

            PaymentController::updateUserData($deposit, $fee_amount, $transaction);

            return redirect()->route('profile')->with('success', 'Payment Successfully Done');
        }

        return redirect()->route('profile')->with('error', 'Something Goes Wrong');
    }
}
