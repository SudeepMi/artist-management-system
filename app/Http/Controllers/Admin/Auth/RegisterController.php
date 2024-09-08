<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'password' => 'required|min:8',
            'phone' => 'required',
            'dob' => 'required|date',
            'gender' => 'required|in:m,f,0',
            'address' => 'required',
        ], [
            'email.required' => 'The email address field is mandatory.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'first_name.required' => 'The full name field is mandatory.',
            'first_name.min' => 'The full name must be at least 3 characters long.',
            'last_name.required' => 'The full name field is mandatory.',
            'last_name.min' => 'The full name must be at least 3 characters long.',
            'password.required' => 'The password field is mandatory.',
            'password.min' => 'The password must be at least 8 characters long.',
            'phone.required' => 'The phone number field is mandatory.',
            'dob.required' => 'The date of birth field is mandatory.',
            'dob.date' => 'The date of birth must be a valid date.',
            'gender.required' => 'The gender field is mandatory.',
            'gender.in' => 'Invalid gender selection.',
            'address.required' => 'The address field is mandatory.',
        ]);

        // Hash the password
        $hashedPassword = Hash::make($request->password);

        // Use raw SQL to insert the user data
        DB::insert('INSERT INTO users (first_name, last_name, email, password, phone, dob, role, gender, address) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $request->first_name,
            $request->last_name,
            $request->email,
            $hashedPassword,
            $request->phone,
            $request->dob,
            'super_admin',
            $request->gender,
            $request->address,
        ]);


        return redirect()->route('login')->with('success', 'Registeration successfull');
    }
}
