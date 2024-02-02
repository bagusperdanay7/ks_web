<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class DashboardSongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
<<<<<<< HEAD
        $songQuery = Song::orderBy('title')->paginate(50)->withQueryString();

        if (request('search')) {
            $songQuery = Song::orderBy('title')->where('title','like','%'. request('search') . '%')->paginate(50)->withQueryString();
=======
        $songQuery = Song::orderBy('title')->paginate(50);

        if (request('search')) {
            $songQuery = Song::orderBy('title')->where('title','like','%'. request('search') . '%')->paginate(50);
>>>>>>> f18853d370fd6012683fb0fcdcc189fe71f044e4
        }

        return view('dashboard.songs.index', [
            'title' => 'Songs Table',
            'songs' => $songQuery,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.songs.create', [
            'title' => 'Create Song',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|max:191',
            'genre' => 'required|max:191',
            'author' => 'max:191' ,
            'composer' => 'max:191',
            'arranger' => 'max:191',
        ]);

        Song::create($validateData);

        return redirect('/dashboard/songs')->with('success', "New Song has been created!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Song $song)
    {
        return view('dashboard.songs.show', [
            'title' => $song->title,
            'song' => $song,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Song $song)
    {
        return view('dashboard.songs.edit', [
            'title' => 'Update Song',
            'song' => $song,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Song $song)
    {
        $rules = [
            'title' => 'required|max:191',
            'genre' => 'required|max:191',
            'author' => 'max:191' ,
            'composer' => 'max:191',
            'arranger' => 'max:191',
        ];
        
        $validateData = $request->validate($rules);

        Song::where('id', $song->id)->update($validateData);

        return redirect('/dashboard/songs')->with('success', "The Song has been updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Song $song)
    {
        Song::destroy($song->id);

        return redirect('/dashboard/songs')->with('success', "The song has been deleted!");
    }
}
