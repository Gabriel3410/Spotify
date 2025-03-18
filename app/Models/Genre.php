<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $table = 'genres';

    protected $fillable = [
        'name',
    ];


    public function artists()
    {
        return $this->belongsToMany(Artist::class);
    }

    public function songs()
{
    return $this->hasMany(Song::class);
}


}
