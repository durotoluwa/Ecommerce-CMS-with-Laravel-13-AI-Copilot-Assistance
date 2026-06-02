<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductOrder;
use App\Models\Product;
use App\Models\Customer;
use Carbon\Carbon;

class DashboardController extends Controller
{
    

public function adminDashboard(){
  $todayOrdersCount = ProductOrder::whereDate('created_at', today())->count();
     $totalCompletedOrders = ProductOrder::where('status', 'confirmed')->sum('total');
$totalsale = ProductOrder::sum('total');
$todaytotalsale = ProductOrder::whereDate('created_at', Carbon::today())
    ->sum('total');

    $totalPendingOrders   = ProductOrder::where('status', 'pending')->sum('total');
    $totalProducts        = Product::count();
    $totalCustomers       = Customer::count();
    $recentSales = ProductOrder::with(['items.product', 'customer'])
        ->latest()
        ->take(5) // show last 5 orders
        ->get();

    return view('admin.dashboard', compact(
        'totalCompletedOrders',
        'totalPendingOrders',
        'totalProducts',
        'totalCustomers',
        'todayOrdersCount',
        'recentSales',
        'totalsale',
        'todaytotalsale'
    ));
    
}


}
