<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ShippingAddress;

class ShippingAddressController extends Controller
{
    
public function store(Request $request)
{
    $request->validate([
        'fullname' => 'required|string|max:255',
        'phone'    => 'required|string|max:20',
        'address'  => 'required|string|max:500',
    ]);

    $user = Auth::guard('customer')->user();

    ShippingAddress::create([
        'customer_id' => $user->id,
        'fullname'    => $request->fullname,
        'phone'       => $request->phone,
        'address'     => $request->address,
    ]);

    return back()->with('success', 'Shipping address added successfully!');
}


public function update(Request $request, $id)
{
    $request->validate([
        'fullname' => 'required|string|max:255',
        'phone'    => 'required|string|max:20',
        'address'  => 'required|string|max:500',
    ]);

    $address = Auth::guard('customer')->user()->shippingAddresses()->findOrFail($id);
    $address->update($request->only('fullname', 'phone', 'address'));

    return back()->with('success', 'Shipping address updated successfully!');
}

public function destroy($id)
{
    $address = Auth::guard('customer')->user()->shippingAddresses()->findOrFail($id);
    $address->delete();

    return back()->with('success', 'Shipping address deleted successfully!');
}


public function choose($id)
{
    $address = Auth::guard('customer')->user()->shippingAddresses()->findOrFail($id);

    session(['checkout_address' => $address->id]);

    return redirect()->route('checkout.index')->with('success', 'Shipping address selected!');
}

}
