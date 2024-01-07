<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;
use App\Models\AlbumSong;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Models\Song;

class AlbumController extends Controller
{
    public function index()
    {
        $recArtist = Artist::with('albums')->get()->shuffle()->take(6);
        $recAlbum = Album::with('artist')->get()->shuffle()->take(6);

        if (request('search')) {
            // $searchResult = Album::with('artist')
            //                     ->where('album_name', 'like', '%' . request('search') . '%')
            //                     ->get();
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAlbumRequest $request, Album $album)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        //
    }
}
