<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Artist extends Model
{
    protected $table = 'artists';

    protected $fillable = ['name', 'bio', 'image', 'genre_id'];

    // conexões com outras tabelas com albums e songs pois um artista pode tem 1 ou vários albums ou songs;

    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class);
    }


    public function albums(): HasMany
    {
        return $this->hasMany(Album::class);
    }

    public function UserPreference()
    {
        return $this->belongsToMany(UserPreference::class, 'artist_genre');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function songs()
    {
        return $this->hasMany(Song::class);
    }
}
