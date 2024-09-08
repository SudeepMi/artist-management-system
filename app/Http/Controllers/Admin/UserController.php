<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    public function create()
    {
        return view('users.create');
    }


    public function store(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'first_name' => 'required|string|min:3|max:50',
            'last_name' => 'required|string|min:3|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:20',
            'dob' => 'required|date',
            'gender' => 'required|in:m,f,o',
            'address' => 'required|string|max:255',
        ], [
            'first_name.required' => 'First name is required.',
            'first_name.min' => 'First name must be at least 3 characters.',
            'last_name.required' => 'Last name is required.',
            'last_name.min' => 'Last name must be at least 3 characters.',
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email format.',
            'email.unique' => 'Email is already registered.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'phone.required' => 'Phone number is required.',
            'dob.required' => 'Date of birth is required.',
            'dob.date' => 'Invalid date format.',
            'gender.required' => 'Gender is required.',
            'gender.in' => 'Invalid gender selection.',
            'address.required' => 'Address is required.',
        ]);

        $hashedPassword = Hash::make($request->password);

        DB::insert('INSERT INTO users (first_name, last_name, email, password, phone, dob, role, gender, address) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $request->first_name,
            $request->last_name,
            $request->email,
            $hashedPassword,
            $request->phone,
            $request->dob,
            $request->role,
            $request->gender,
            $request->address,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function index(Request $request)
    {

        $perPage = $request->per_page ?: 10;
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $perPage;

        $users = DB::select('SELECT * FROM users LIMIT ? OFFSET ?', [$perPage, $offset]);

        $totalUsers = DB::table('users')->count();

        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $users,
            $totalUsers,
            $perPage,
            $currentPage,
            ['path' => $request->url()]
        );

        return view('users.index', ['users' => $paginator]);
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
            'phone' => 'required',
            'dob' => 'required|date',
            'gender' => 'required|in:m,f,o',
            'address' => 'required',
        ], [
            'first_name.required' => 'The first name field is mandatory.',
            'first_name.min' => 'The first name must be at least 3 characters long.',
            'last_name.required' => 'The last name field is mandatory.',
            'last_name.min' => 'The last name must be at least 3 characters long.',
            'email.required' => 'The email address field is mandatory.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'password.min' => 'The password must be at least 8 characters long.',
            'phone.required' => 'The phone number field is mandatory.',
            'dob.required' => 'The date of birth field is mandatory.',
            'dob.date' => 'The date of birth must be a valid date.',
            'gender.required' => 'The gender field is mandatory.',
            'gender.in' => 'Invalid gender selection.',
            'address.required' => 'The address field is mandatory.',
        ]);

        $sql = "UPDATE users SET first_name = ?, last_name = ?, email = ?, phone = ?, dob = ?, gender = ?, address = ?";

        $parameters = [
            $request->first_name,
            $request->last_name,
            $request->email,
            $request->phone,
            $request->dob,
            $request->gender,
            $request->address
        ];

        if ($request->filled('password')) {
            $sql .= ", password = ?";
            $parameters[] = Hash::make($request->password);
        }

        $sql .= " WHERE id = ?";
        $parameters[] = $id;

        DB::update($sql, $parameters);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id){
        DB::delete('DELETE FROM users WHERE id =?', [$id]);

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }


}
