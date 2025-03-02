<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Playlist extends Model
{
    protected $table = 'playlists';

    protected $fillable = ['user_id', 'name'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function playlist_songs(): BelongsToMany
    {
        return $this->belongsToMany(PlaylistSong::class);
    }

    public function playlistSongs(): HasMany
    {
        return $this->hasMany(PlaylistSong::class, 'playlist_id');
    }

    public function songs(): BelongsToMany
    {
        return $this->belongsToMany(Song::class, 'playlist_song', 'playlist_id', 'song_id');
    }
}
