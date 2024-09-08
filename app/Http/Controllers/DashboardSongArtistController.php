<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enums\ArtistRole;
use App\Models\Artist;
use App\Models\Song;

class DashboardSongArtistController extends Controller
{
    final public const DASHBOARD_SONG_ARTIST_PATH = '/dashboard/song-artist';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $song = Song::with('artists')->orderBy('title')->get();

        return view('dashboard.song_artist.index', [
            'title' => 'Artist Songs Table',
            'songArtist' => $song,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.song_artist.create', [
            'title' => 'Create Song Artist',
            'artists' => Artist::orderBy('artist_name')->get(),
            'songs' => Song::orderBy('title')->get(),
            'roles' => ArtistRole::cases(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'role' => 'required',
            'artist_id' => 'required',
            'song_id' => 'required',
        ]);

        $song = Song::find($validateData['song_id']);

        $song->artists()->attach($validateData['artist_id'],  ['role' => $validateData['role']]);

        return redirect(self::DASHBOARD_SONG_ARTIST_PATH)->with('success', 'The Relation has been created!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $song = Song::find($id);

        $song->artists()->detach($request->artist_id);

        return redirect(self::DASHBOARD_SONG_ARTIST_PATH)->with('success', 'The Relation has been deleted!');
    }
}
