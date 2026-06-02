<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
   public function index()
    {
        $wishlists = Wishlist::where('customer_id', Auth::guard('customer')->id())
                             ->with('product')
                             ->get();

        return view('wishlist.index', compact('wishlists'));
    }

    public function add($id)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('user.login')->with('error', 'You must be logged in to add to wishlist.');
        }

        $customerId = Auth::guard('customer')->id();

        // Prevent duplicates
        if (!Wishlist::where('customer_id', $customerId)->where('product_id', $id)->exists()) {
            Wishlist::create([
                'customer_id' => $customerId,
                'product_id'  => $id,
            ]);
        }

        return back()->with('success', 'Product added to wishlist!');
    }

    public function remove($id)
    {
        Wishlist::where('customer_id', Auth::guard('customer')->id())
                ->where('product_id', $id)
                ->delete();

        return back()->with('info', 'Product removed from wishlist.');
    }

   public function moveToCart($id)
{
    /*
    |--------------------------------------------------------------------------
    | FIND WISHLIST ITEM
    |--------------------------------------------------------------------------
    */

    $wishlist = Wishlist::where(
            'customer_id',
            Auth::guard('customer')->id()
        )
        ->where('product_id', $id)
        ->with('product')
        ->first();

    /*
    |--------------------------------------------------------------------------
    | ITEM NOT FOUND
    |--------------------------------------------------------------------------
    */

    if (!$wishlist) {

        return back()->with(
            'error',
            'Item not found in wishlist.'
        );
    }

    $product = $wishlist->product;

    /*
    |--------------------------------------------------------------------------
    | OUT OF STOCK
    |--------------------------------------------------------------------------
    */

    if (!$product || $product->stock_quantity <= 0) {

        return back()->with(
            'error',
            'This product is out of stock.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | USE SALE PRICE IF AVAILABLE
    |--------------------------------------------------------------------------
    */

    $price = $product->converted_sale_price
        ? $product->converted_sale_price
        : $product->converted_regular_price;

    /*
    |--------------------------------------------------------------------------
    | GET CART SESSION
    |--------------------------------------------------------------------------
    */

    $cart = session()->get('cart', []);

    /*
    |--------------------------------------------------------------------------
    | IF PRODUCT ALREADY EXISTS IN CART
    |--------------------------------------------------------------------------
    */

    if (isset($cart[$product->id])) {

        $newQty =
            $cart[$product->id]['quantity'] + 1;

        /*
        |----------------------------------------------------------------------
        | PREVENT STOCK OVERFLOW
        |----------------------------------------------------------------------
        */

        if ($newQty > $product->stock_quantity) {

            return back()->with(
                'error',
                'Maximum stock limit reached.'
            );
        }

        $cart[$product->id]['quantity'] = $newQty;

    } else {

        /*
        |----------------------------------------------------------------------
        | ADD NEW PRODUCT TO CART
        |----------------------------------------------------------------------
        */

        $cart[$product->id] = [

            'cart_key'       => $product->id,

            'id'             => $product->id,

            'name'           => $product->name,

            'image'          => $product->featured_image,

            'price'          => $price,

            'quantity'       => 1,

            'stock_quantity' => $product->stock_quantity
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | SAVE CART
    |--------------------------------------------------------------------------
    */

    session()->put('cart', $cart);

    /*
    |--------------------------------------------------------------------------
    | UPDATE CART TOTAL
    |--------------------------------------------------------------------------
    */

    $total = collect($cart)->sum(function ($item) {

        return $item['price'] * $item['quantity'];

    });

    session()->put('cart_total', $total);

    /*
    |--------------------------------------------------------------------------
    | REMOVE FROM WISHLIST
    |--------------------------------------------------------------------------
    */

    $wishlist->delete();

    /*
    |--------------------------------------------------------------------------
    | SUCCESS
    |--------------------------------------------------------------------------
    */

    return back()->with(
        'success',
        'Product moved to cart successfully!'
    );
}
}
