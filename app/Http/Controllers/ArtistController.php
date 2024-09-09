<?php

namespace App\Http\Controllers;

use App\Models\Artist;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('artists', [
            'title' => 'All Artists',
            'artists' => Artist::with('projects')->without('company')->whereHas('projects',  function ($query) {
                $query->where('status', 'Completed');
            }, '>', 0)->orderBy('artist_name')->get(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        $artistQuery = $artist->projects->where('status', 'Completed')->count();

        $artistVideoByGroup = $artist->projects
            ->where('status', 'Completed')
            ->sortBy('title')->groupBy('category_id');

        return view('artist', [
            'title' => $artist->artist_name . ' Gallery',
            'artist' => $artist,
            'artistVideos' => $artistQuery,
            'projectsByGroup' => $artistVideoByGroup
        ]);
    }
}
