<?php

namespace App\Http\Controllers\UpdateProfile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UpdateProfileController extends Controller
{
    public function get_profile()
    {
        $user = auth()->user();
        return view('update.update-profile', compact('user'));
    }




    public function update_profile(Request $request)
    {
        $user = Auth::user(); // current logged in user

        if (!$user) {
            return redirect()->back()->with('error', 'User not logged in');
        }

        // Validation
        $request->validate([
            'full_name'   => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'mobile_no'   => 'required|digits:10',
            'email'       => 'required|email|unique:users,email,' . $user->id,
        ]);

        // Update user data
        $user->update([
            'full_name'    => $request->full_name,
            'company_name' => $request->company_name,
            'mobile_no'    => $request->mobile_no,
            'email'        => $request->email,
        ]);

        return redirect()->route('admin.index')->with('success', 'Profile updated successfully!');
    }
}
