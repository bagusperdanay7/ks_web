<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Http\Requests\StoreArtistRequest;
use App\Http\Requests\UpdateArtistRequest;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artist = Artist::query()
                        ->join('projects', 'projects.artist_id', '=', 'artists.id')
                        ->select('artists.artist_name', 'artists.codename', 'artists.artist_pict')
                        ->selectRaw('count(projects.artist_id) AS total_artist')
                        ->groupby('artists.id')
                        ->orderby('artists.artist_name')
                        ->get();

        return view('artists', [
            'title' => 'All Artists',
            'active' => 'gallery',
            'artists' => Artist::all()->load('projects')->sortBy('artist_name'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArtistRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        return view('artist', [
            'title' => $artist->artist_name . " Gallery",
            'active' => 'gallery',
            'artist' => $artist,
            'artists' => $artist->projects->load('category', 'artist', 'type')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artist $artist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArtistRequest $request, Artist $artist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artist $artist)
    {
        //
    }
}
