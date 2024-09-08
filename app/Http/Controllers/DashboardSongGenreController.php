<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Song;
use Illuminate\Http\Request;

class DashboardSongGenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $song = Song::with('genres')->orderBy('title')->get();

        return view('dashboard.song_genre.index', [
            'title' => 'Song Genre Table',
            'songGenre' => $song,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.song_genre.create', [
            'title' => 'Create Song Genre',
            'songs' => Song::orderBy('title')->get(),
            'genres' => Genre::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'song_id' => 'required',
            'genre_id' => 'required',
        ]);

        $song = Song::find($validateData['song_id']);

        $song->genres()->attach($validateData['genre_id']);

        return redirect('/dashboard/song-genre')->with('success', 'The Relation has been created!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $song = Song::find($id);

        $song->genres()->detach($request->genre_id);

        return redirect('/dashboard/song-genre')->with('success', 'The Relation has been deleted!');
    }
}
