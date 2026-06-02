<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaystackSettings;

class PaymentController extends Controller
{
public function paysatckPage()
{
    // Ensure there is always a record
    $paystackdata = \App\Models\PaystackSettings::firstOrCreate([]);

    return view('admin.payment.paystack', compact('paystackdata'));
}

public function updatepaystack234(Request $request)
{
    $request->validate([
        'public_key'     => 'required|string',
        'secret_key'     => 'required|string',
        'merchant_email' => 'required|email',
        'status'         => 'nullable|boolean',
    ]);

    $settings = PaystackSettings::firstOrCreate([]);

    $data = $request->only('public_key', 'secret_key', 'merchant_email');
    $data['status'] = $request->has('status') ? 1 : 0;

    $settings->update($data);

    return redirect()->back()->with('success', 'Paystack settings updated successfully!');
}


public function updatepaystack(Request $request)
{
    $settings = PaystackSettings::firstOrCreate([]);

    $settings->update([
        'public_key'     => $request->input('public_key'),
        'secret_key'     => $request->input('secret_key'),
        'merchant_email' => $request->input('merchant_email'),
        'status'         => $request->has('status') ? 1 : 0,
    ]);

    return back()->with('success', 'Paystack settings updated successfully!');
}



}



