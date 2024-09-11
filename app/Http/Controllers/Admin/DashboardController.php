<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function base()
    {
        return redirect()->route('dashboard.index');
    }

    public function index()
    {
        $totalUsers = DB::select('SELECT COUNT(*) as total_users FROM users')[0]->total_users;

        $totalArtistManagers = DB::select('SELECT COUNT(*) as total_artist_managers FROM users WHERE role = ?', ['artist_manager'])[0]->total_artist_managers;

        $totalArtists = DB::select('SELECT COUNT(*) as total_artists FROM users WHERE role = ?', ['artist'])[0]->total_artists;

        $totalSongs = DB::select('SELECT COUNT(*) as total_songs FROM songs')[0]->total_songs;

        $topArtists = DB::select(
            'SELECT u.id as artist_id, u.first_name as artist_name, COUNT(s.id) as song_count 
        FROM users u 
        JOIN songs s ON u.id = s.artist_id 
        WHERE u.role = ? 
        GROUP BY u.id, u.first_name, u.last_name 
        ORDER BY song_count DESC 
        LIMIT 5',
            ['artist']
        );

        $songsByGenre = DB::select(
            'SELECT genre, COUNT(*) as song_count 
        FROM songs 
        GROUP BY genre'
        );

        return view('dashboard', compact('totalUsers', 'totalArtistManagers', 'totalArtists', 'totalSongs', 'topArtists', 'songsByGenre'));
    }
}
