<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumSong;
use App\Models\Song;
use Illuminate\Http\Request;

class DashboardAlbumSongsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $album = Album::with('songs')->orderBy('album_name')->get();

        return view('dashboard.album_songs.index', [
            'title' => 'Album Songs Table',
            'albumSongs' => $album
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.album_songs.create', [
            'title' => 'Create Album Song',
            'albums' => Album::all()->sortBy('album_name'),
            'songs' => Song::all()->sortBy('title'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'track_number' => 'required',
            'album_id' => 'required',
            'song_id' => 'required',
        ]);

        $album = Album::find($validateData['album_id']);

        $album->songs()->attach($validateData['song_id'],  ['track_number' => $validateData['track_number']]);

        return redirect('/dashboard/album-songs')->with('success', "The Relation has been created!");
    }

    /**
     * Display the specified resource.
     */
    public function show(AlbumSong $albumSong)
    {
        $albumSongsQ = Album::with('songs')->orderBy('album_name')->get();

        return view('dashboard.album_songs.show', [
            'title' => $albumSong->id,
            'albumSongs' => $albumSongsQ,
            'albumSong' => $albumSong,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AlbumSong $albumSong)
    {
        return view('dashboard.album_songs.edit', [
            'title' => 'Update Album Song',
            'albumSong' => $albumSong,
            'albums' => Album::all()->sortBy('album_name'),
            'songs' => Song::all()->sortBy('title'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AlbumSong $albumSong)
    {
        $rules = [
            'track_number' => 'required',
            'album_id' => 'required',
            'song_id' => 'required',
        ];

        $validateData = $request->validate($rules);

        AlbumSong::where('id', $albumSong->id)->update($validateData);

        return redirect('/dashboard/album-songs')->with('success', "The Album Song has been updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        AlbumSong::destroy($id);
    
        return redirect('/dashboard/album-songs')->with('success', "The Relation has been deleted!");
    }
}
