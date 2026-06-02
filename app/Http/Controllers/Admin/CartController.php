<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{

public function addold($id, Request $request)
{
    $product = Product::findOrFail($id);

    $cart = session()->get('cart', []);

    // Read quantity from request, default to 1
    $requestedQty = max(1, (int) $request->input('quantity', 1));

    if (isset($cart[$id])) {
        $currentQty = $cart[$id]['quantity'];
        $newQty = $currentQty + $requestedQty;

        if ($newQty <= $product->stock_quantity) {
            $cart[$id]['quantity'] = $newQty;
        } else {
            return redirect()->back()->with('error', 'Not enough stock available.');
        }
    } else {
        if ($requestedQty <= $product->stock_quantity) {
            $cart[$id] = [
                'id'            => $product->id,
                'name'          => $product->name,
                'image'         => $product->featured_image,
                'price'         => $product->converted_regular_price,
                'quantity'      => $requestedQty,
                'stock_quantity'=> $product->stock_quantity,
                'color'          => $request->selected_color,
                'size'           => $request->selected_size,
            ];
        } else {
         if ($request->ajax()) {
    return response()->json([
        'success' => false,
        'message' => 'Not enough stock available.'
    ]);
}

return redirect()->back()->with('error', 'Not enough stock available.');
        }
    }

    session()->put('cart', $cart);

    $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
    session()->put('cart_total', $total);

    // If AJAX, return JSON instead of redirect
if ($request->ajax()) {
    return response()->json([
        'success'    => true,
        'cart_total' => $total,
        'cart_count' => collect($cart)->sum('quantity'),
        'items'      => array_values($cart), // send items back
    ]);
}


    return redirect()->back()->with('success', 'Product added to cart!');
}




public function add($id, Request $request)
{
    $product = Product::findOrFail($id);

    $cart = session()->get('cart', []);

    $requestedQty = max(1, (int) $request->input('quantity', 1));

    // Selected attributes
    $color = $request->selected_color;
    $size  = $request->selected_size;

    // Unique cart key
    $cartKey = $id . '_' . $color . '_' . $size;

    // Check stock
    if ($requestedQty > $product->stock_quantity) {

        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Not enough stock available.'
            ]);
        }

        return redirect()->back()
            ->with('error', 'Not enough stock available.');
    }

    // If exact same variation already exists
    if (isset($cart[$cartKey])) {

        $newQty = $cart[$cartKey]['quantity'] + $requestedQty;

        if ($newQty > $product->stock_quantity) {

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Not enough stock available.'
                ]);
            }

            return redirect()->back()
                ->with('error', 'Not enough stock available.');
        }

        $cart[$cartKey]['quantity'] = $newQty;

    } else {

        // Add as NEW cart item
        $cart[$cartKey] = [

            'cart_key'       => $cartKey,
            'id'             => $product->id,
            'name'           => $product->name,
            'image'          => $product->featured_image,
            'price'          => $product->converted_regular_price,
            'quantity'       => $requestedQty,
            'stock_quantity' => $product->stock_quantity,

            // attributes
            'color'          => $color,
            'size'           => $size,
        ];
    }

    session()->put('cart', $cart);

    $total = collect($cart)->sum(function ($item) {
        return $item['price'] * $item['quantity'];
    });

    session()->put('cart_total', $total);

    
    if ($request->ajax()) {
    return response()->json([
        'success'    => true,
        'cart_total' => $total,
        'cart_count' => collect($cart)->sum('quantity'),
        'items'      => collect($cart)->map(function($item, $key) {
            $item['cart_key'] = $key; // preserve session key
            return $item;
        })->values(),
    ]);
}


    return redirect()->back()
        ->with('success', 'Product added to cart!');
}


public function remove($cartKey)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$cartKey])) {
        unset($cart[$cartKey]);
    }

    session()->put('cart', $cart);

    $total = collect($cart)->sum(function ($item) {
        return $item['price'] * $item['quantity'];
    });

    session()->put('cart_total', $total);

    return response()->json([
        'success' => true,
        'cart_total' => $total,
        'cart_count' => collect($cart)->sum('quantity'),
    ]);


    
}


public function update(Request $request)
{
    $cart = session()->get('cart', []);

    foreach ($request->quantities as $id => $qty) {
        if (isset($cart[$id])) {
            $product = Product::find($id);

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


public function search(Request $request)
{
    $query = $request->get('q');

    $products = Product::where('name', 'like', "%{$query}%")
        ->limit(10)
        ->get(['id','name','featured_image','regular_price','sale_price']); 

    return response()->json($products);
}


}
 
