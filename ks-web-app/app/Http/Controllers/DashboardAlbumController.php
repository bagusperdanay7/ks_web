<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardAlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $album = Album::orderBy('album_name')->paginate(50)->withQueryString();

        if (request('search')) {
            $album = Album::orderBy('album_name')->where('album_name', 'like', '%' . request('search') . '%')->paginate(50)->withQueryString();
        }

        return view('dashboard.albums.index', [
            'title' => 'Albums Table',
            'albums' => $album,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.albums.create', [
            'title' => 'Create Album',
            'artists' => Artist::all()->sortBy('artist_name')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'artist_id' => 'required',
            'album_name' => 'required|max:191',
            'release' => 'required|date',
            'cover' => 'image|file|max:1024',
            'type' => 'required',
            'publisher' => 'required|max:191',
        ]);

        if ($request->file('cover')) {
            $validateData['cover'] = $request->file('cover')->store('img/albums');
        }

        Album::create($validateData);

        return redirect('/dashboard/albums')->with('success', "New Album has been created!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        return view('dashboard.albums.show', [
            'title' => $album->album_name,
            'album' => $album,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        return view('dashboard.albums.edit', [
            'title' => 'Update Album',
            'album' => $album,
            'artists' => Artist::all()->sortBy('artist_name'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        $rules = [
            'artist_id' => 'required',
            'album_name' => 'required|max:191',
            'type' => 'required',
            'release' => 'required|date',
            'cover' => 'image|file|max:1024',
            'publisher' => 'required|max:191',
        ];

        $validateData = $request->validate($rules);

        if ($request->file('cover')) {
            if ($album->cover !== null) {
                Storage::delete($album->cover);
            }

            $validateData['cover'] = $request->file('cover')->store('img/albums');
        }

        Album::where('id', $album->id)->update($validateData);

        return redirect('/dashboard/albums')->with('success', "The album has been updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        if ($album->cover != null) {
            Storage::delete($album->cover);
        }

        Album::destroy($album->id);

        return redirect('/dashboard/albums')->with('success', "The album has been deleted!");
    }
}
