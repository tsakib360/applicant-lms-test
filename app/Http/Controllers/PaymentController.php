<?php

namespace App\Http\Controllers;
use App\Models\CartManagement;
use App\Models\Gateway;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentController extends Controller
{

    public function gateways(Request $request, $course_id)
    {
        $data['pageTitle'] = "Payment Methods";

        $data['cart'] = CartManagement::find(Auth::user()->id);
        if (!$data['cart']){
            $data['cart'] = new CartManagement();
        }

        $data['cart']->user_id = Auth::user()->id;
        $data['cart']->course_id = $course_id;
        $data['cart']->save();

        $data['gateways'] = Gateway::where('status', 1)->latest()->get();

        return view("student.gateway.gateways")->with($data);
    }

    public function paynow(Request $request)
    {
        $request->validate([
            'amount' => 'required|min:1',
            'gateway_id' => 'required|integer',
        ]);

        $gateway = Gateway::findOrFail($request->gateway_id);

        $trx = strtoupper(Str::random());

        $final_amount = ($request->amount * $gateway->rate) + $gateway->charge;

        Payment::create([
            'gateway_id' => $gateway->id,
            'user_id' => auth()->id(),
            'transaction_id' => $trx,
            'amount' => $request->amount,
            'rate' => $gateway->rate,
            'charge' => $gateway->charge,
            'final_amount' => $final_amount,
            'payment_status' => 0,
            'course_id' => $request->course_id,
        ]);


        session()->put('trx', $trx);


        return redirect()->route('gateway.details', $gateway->id);
    }

    public function gatewaysDetails($id)
    {
        $data['gateway'] = Gateway::findOrFail($id);

        $data['deposit'] = Payment::where('transaction_id', session('trx'))->firstOrFail();

        $data['pageTitle'] = $data['gateway']->gateway_name . ' Payment Details';



        return view("student.gateway.{$data['gateway']->gateway_name}")->with($data);
    }


    public function gatewayRedirect(Request $request, $id)
    {
        $gateway = Gateway::findOrFail($id);

        $deposit = Payment::where('transaction_id', session('trx'))->firstOrFail();

        $new = __NAMESPACE__ . '\\Gateway\\' . $gateway->gateway_name . '\ProcessController';

        $data = $new::process($request, $gateway, $deposit->final_amount, $deposit);

        if ($gateway->gateway_name == 'paypal') {

            $data = json_decode($data);

            return redirect()->to($data->links[1]->href);
        }


        return redirect()->route('home')->with('success', 'Your payment request has been taken.');
    }


    public static function updateUserData($deposit, $fee_amount, $transaction)
    {
        $deposit->payment_status = 1;
        $deposit->save();

        Transaction::create([
            'trx' => $deposit->transaction_id,
            'gateway_id' => $deposit->gateway_id,
            'amount' => $deposit->final_amount,
            'currency' => 'TK',
            'details' => 'Payment Successful for ',
            'charge' => $fee_amount,
            'type' => '-',
            'gateway_transaction' => $transaction,
            'user_id' => auth()->id(),
            'course_id' => $deposit->course_id,
            'payment_status' => 1
        ]);

    }
}
