<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ArtistController extends Controller
{
    public function index(Request $request)
    {

        $perPage = $request->per_page ?: 10;
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $perPage;

        $users = DB::select('SELECT * FROM artists LIMIT ? OFFSET ?', [$perPage, $offset]);

        $totalUsers = DB::table('artists')->count();

        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $users,
            $totalUsers,
            $perPage,
            $currentPage,
            ['path' => $request->url()]
        );

        return view('artists.index', ['artists' => $paginator]);
    }
    public function create()
    {
        return view('artists.create');
    }
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|in:m,f,o',
            'first_release_year' => 'required|integer|between:1900,' . date('Y'),
            'no_of_albums_released' => 'required|integer|min:0',
            'email' => 'required',
        ]);

        DB::statement(
            "INSERT INTO users (first_name, last_name, email, password, phone, dob, gender, address, role, created_at, updated_at) 
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [
                $request->input('name'), // first_name
                '', // last_name
                $request->input('email'),
                Hash::make('password'), // password
                '', // phone
                now(), // dob
                $request->gender, // gender
                '', // address
                'artist', // role
                now(), // created_at
                now() // updated_at
            ]
        );

        // Get the last inserted user ID
        $userId = DB::select('SELECT LAST_INSERT_ID() AS id')[0]->id;

        // Insert artist data using raw query
        DB::statement(
            "INSERT INTO artists (name, dob, gender, first_release_year, user_id, no_of_albums_released, created_at, updated_at) 
         VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
            [
                $request->input('name'),
                $request->input('dob'),
                $request->input('gender'),
                $request->input('first_release_year'),
                $userId,
                $request->input('no_of_albums_released'),
                now(), // created_at
                now() // updated_at
            ]
        );

        return redirect()->route('artists.index')->with('success', 'Artist created successfully.');
    }

    public function show($id) {}

    public function edit($id) {}

    public function update(Request $request, $id) {}


    public function import()
    {
        return view('artists.import');
    }

    public function importPost(Request $request)
    {
        $file = $request->file('file');
        $filePath = $request->file('file')->get();
        dd($filePath);
        $fileContents = file($request->file('file')->path());
        dd($fileContents);
        foreach ($fileContents as $line) {
            $data = str_getcsv($line);
            dd($data);
        }

        return redirect()->back()->with('success', 'CSV file imported successfully.');
    }
}
