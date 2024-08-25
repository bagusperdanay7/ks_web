<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Contracts\Database\Eloquent\Builder;

class AlbumController extends Controller
{
    public function index()
    {
        $recArtist = Artist::with('albums')->withCount(['albums'])->having('albums_count', '>=', 1)
            ->inRandomOrder()->take(6)->get();
        $recAlbum = Album::with('artists')->inRandomOrder()->take(6)->get();

        if (request('search')) {
            $searchResult = Album::with('artists')->whereHas('artists', function ($q) {
                $q->where('artist_name', 'like', '%' . request('search') . '%');
            })->orWhere('name', 'like', '%' . request('search') . '%')->get();
        } else {
            $searchResult = null;
        }

        return view('discography.explore', [
            'title' => 'Explore Albums',
            'artists' => $recArtist,
            'albums' => $recAlbum,
            'searchResults' => $searchResult
        ]);
    }

    public function showArtist(Artist $artist)
    {
        return view('discography.artist', [
            'title' => $artist->artist_name,
            'artist' => $artist,
            'albumsArtist' => $artist->albums->sortByDesc('release'),
        ]);
    }

    public function show(Album $album)
    {
        return view('discography.album', [
            'title' => $album->name,
            'album' => $album,
        ]);
    }
}
