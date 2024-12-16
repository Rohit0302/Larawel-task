<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class HomeController extends Controller
{
    public function home()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard')->with('info', 'You are already logged in.');
        }
        return view('home');
    }
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard')->with('info', 'You are already logged in.');
        }
        return view('login');
    }
    public function registration()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard')->with('info', 'You are already logged in.');
        }
        return view('registration');
    }
    public function registrationUser(Request $request)
    {
        // Validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|numeric|digits:10||unique:users,mobile|',
            'username' => 'required|string|unique:users,username|max:255',
            'password' => 'required|string|min:8|confirmed',
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
            'mobile.unique' => 'The mobile is already taken.',

            'username.required' => 'The username field is required.',
            'username.string' => 'The username must be a string.',
            'username.unique' => 'The username is already taken.',
            'username.max' => 'The username may not be greater than 255 characters.',

            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
        ];
        // Validate request data
        $validatedData = $request->validate($rules, $messages);
        $hashedPassword = Hash::make($request->input('password'));

        $UserAdd = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'username' => $request->input('username'),
            'password' => $hashedPassword,
            'created_at' => now(),
        ]);
        if ($UserAdd) {
            return redirect()->route('registration')->with('success', 'Congratulations! Your registration has been successfully completed.');
        } else {
            return redirect()->route('registration')->with('fail', 'There was an issue with your registration. Please try again.');
        }

    }
    public function loginData(Request $request)
    {
        // Validation rules
        $rules = [
            'username' => 'required|string',
            'password' => 'required|string',
        ];
        $messages = [
            'username.required' => 'The username field is required.',
            'username.string' => 'The username must be a string.',
            'password.required' => 'The username field is required.',
        ];

        // Validate the request
        $request->validate($rules, $messages);

        // Attempt to log in the user
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->route('dashboard')->with('success', 'User logged in successfully!');
        }

        // Authentication failed
        return redirect()->route('login')->with('fail', 'Username and password are not valid!');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('info', 'You have been logged out successfully.');
    }
}
