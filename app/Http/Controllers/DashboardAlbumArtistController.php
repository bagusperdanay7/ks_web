<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Database\UniqueConstraintViolationException;

class DashboardAlbumArtistController extends Controller
{
    final public const DASHBOARD_ALBUM_ARTIST_PATH = '/dashboard/album-artist';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $album = Album::with('artists')->orderBy('name')->get();

        return view('dashboard.album_artist.index', [
            'title' => 'Album Artists Table',
            'albumArtist' => $album,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.album_artist.create', [
            'title' => 'Create Album Artist',
            'artists' => Artist::orderBy('artist_name')->get(),
            'albums' => Album::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'artist_id' => 'required',
            'album_id' => 'required',
        ]);

        $album = Album::find($validateData['album_id']);

        try {
            $album->artists()->attach($validateData['artist_id']);
            return redirect(self::DASHBOARD_ALBUM_ARTIST_PATH)->with('success', 'The Relation has been created!');
        } catch (UniqueConstraintViolationException) {
            return redirect(self::DASHBOARD_ALBUM_ARTIST_PATH)->with('warning', 'This project has already associated with the artist!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $album = Album::find($id);

        $album->artists()->detach($request->artist_id);

        return redirect(self::DASHBOARD_ALBUM_ARTIST_PATH)->with('success', 'The Relation has been deleted!');
    }
}
