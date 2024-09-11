<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;

    protected $table = "songs";

    protected $fillable = ['artist_id', 'title', 'album_name', 'genre'];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
}
