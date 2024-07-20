<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Enums\ArtistClassification;
use App\Models\Company;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artist = Artist::orderBy('artist_name')->paginate(50)->withQueryString();

        if (request('search')) {
            $artist = Artist::where('artist_name', 'like', '%' . request('search') . '%')->orderBy('artist_name')->paginate(50)->withQueryString();
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
            'classifications' => ArtistClassification::cases(),
            'companies' => Company::all()->sortBy('name')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'artist_name' => ['required', 'max:191'],
            'codename' => ['required', 'unique:artists', 'max:191'],
            'classification' => ['required', Rule::enum(ArtistClassification::class)],
            'birthdate' => ['nullable', 'date'],
            'origin' => ['nullable', 'max:191'],
            'artist_picture' => ['image', 'file', 'max:2048'],
            'fandom' => ['nullable', 'max:191'],
            'company_id' => ['required'],
        ]);

        if ($request->file('artist_picture')) {
            $validateData['artist_picture'] = $request->file('artist_picture')->store('img/artist');
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
            'classifications' => ArtistClassification::cases(),
            'companies' => Company::all()->sortBy('name')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artist $artist)
    {
        $rules = [
            'artist_name' => ['required', 'max:191'],
            'classification' => ['required', Rule::enum(ArtistClassification::class)],
            'birthdate' => ['nullable', 'date'],
            'origin' => ['nullable', 'max:191'],
            'artist_picture' => ['image', 'file', 'max:2048'],
            'fandom' => ['nullable', 'max:191'],
            'company_id' => ['required'],
        ];

        if ($request->codename !== $artist->codename) {
            $rules['codename'] = "required|unique:artists|max:191";
        }

        $validateData = $request->validate($rules);

        if ($request->file('artist_picture')) {
            if ($artist->artist_picture !== null) {
                Storage::delete($artist->artist_picture);
            }

            $validateData['artist_picture'] = $request->file('artist_picture')->store('img/artist');
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

        if ($artist->artist_picture != null) {
            Storage::delete($artist->artist_picture);
        }

        // TODO: Bikin sesuai laravel try catchnya
        try {
            Artist::destroy($artist->id);
            return redirect('/dashboard/artists')->with('success', "The artist has been deleted!");
        } catch (QueryException $e) {
            if ($e->getCode() == "23000") {
                return redirect('/dashboard/artists')->with('danger', "Cannot delete this record because it is referenced in a related table. Please remove the related records before attempting to delete this one.");
            }
        }
    }
}
