<?php

namespace App\Http\Controllers\Gateway\paypal;

use App\Http\Controllers\Controller;
use App\Models\Gateway;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;
use PayPal\Rest\ApiContext;

class ProcessController extends Controller
{
    public function process($request, $paypal, $totalAmount, $deposit)
    {
        $apiContext = new ApiContext(
            new OAuthTokenCredential(

                $paypal->gateway_parameters->paypal_client_id,
                $paypal->gateway_parameters->paypal_client_secret,

            )
        );

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        // Set redirect URLs
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('home'))
            ->setCancelUrl(route('home'));


        // Set payment amount
        $amount = new Amount();
        $amount->setCurrency($paypal->gateway_parameters->gateway_currency)
            ->setTotal($totalAmount);

        // Set transaction object
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setDescription("Transaction Number {$deposit->transaction_id}");

        // Create the full payment object
        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));


        // Create payment with valid API context
        try {
            $payment->create($apiContext);

            // Get PayPal redirect URL and redirect the customer
            $approvalUrl = $payment->getApprovalLink();

            // Redirect the customer to $approvalUrl
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        } catch (\Exception $ex) {
            die($ex);
        }

        return $payment;

    }
}
