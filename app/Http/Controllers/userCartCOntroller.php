<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class userCartCOntroller extends Controller
{
    public function add($id, Request $request)
{
    $product = Product::findOrFail($id);

    // Get current cart from session
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        // Increment quantity if product already exists
        $currentQty = $cart[$id]['quantity'];
        $newQty = $currentQty + 1;

        if ($newQty <= $product->stock_quantity) {
            $cart[$id]['quantity'] = $newQty;
        } else {
            return redirect()->back()->with('error', 'Not enough stock available.');
        }
    } else {
        // Add new product
        $cart[$id] = [
            'id'       => $product->id,
            'name'     => $product->name,
            'image'    => $product->featured_image,
            'price'    => $product->converted_regular_price,
            'quantity' => 1,
            'stock_quantity'=> $product->stock_quantity,
        ];
    }

    // Save back to session
    session()->put('cart', $cart);

    // Recalculate total
    $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
    session()->put('cart_total', $total);

    return redirect()->back()->with('success', 'Product added to cart!');
}



public function updatecart(Request $request)
{
    $cart = session()->get('cart', []);

    /*
    |--------------------------------------------------------------------------
    | EMPTY CART CHECK
    |--------------------------------------------------------------------------
    */

    if (empty($cart)) {

        return redirect()
            ->back()
            ->with('error', 'Cart is empty.');

    }

    /*
    |--------------------------------------------------------------------------
    | QUANTITY CHECK
    |--------------------------------------------------------------------------
    */

    if (!$request->has('quantities') || empty($request->quantities)) {

        return redirect()
            ->back()
            ->with('error', 'No cart items to update.');

    }

    foreach ($request->quantities as $id => $qty) {

        if (isset($cart[$id])) {

            $product = Product::find($id);

            if (!$product) {
                continue;
            }

            // enforce stock limit
            $qty = min($qty, $product->stock_quantity);

            $cart[$id]['quantity'] = $qty;
        }
    }

    // save back to session
    session()->put('cart', $cart);

    // recalc total
    $total = collect($cart)->sum(
        fn($item) => $item['price'] * $item['quantity']
    );

    session()->put('cart_total', $total);

    return redirect()
        ->route('cart.index')
        ->with('success', 'Cart updated successfully!');
}



    public function removecart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            session()->put('cart_total', collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']));
        }
        return redirect()->back()->with('success', 'Product removed from cart!');
    }

    public function index()
    {
        $cart = session('cart', []);
        $total = session('cart_total', 0);
        return view('cart.index', compact('cart', 'total'));
    }

public function updatecartold(Request $request)
{
    $cart = session()->get('cart', []);

    foreach ($request->quantities as $id => $qty) {
        if (isset($cart[$id])) {
           $product = Product::find($cart[$id]['id']);

            // enforce stock limit
            $qty = min($qty, $product->stock_quantity);

            $cart[$id]['quantity'] = $qty;
        }
    }

    // save back to session
    session()->put('cart', $cart);

    // recalc total
    $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
    session()->put('cart_total', $total);

    return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
}
}
