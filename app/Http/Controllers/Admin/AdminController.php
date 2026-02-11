<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\ComplexType;

class AdminController extends Controller
{
  public function create()
  {
    $roles = Role::orderBy('name')->get();
    return view('admin.create', compact('roles'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'full_name' => 'required|string|max:255',
      'company_name' => 'nullable|string|max:255',
      'mobile_no' => 'required|string|max:15',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|string|min:8',
      'status' => 'required|in:active,inactive',
      'role' => 'required|exists:roles,name',
      'permissions' => 'required|array', // Permissions JSON
    ]);

    $validated['password'] = Hash::make($validated['password']);

    $role = Role::where('name', $validated['role'])->first();
    $validated['role'] = $role->id;

    $user = User::create($validated);

    // Store permissions
    UserPermission::create([
      'user_id' => $user->id,
      'permissions' => $request->permissions,
    ]);

    return redirect()->route('admin.index')->with('success', 'User created successfully with permissions!');
  }


  public function index()
  {
    $users = User::all();
    return view('admin.index', compact('users'));
  }

  public function edit($id)
  {
    $user = User::findOrFail($id);
    $roles = Role::orderBy('name')->get();
    $userPermission = UserPermission::where('user_id', $id)->first();
    $permissions = $userPermission ? $userPermission->permissions : [];
    return view('admin.edit', compact('user', 'roles', 'permissions'));
  }

  public function update(Request $request, $id)
  {
    $validated = $request->validate([
      'full_name' => 'required|string|max:255',
      'company_name' => 'nullable|string|max:255',
      'mobile_no' => 'required|string|max:15',
      'email' => 'required|email|unique:users,email,' . $id,
      'password' => 'nullable|string|min:8',
      'status' => 'required|in:active,inactive',
      'role' => 'required|exists:roles,name',
      'permissions' => 'required|array',
    ]);

    if (!empty($validated['password'])) {
      $validated['password'] = Hash::make($validated['password']);
    } else {
      unset($validated['password']);
    }

    $role = Role::where('name', $validated['role'])->first();
    $validated['role'] = $role->id;

    $user = User::findOrFail($id);
    $user->update($validated);

    // Update permissions
    UserPermission::updateOrCreate(
      ['user_id' => $user->id],
      ['permissions' => $request->permissions]
    );

    return redirect()->route('admin.index')->with('success', 'User updated successfully!');
  }

  public function destroy($id)
  {
    $user = User::findOrFail($id);

    // Delete associated permissions
    UserPermission::where('user_id', $id)->delete();
    $user->delete();

    return redirect()->route('admin.index')->with('success', 'User deleted successfully!');
  }
}
