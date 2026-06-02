<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserPermissionController extends Controller
{
public function index(Request $request)
{
    $user = Auth::user();

    // Only fetch users with the Admin role
    $users = User::role('Admin')->get();

    $permissions = Permission::all();
    $selectedUser = null;

    if ($request->has('user_id')) {
        $selectedUser = User::find($request->user_id);
    }

    return view('admin.user_permissions.index', compact('user','users', 'permissions', 'selectedUser'));
}



public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'permissions' => 'array'
    ]);

    $user = User::findOrFail($request->user_id);
    $user->syncPermissions($request->permissions ?? []);

    return redirect()->route('user_permissions.index', ['user_id' => $user->id])
                     ->with('success', 'User permissions updated successfully.');
}
}
