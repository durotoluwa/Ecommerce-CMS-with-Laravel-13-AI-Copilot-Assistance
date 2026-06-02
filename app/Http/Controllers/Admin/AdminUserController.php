<?php

namespace App\Http\Controllers\Admin;

 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;  
use Illuminate\Support\Facades\Hash;





class AdminUserController extends Controller
{
  public function index()
{
    $userlist = User::all();
    $rolelist = Role::all();

    return view('admin.admin_user.index', compact('userlist', 'rolelist'));
}


public function updateadminUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'username'   => 'required|string|max:255|unique:users,username,' . $id,
            'email'      => 'required|email|max:255|unique:users,email,' . $id,
            'phone'      => 'required|string|max:20',
           'status' => 'required|boolean',
        ]);

        $user->update([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'username'   => $request->username,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'status'     => $request->status,
        ]);

        return redirect()->route('admin.users.index')
                         ->with('success', 'User updated successfully!');
    }


    public function storeAdminUser(Request $request)
    {
        $request->validate([
            'first_name'       => 'required|string|max:255',
            'last_name'        => 'required|string|max:255',
            'username'         => 'required|string|max:255|unique:users,username',
            'email'            => 'required|email|max:255|unique:users,email',
            'phone'            => 'required|string|max:20',
            'status'           => 'required|boolean',
            'password'         => 'required|string|min:8|confirmed',
        ]);

        // Create user
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'username'   => $request->username,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'status'     => $request->status,
            'password'   => Hash::make($request->password),
        ]);

        // Assign "admin" role using Spatie
        $user->assignRole('admin');

        return redirect()->route('admin.users.index')
                         ->with('success', 'Admin staff created successfully!');
    }

     public function adminchangePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.users.index')
                         ->with('success', 'Password updated successfully!');
    }

 public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')
                         ->with('success', 'User deleted successfully!');
    }


 public function updateProfile(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name'  => 'required|string|max:255',
        'username'   => 'required|string|max:255|unique:users,username,' . $id,
        'email'      => 'required|email|max:255|unique:users,email,' . $id,
        'phone'      => 'nullable|string|max:20',
        'image'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Handle image upload with DOCUMENT_ROOT
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $destination = $_SERVER['DOCUMENT_ROOT'] . '/user'; // points to /public/user
        $request->image->move($destination, $imageName);
        $user->image = $imageName;
    }

    // Update other fields
    $user->first_name = $request->first_name;
    $user->last_name  = $request->last_name;
    $user->username   = $request->username;
    $user->email      = $request->email;
    $user->phone      = $request->phone;
    $user->save();

    return redirect()->back()->with('success', 'Profile updated successfully!');
}


public function adminprofile(string $id)
    {
        $profileview = User::findOrFail($id);
        $user_roles  = Role::all();

        return view('admin.admin_user.myprofile', compact('profileview', 'user_roles'));
    }


}
