<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;


class CouponController extends Controller
{
      public function index()
    {
        $coupons = Coupon::orderBy('created_at', 'desc')->get();
        return view('admin.coupons.index', compact('coupons'));
    }

    // Show create form
    public function create()
    {
        return view('admin.coupons.create');
    }

    // Store new coupon
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupon,code',
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric|min:0',
            'expiry_date' => 'nullable|date',
            'usage_limit' => 'nullable|integer|min:1',
        ]);

        Coupon::create($request->all());

        return redirect()->route('coupons.index')->with('success', 'Coupon created successfully.');
    }

    // Show single coupon
    public function show(Coupon $coupon)
    {
        return view('admin.coupons.show', compact('coupon'));
    }

    // Show edit form
    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    // Update coupon
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'code' => 'required|unique:coupon,code,' . $coupon->id,
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric|min:0',
            'expiry_date' => 'nullable|date',
            'usage_limit' => 'nullable|integer|min:1',
        ]);

        $coupon->update($request->all());

        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully.');
    }

    // Delete coupon
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully.');
    }
}
