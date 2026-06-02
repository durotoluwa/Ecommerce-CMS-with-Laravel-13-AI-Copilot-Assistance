<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductOrder;

class AdminOrderController extends Controller
{
  public function index()
{
    $orders = ProductOrder::with(['customer', 'items.product'])
        ->latest()
        ->paginate(100);

    return view('admin.product_orders.index', compact('orders'));
}

public function show($id)
{
    $order = ProductOrder::with(['customer', 'items.product', 'shippingAddress'])
        ->findOrFail($id);

    return view('admin.product_orders.show', compact('order'));
}






}
