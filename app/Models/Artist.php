<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'dob', 'gender', 'first_release_year', 'no_of_albums_released'];


    protected function casts()
    {
        return [
            "dob" => DateTime::class,
        ];
    }

    public function musics()
    {
        return $this->hasMany(Music::class);
    }
}
