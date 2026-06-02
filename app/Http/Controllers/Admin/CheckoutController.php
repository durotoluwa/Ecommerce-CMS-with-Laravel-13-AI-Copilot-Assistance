<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;   
use App\Models\ShippingAddress;
use App\Models\Transaction;
use Paystack;
use App\Models\ProductOrder;
use App\Models\Customer;
use App\Models\Coupon;
use App\Services\PaystackService;




class CheckoutController extends Controller
{

  protected $paystack;

    public function __construct(PaystackService $paystack)
    {
        $this->paystack = $paystack;
    }

    public function index()
    {
        $cart = session('cart', []);
        $total = session('cart_total', 0);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

      // Pass paystack service into the view
        return view('checkout.index', [
            'cart'     => $cart,
            'total'    => $total,
            'paystack' => $this->paystack,
        ]);
    }

public function process(Request $request)
    {
        $request->validate([
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        // Initialize transaction with Paystack
        $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))
            ->post('https://api.paystack.co/transaction/initialize', [
                'amount' => session('cart_total', 0) * 100, // amount in kobo
                'email' => $request->email,
                'callback_url' => route('checkout.callback'),
            ]);

        if ($response->successful()) {
            return redirect($response['data']['authorization_url']);
        }

        return back()->with('error', 'Payment initialization failed.');
    }

    public function callback(Request $request)
    {
        $reference = $request->query('reference');

        $verify = Http::withToken(env('PAYSTACK_SECRET_KEY'))
            ->get("https://api.paystack.co/transaction/verify/{$reference}");

        if ($verify->successful() && $verify['data']['status'] === 'success') {
            //  Save order with transaction reference
            // Example: Order::create([... 'reference' => $verify['data']['reference'] ]);
            session()->forget(['cart', 'cart_total']);

            return redirect()->route('shop.index')->with('success', 'Payment successful, order placed!');
        }

        return redirect()->route('checkout.index')->with('error', 'Payment verification failed.');
    }

public function storeOrder(Request $request)
{
    // Step 1: Get or create customer
    if (Auth::guard('customer')->check()) {
        $customerId = Auth::guard('customer')->id();
    } else {
        $customer = Customer::create([
            'username'   => $request->username,
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'password'   => bcrypt($request->password ?? Str::random(8)),
        ]);
        $customerId = $customer->id;
        Auth::guard('customer')->login($customer);
    }

    $orderNo = 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(6));

    // Step 2: Shipping address
    if (Auth::guard('customer')->check()) {
        $shippingAddressId = $request->shipping_address_id;
    } else {
        if ($request->has('differentaddress')) {
            $shippingAddressId = ShippingAddress::create([
                'customer_id' => $customerId,
                'fullname'    => $request->shippingfirstname . ' ' . $request->shippinglastname,
                'phone'       => $request->shippingphone,
                'address'     => $request->shippingaddress,
            ])->id;
        } else {
            $shippingAddressId = ShippingAddress::create([
                'customer_id' => $customerId,
                'fullname'    => $request->first_name . ' ' . $request->last_name,
                'phone'       => $request->phone,
                'address'     => $request->address,
            ])->id;
        }
    }

    // Step 3: Determine payment method and status
    $paymentMethod = $request->payment_method;
    $status = 'pending'; // default

    if ($paymentMethod === 'paystack') {
        // For Paystack, we set status to pending until payment is confirmed
        $status = 'pending';
    }

    //   Step 3b: Handle coupon discount
    $cartTotal = session('cart_total', 0);
    $finalTotal = $cartTotal;
    $discount = 0;
    $couponCode = session('coupon');

    if ($couponCode) {
        $coupon = Coupon::where('code', $couponCode)->first();
        if ($coupon && $coupon->isValid()) {
            $discount = $coupon->type === 'fixed'
                ? $coupon->value
                : ($coupon->value / 100) * $cartTotal;

            $finalTotal = max(0, $cartTotal - $discount);

            //   Increment usage count
            $coupon->incrementUsage();
        }
    }

    // Step 4: Create order
    $order = ProductOrder::create([
        'customer_id'         => $customerId,
        'shipping_address_id' => $shippingAddressId,
        'order_no'            => $orderNo,
        'total'               => $finalTotal,
        'status'              => $status,
        'payment_method'      => $paymentMethod,
        'coupon_code'         => $couponCode,
        'discount'            => $discount,
    ]);

    // Step 5: Save items
    foreach (session('cart', []) as $item) {
        $order->items()->create([
            'product_id' => $item['id'],
            'quantity'   => $item['quantity'],
            'price'      => $item['price'],
        ]);
    }

    session(['last_order_id' => $order->id]);
    session()->forget(['cart', 'cart_total', 'coupon', 'discount', 'final_total']);

    // Step 6: Handle payment flow
    if ($paymentMethod === 'bank_transfer') {
        return redirect()->route('order.details', $order->id)
                         ->with('info', 'Please transfer to Example Bank, Account: 1234567890');
    }

    if ($paymentMethod === 'pay_on_delivery') {
        return redirect()->route('order.details', $order->id)
                         ->with('info', 'You will pay on delivery.');
    }

    if ($paymentMethod === 'paystack') {
        return view('checkout.paystack', compact('order'));
    }

    

    return redirect()->route('myaccount')
                     ->with('success', 'Order placed successfully! Your order number is ' . $orderNo);
}



 public function paystackCallback(Request $request, $orderId)
{
    $reference = $request->query('reference');

    // Use secret key from config (DB or .env fallback)
   

    $response = Http::withToken($this->paystack->getSecretKey())

        ->withOptions(['verify' => false]) // temporary SSL fix
        ->get("https://api.paystack.co/transaction/verify/{$reference}");

    if ($response->successful()) {
        $data = $response->json('data');

        if ($data['status'] === 'success') {
            //   Payment successful
            $order = ProductOrder::findOrFail($orderId);
            $order->update([
                'status' => 'confirmed',
                'payment_reference' => $reference,
            ]);

            return redirect()->route('myaccount')
                             ->with('success', 'Payment successful! Your order has been confirmed.');
        } else {
            //   Payment failed
            $order = ProductOrder::findOrFail($orderId);
            $order->update([
                'status' => 'cancelled',
                'payment_reference' => $reference,
            ]);

            return redirect()->route('myaccount')
                             ->with('error', 'Payment failed. Your order has been cancelled.');
        }
    }

    return redirect()->route('myaccount')
                     ->with('error', 'Payment could not be verified. Please try again.');
}


 
 


public function confirmPaystackPayment(Request $request)
{
    $reference = $request->query('reference');
    $orderId   = session('last_order_id');

    // Verify payment with Paystack API
    $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))
        ->withOptions(['verify' => false]) // temporary SSL fix
        ->get("https://api.paystack.co/transaction/verify/{$reference}");

    if ($response->successful() && $response['data']['status'] === 'success') {
        $order = ProductOrder::findOrFail($orderId);

        // Update transaction
        $order->transaction()->where('reference', $reference)->update([
            'status' => 'paid',
        ]);

        // Update order
        $order->update(['status' => 'paid']);

        return redirect()->route('myaccount')
                         ->with('success', 'Payment successful! Your order number is ' . $order->order_no);
    }

    return redirect()->route('myaccount')
                     ->with('error', 'Payment verification failed. Please contact support.');
}


public function applyCoupon(Request $request)
{
    $request->validate([
        'coupon_code' => 'required|string'
    ]);

    $coupon = Coupon::where('code', $request->coupon_code)->first();

    if (!$coupon || !$coupon->isValid()) {
        return back()->with('error', 'Invalid or expired coupon.');
    }

    //  Calculate cart total directly from session
    $cartTotal = collect(session('cart', []))
        ->sum(fn($item) => $item['price'] * $item['quantity']);

    //  Calculate discount
    $discount = $coupon->type === 'fixed'
        ? $coupon->value
        : ($coupon->value / 100) * $cartTotal;

    $finalTotal = max(0, $cartTotal - $discount);

    //  Save coupon details in session
    session([
        'coupon'      => $coupon->code,
        'discount'    => $discount,
        'final_total' => $finalTotal,
        'cart_total'  => $cartTotal, // keep subtotal handy
    ]);

    return back()->with('success', 'Coupon applied successfully!');
}



public function removeCoupon()
{
    session()->forget(['coupon', 'discount', 'final_total']);
    return back()->with('info', 'Coupon removed successfully.');
}




}
