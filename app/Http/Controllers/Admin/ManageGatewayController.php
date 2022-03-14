<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gateway;
use Illuminate\Http\Request;

class ManageGatewayController extends Controller
{
    public function paypal()
    {
        $data['pageTitle'] = 'Paypal Payment';
        $data['navPaymentGatewayActiveCLass'] = 'hover show';
        $data['subNavPaypalActiveCLass'] = 'active';

        $data['gateway'] = Gateway::where('gateway_name', 'paypal')->first();

        return view('admin.gateway.paypal')->with($data);
    }

    public function paypalUpdate(Request $request)
    {
        $gateway = Gateway::where('gateway_name', 'paypal')->first();

        $request->validate([
            'gateway_currency' => 'required',
            'paypal_client_id' => 'required',
            'paypal_client_secret' => 'required',
            'status' => 'required',
            'mode' => 'required',
            'rate' => 'required'
        ]);

        $data = [
            'gateway_currency' => $request->gateway_currency,
            'paypal_client_id' => $request->paypal_client_id,
            'paypal_client_secret' => $request->paypal_client_secret,
            'mode' => $request->mode
        ];


        if ($gateway) {
            $gateway->update([
                'gateway_parameters' => $data,
                'gateway_type' => 1,
                'status' => $request->status,
                'rate' => $request->rate
            ]);

            return redirect()->back()->with('success', "Paypal Setting Updated Successfully");
        }

        Gateway::create([
            'gateway_name' => 'paypal',
            'gateway_parameters' => $data,
            'gateway_type' => 1,
            'status' => $request->status,
            'rate' => $request->rate,

        ]);

        return redirect()->back()->with('success', "Paypal Setting Updated Successfully");
    }

    public function stripe()
    {
        $data['pageTitle'] = 'Stripe Payment';
        $data['navPaymentGatewayActiveCLass'] = 'hover show';
        $data['subNavStripeActiveClass'] = 'active';

        $data['gateway'] = Gateway::where('gateway_name', 'stripe')->first();

        return view('admin.gateway.stripe')->with($data);
    }


    public function stripeUpdate(Request $request)
    {
        $gateway = Gateway::where('gateway_name', 'stripe')->first();

        $request->validate([
            'gateway_currency' => 'required',
            'stripe_client_id' => 'required',
            'stripe_client_secret' => 'required',
            'status' => 'required',
            'rate' => 'required',

        ]);

        $data = [
            'gateway_currency' => $request->gateway_currency,
            'stripe_client_id' => $request->stripe_client_id,
            'stripe_client_secret' => $request->stripe_client_secret,
        ];


        if ($gateway) {


            $gateway->update([
                'gateway_parameters' => $data,
                'gateway_type' => 1,
                'status' => $request->status,
                'rate' => $request->rate,
            ]);


            return redirect()->back()->with('success', "Stripe Setting Updated Successfully");
        }


        Gateway::create([
            'gateway_name' => 'stripe',
            'gateway_parameters' => $data,
            'gateway_type' => 1,
            'status' => $request->status,
            'rate' => $request->rate,

        ]);


        return redirect()->back()->with('success', "Stripe Setting Updated Successfully");
    }
}
