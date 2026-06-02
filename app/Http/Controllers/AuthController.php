<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer; // swapped from User to Customer

class AuthController extends Controller
{
    public function showUserLogin()
    {
        return view('user.login'); // points to resources/views/user/login.blade.php
    }

    // Handle login submission
public function handleUserLogin(Request $request)
{
    $credentials = $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

if (Auth::guard('customer')->attempt($credentials, $request->filled('remember'))) {
    $request->session()->regenerate();
    return redirect()->route('myaccount.index');
}


    return back()->withErrors(['username' => 'Invalid credentials.']);
}

public function userLogin(Request $request)
{
    $credentials = $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

if (Auth::guard('customer')->attempt($credentials, $request->filled('remember'))) {
    $request->session()->regenerate();
    return redirect()->route('myaccount.index');
}


    return back()->withErrors(['username' => 'Invalid credentials.']);
}



    // Logout
    public function userLogout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome')->with('success', 'Logged out successfully!');
    }

 

    // USER REGISTER
    public function userRegister(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'username'   => 'required|string|max:255|unique:customer,username',
            'email'      => 'required|email|unique:customer,email',
            'phone'      => 'required|string|max:20',
            'password'   => 'required|string|min:6|confirmed',
        ]);

        $customer = Customer::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'username'   => $request->username,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'password'   => Hash::make($request->password),
        ]);

        Auth::guard('customer')->login($customer);

        return redirect()->route('user.login')->with('success', 'Account created successfully!');
    }

  
}
