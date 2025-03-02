<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlaylistSong extends Model
{
    protected $table = 'playlist_song';

    protected $fillable = ['playlist_id', 'song_id'];

    public function playlist(): BelongsTo
    {
        return $this->belongsTo(Playlist::class, 'playlist_id');
    }

    public function song(): BelongsTo
    {
        return $this->belongsTo(Song::class, 'song_id');
    }
}
