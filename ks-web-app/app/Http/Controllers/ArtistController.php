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
        return view('artists', [
            'title' => 'All Artists',
            'artists' => Artist::with('projects')->whereHas('projects',  function($query)  {
                $query->where([['status', 'Completed'], ['is_exclusive', 'No']]);//query on team model
            })->get()->sortBy('artist_name'),
            // 'artists' => Artist::all()->load('projects')->sortBy('artist_name'),
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
            'artist' => $artist,
            'artists' => $artist->projects->load('category', 'artist', 'type')->where('status', 'Completed')->where('is_exclusive', 'No')
            // 'artists' => $artist->projects->load('category', 'artist', 'type')
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
