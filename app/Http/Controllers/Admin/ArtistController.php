<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;

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
        $this->createArtist($request->all());

        return redirect()->route('artists.index')->with('success', 'Artist created successfully.');
    }

    protected function createArtist($request)
    {

        $this->validateRow($request);

        DB::statement(
            "INSERT INTO users (first_name, last_name, email, password, phone, dob, gender, address, role, created_at, updated_at) 
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [
                $request['name'], // first_name
                '', // last_name
                $request['email'],
                Hash::make('password'), // password
                '', // phone
                now(), // dob
                $request['gender'], // gender
                '', // address
                'artist', // role
                now(), // created_at
                now() // updated_at
            ]
        );

        $userId = DB::select('SELECT LAST_INSERT_ID() AS id')[0]->id;

        DB::statement(
            "INSERT INTO artists (name, dob, gender, first_release_year, user_id, no_of_albums_released, created_at, updated_at) 
         VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
            [
                $request['name'],
                $request['dob'],
                $request['gender'],
                $request['first_release_year'],
                $userId,
                $request['no_of_albums_released'],
                now(), // created_at
                now() // updated_at
            ]
        );
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
        $fileContents = file($file->path());
        $header = str_getcsv($fileContents[0]);
        for ($i = 1; $i < count($fileContents); $i++) {
            $row = str_getcsv($fileContents[$i]);

            // Map the CSV data to an associative array with headers as keys
            $rowData = array_combine($header, $row);

            // Validate and insert each row into the database
            $validatedData = $this->validateRow($rowData);
            $this->createArtist($validatedData);
        }

        return redirect()->back()->with('success', 'CSV file imported successfully.');
    }

    protected function validateRow($row)
    {
        // Validate each row using Laravel's validator
        return validator($row, [
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|in:m,f,o',
            'first_release_year' => 'required|integer|between:1900,' . date('Y'),
            'no_of_albums_released' => 'required|integer|min:0',
            'email' => 'required|email',
        ])->validate();
    }

    public function export()
    {
        return view('artists.export');
    }

    public function exportPost(Request $request)
    {
        // Validate the request input
        $request->validate([
            'count' => 'required|in:10,25,50,100,all',
            'columns' => 'required|array',
            'columns.*' => 'in:name,dob,gender,first_release_year,no_of_albums_released,email,all',
        ]);

        // Retrieve the selected columns and count from the request
        $columns = $request->input('columns');
        $count = $request->input('count');

        // Handle 'all' columns option
        if (in_array('all', $columns)) {
            // Fetch all the column names of the 'artists' table
            $columns = Schema::getColumnListing('artists');
        }

        // Build the SQL query with selected columns
        $query = 'SELECT ' . implode(',', $columns) . ' FROM artists';

        // Apply the count limit if not exporting all records
        if ($count !== 'all') {
            $query .= ' LIMIT ' . intval($count);
        }

        // Execute the raw SQL query and fetch the results
        $artists = DB::select($query);

        // Generate the CSV content
        $csvContent = $this->generateCsvContent($artists, $columns);

        // Return the CSV file as a download
        return Response::make($csvContent, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="artists_export.csv"',
        ]);
    }

    /**
     * Generate CSV content from the raw query result.
     *
     * @param  array  $artists
     * @param  array  $columns
     * @return string
     */
    protected function generateCsvContent($artists, $columns)
    {
        // Open a temporary memory file to write the CSV
        $handle = fopen('php://temp', 'r+');

        // Add the header row
        fputcsv($handle, $columns);

        // Add the artist rows
        foreach ($artists as $artist) {
            $row = [];
            foreach ($columns as $column) {
                $row[] = $artist->$column;
            }
            fputcsv($handle, $row);
        }

        // Rewind the file to the beginning
        rewind($handle);

        // Read the content from the file
        $csvContent = stream_get_contents($handle);

        // Close the file
        fclose($handle);

        return $csvContent;
    }
}
