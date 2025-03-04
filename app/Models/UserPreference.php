<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    use HasFactory;

    protected $table = 'user_preferences';

    protected $fillable=['user_id', 'genres'];

    protected $casts = [
        'genres' => 'array', //Converte json automaticamente para um array
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'artist_genre');
    }
}
