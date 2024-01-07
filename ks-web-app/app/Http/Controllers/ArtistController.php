<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Project;
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
                $query->where([['status', 'Completed'], ['is_exclusive', 'No']]);
            })->orderBy('artist_name')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        $artistQuery = $artist->projects->load('category', 'artist', 'type')
                            ->where('status', 'Completed')->where('is_exclusive', 'No')
                            ->sortBy('project_title');

        return view('artist', [
            'title' => $artist->artist_name . " Gallery",
            'artist' => $artist,
            'artists' => $artistQuery
            // 'artists' => Project::with('artist')->where('artist_id', $artist->id)->where('status', 'Completed')->where('is_exclusive', 'no')->orderByDesc('date')->paginate(5)
        ]);
    }
}
