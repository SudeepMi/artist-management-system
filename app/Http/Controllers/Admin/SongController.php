<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SongController extends Controller
{
    //

    public function create($id)
    {
        return view('songs.create', compact('id'));
    }

    public function index(Request $request, $id)
    {
        $perPage = $request->per_page ?: 10;
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $perPage;

        $songs = DB::select('SELECT * FROM songs WHERE artist_id =? LIMIT ? OFFSET ?', [$id, $perPage, $offset]);

        $totaSongs = DB::table('songs')->where('artist_id', '=', $id)->count();

        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $songs,
            $totaSongs,
            $perPage,
            $currentPage,
            ['path' => $request->url()]
        );

        return view('songs.index', ['songs' => $paginator, 'id' => $id]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'artist_id' => 'required|exists:artists,id',
            'title' => 'required|string|max:255',
            'album_name' => 'required|string|max:255',
            'genre' => 'required|in:rnb,country,classic,rock,jazz',
        ], [
            'artist_id.required' => 'Please select an artist.',
            'artist_id.exists' => 'The selected artist does not exist.',
            'title.required' => 'The song title is required.',
            'album_name.required' => 'The album name is required.',
            'genre.required' => 'Please select a genre.',
            'genre.in' => 'The selected genre is invalid.',
        ]);

        DB::insert(
            'INSERT INTO songs (artist_id, title, album_name, genre, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())',
            [
                $validatedData['artist_id'],
                $validatedData['title'],
                $validatedData['album_name'],
                $validatedData['genre'],
            ]
        );

        return redirect()->route('songs.index', $validatedData['artist_id'])->with('success', 'Song created successfully.');
    }

    public function edit($id)
    {

        $song = DB::selectOne("SELECT * FROM songs WHERE id =?", [$id]);
        return view('songs.edit', compact('song'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'album_name' => 'required|string|max:255',
            'genre' => 'required|in:rnb,country,classic,rock,jazz',
            'artist_id' => 'required',
        ]);

        // Retrieve the validated input data
        $title = $request->input('title');
        $album_name = $request->input('album_name');
        $genre = $request->input('genre');

        // Update the song using a raw query
        $updated = DB::update('
        UPDATE songs 
        SET title = ?, album_name = ?, genre = ? 
        WHERE id = ?
    ', [$title, $album_name, $genre, $id]);

        // Check if the update was successful
        if ($updated) {
            return redirect()->route('songs.index', [$request->artist_id])->with('success', 'Song updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update song.');
        }
    }

    public function destroy($id)
    {
        DB::delete('DELETE FROM songs WHERE id =?', [$id]);

        return redirect()->back()->with('success', 'Song deleted successfully.');
    }
}
