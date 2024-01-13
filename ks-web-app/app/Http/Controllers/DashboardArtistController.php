<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artist = Artist::orderBy('artist_name')->paginate(50);

        if (request('search')) {
            $artist = Artist::where('artist_name','like','%'. request('search') . '%')->orderBy('artist_name')->paginate(50);
        }

        return view('dashboard.artists.index', [
            'title' => 'Artists Table',
            'artists' => $artist,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.artists.create', [
            'title' => 'Create Artist',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'artist_name' => 'required|max:191',
            'codename' => 'required|unique:artists|max:191',
            'debut' => 'required|date',
            'origin' => 'required|max:191' ,
            'artist_pict' => 'image|file|max:4096',
            'fandom' => 'required|max:191',
            'company' => 'required|max:191',
        ]);

        if ($request->file('artist_pict')) {
            $validateData['artist_pict'] = $request->file('artist_pict')->store('img/artist');
        }

        $validateData['about'] = strip_tags($request->about);

        Artist::create($validateData);

        return redirect('/dashboard/artists')->with('success', "New Artist has been created!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        return view('dashboard.artists.show', [
            'title' => $artist->artist_name,
            'artist' => $artist,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artist $artist)
    {
        return view('dashboard.artists.edit', [
            'title' => 'Update Artist',
            'artist' => $artist,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artist $artist)
    {
        $rules = [
            'artist_name' => 'required|max:191',
            'debut' => 'required|date',
            'origin' => 'required|max:191',
            'artist_pict' => 'image|file|max:4096',
            'fandom' => 'required|max:191',
            'company' => 'required|max:191',
        ];

        if ($request->codename !== $artist->codename) {
            $rules['codename'] = "required|unique:artists|max:191";
        }
        
        $validateData = $request->validate($rules);

        if($request->file('artist_pict')) {
            if ($artist->artist_pict !== null) { 
                Storage::delete($artist->artist_pict);
            }

            $validateData['artist_pict'] = $request->file('artist_pict')->store('img/artist');
        }

        $validateData['about'] = strip_tags($request->about);

        Artist::where('id', $artist->id)->update($validateData);

        return redirect('/dashboard/artists')->with('success', "The Artist has been updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artist $artist)
    {

        if ($artist->artist_pict != null) {
            Storage::delete($artist->artist_pict);
        }

        Artist::destroy($artist->id);

        return redirect('/dashboard/artists')->with('success', "The artist has been deleted!");
    }
}
