<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;



class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }
    // Show the edit profile form
    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    // Handle profile update
    public function update(Request $request)
    {
        // Validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'mobile' => 'required|numeric|digits:10|unique:users,mobile,' . Auth::id(), // Correct validation rule for mobile
            'username' => 'required|string|unique:users,username,' . Auth::id() . '|max:255', // Added Auth::id() for unique username validation
        ];

        // Custom error messages
        $messages = [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',

            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email is already taken.',

            'mobile.required' => 'The mobile field is required.',
            'mobile.numeric' => 'The mobile number must be numeric.',
            'mobile.digits' => 'The mobile number must be exactly 10 digits.',
            'mobile.unique' => 'The mobile number is already taken.',

            'username.required' => 'The username field is required.',
            'username.string' => 'The username must be a string.',
            'username.unique' => 'The username is already taken.',
            'username.max' => 'The username may not be greater than 255 characters.',
        ];

        // Validate request data
        $validatedData = $request->validate($rules, $messages);

        // Get the authenticated user
        $user = Auth::user();

        // Update user details
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->mobile = $request->input('mobile'); // Correct field assignment
        $user->username = $request->input('username'); // Correct field assignment

        // Save the updated user information
        $res = $user->save();

        // Return the appropriate response
        if ($res) {
            return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
        }

        return redirect()->route('profile.edit')->with('fail', 'There was an issue updating your profile. Please try again.');
    }

    public function showChangePasswordForm()
    {
        return view('change-password');
    }
    public function changePassword(Request $request)
    {
        // Validate the new password and old password
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed', // Ensure new password is confirmed
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Check if the old password matches the current password
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return back()->withErrors(['old_password' => 'The old password is incorrect.']);
        }

        // Update the password
        $user = Auth::user();
        $user->password = Hash::make($request->password); // Hash the new password

        // Save the new password
        $res = $user->save();

        // Check if password was updated successfully
        if ($res) {
            return redirect()->route('password.change')->with('success', 'Password updated successfully.');
        } else {
            return redirect()->route('password.change')->with('error', 'Password update failed. Please try again.');
        }

    }
}
