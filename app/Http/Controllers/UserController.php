<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use App\Models\ProductOrder;
use App\Models\Product;
use App\Models\Page;
use App\Models\BlogPost;


class UserController extends Controller
{
    public function homePage(){
    return view('welcome');     
}

  

public function userDashboard()
{
    $user = Auth::guard('customer')->user();

    // Get all orders for this customer
    $orders = ProductOrder::where('customer_id', $user->id)
                ->with('items.product') // eager load items + products
                ->orderBy('created_at', 'desc')
                ->get();

    return view('myaccount.index', compact('user', 'orders'));
}



    // Save billing details
    public function update(Request $request)
    {
        $request->validate([
            'country'          => 'required|string|max:255',
            'billing_address'  => 'required|string|max:255',
            'billing_address2' => 'nullable|string|max:255',
            'city'             => 'required|string|max:255',
            'state'            => 'required|string|max:255',
            'zipcode'          => 'required|string|max:20',
        ]);

        $user = Auth::user();
        $user->update([
            'country'          => $request->country,
            'billing_address'  => $request->billing_address,
            'billing_address2' => $request->billing_address2,
            'city'             => $request->city,
            'state'            => $request->state,
            'zipcode'          => $request->zipcode,
        ]);

return back()->with('success', 'Billing address updated successfully!');
    }



    public function updateProfile(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name'  => 'required|string|max:255',
        'email'      => 'required|email|max:255',
        'phone'      => 'required|string|max:20',
      
    ]);

    $user = Auth::guard('customer')->user();

    $user->first_name = $request->first_name;
    $user->last_name  = $request->last_name;
    $user->email      = $request->email;
    $user->phone      = $request->phone;
   
    $user->save();

    return back()->with('success', 'Profile updated successfully!');
}


public function changePassword(Request $request)
{
    $request->validate([
        'password'   => 'required|string|min:6',   // current password
        'npassword'  => 'required|string|min:6',   // new password
        'cpassword'  => 'required|string|same:npassword', // confirm new password
    ]);

    $user = Auth::guard('customer')->user();

    // Check current password
    if (!Hash::check($request->password, $user->password)) {
        return back()->withErrors(['password' => 'Current password is incorrect']);
    }

    // Update to new password
    $user->password = Hash::make($request->npassword);
    $user->save();

    // Logout user after password change
    Auth::guard('customer')->logout();

    // Redirect to login page
    return redirect()->route('user.login')->with('success', 'Password changed successfully. Please log in again.');
}


public function quickView($id)
{
    $product = Product::with('categories')->findOrFail($id);

    // Return a Blade partial that contains the quick view markup
    return view('partials.quickview', compact('product'));
}



    public function showPage($slug)
    {
        $page = Page::where('slug', $slug)
            ->where('status', 'active') // only show active pages
            ->firstOrFail();

        return view('page.show', compact('page'));
    }

      public function showBlog($slug)
    {
        $blog = BlogPost::where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        return view('blog.show', compact('blog'));
    }


}
