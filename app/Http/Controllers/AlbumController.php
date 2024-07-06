<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Contracts\Database\Eloquent\Builder;

class AlbumController extends Controller
{
    public function index()
    {
        $recArtist = Artist::with('albums')->get()->shuffle()->take(6);
        $recAlbum = Album::with('artist')->get()->shuffle()->take(6);

        if (request('search')) {
            $searchResult = Album::whereHas('artist', function($q) {
                $q->where('artist_name', 'like', '%' . request('search') . '%');
            })->orWhere('album_name', 'like', '%' . request('search') . '%')->get();
        } else {
            $searchResult = null;
        }

        return view('album_songs.explore', [
            'title' => 'Explore Albums',
            'artists' => $recArtist,
            'albums' => $recAlbum,
            'searchResults' => $searchResult
        ]);
    }

    public function showArtist(Artist $artist)
    {
        return view('album_songs.artist', [
            'title' => $artist->artist_name,
            'artist' => $artist,
            'albumsArtist' => $artist->albums->sortByDesc('release'),
        ]);
    }

    public function show(Album $album)
    {
        $albumSongsQuery = Album::with(['songs' => function (Builder $query) {
            $query->orderBy('track_number');
        }])->where('id', $album->id)->get();

        return view('album_songs.album', [
            'title' => $album->album_name,
            'album' => $album,
            'songs' => $albumSongsQuery,
        ]);
    }
}
