<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Company;
use App\Enums\AlbumType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class DashboardAlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $album = Album::orderBy('name')->paginate(50)->withQueryString();

        if (request('search')) {
            $album = Album::orderBy('name')->where('name', 'like', '%' . request('search') . '%')->paginate(50)->withQueryString();
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
            'artists' => Artist::all()->sortBy('artist_name'),
            'types' => AlbumType::cases(),
            'publishers' => Company::all()->sortBy('name')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => ['required', 'max:191'],
            'type' => ['required', Rule::enum(AlbumType::class)],
            'release' => ['required', 'date'],
            'cover' => ['image', 'file', 'max:1024', 'nullable'],
            'publisher_id' => ['required'],
        ]);

        if ($request->file('cover')) {
            $validateData['cover'] = $request->file('cover')->store('img/albums');
        }

        Album::create($validateData);

        return redirect('/dashboard/albums')->with('success', 'New Album has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        return view('dashboard.albums.show', [
            'title' => $album->name,
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
            'types' => AlbumType::cases(),
            'publishers' => Company::all()->sortBy('name')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        $rules = [
            'name' => ['required', 'max:191'],
            'type' => ['required', Rule::enum(AlbumType::class)],
            'release' => ['required', 'date'],
            'cover' => ['image', 'file', 'max:1024', 'nullable'],
            'publisher_id' => ['required'],
        ];

        $validateData = $request->validate($rules);

        if ($request->file('cover')) {
            if ($album->cover !== null) {
                Storage::delete($album->cover);
            }

            $validateData['cover'] = $request->file('cover')->store('img/albums');
        }

        Album::where('id', $album->id)->update($validateData);

        return redirect('/dashboard/albums')->with('success', 'The album has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        // TODO: Bikin sesuai laravel try catchnya
        try {
            Album::destroy($album->id);
            if ($album->cover != null) {
                Storage::delete($album->cover);
            }
            return redirect('/dashboard/albums')->with('success', 'The album has been deleted!');
        } catch (QueryException $e) {
            if ($e->getCode() == "23000") {
                return redirect('/dashboard/albums')->with('danger', "Cannot delete this record because it is referenced in a related table. Please remove the related records before attempting to delete this one.");
            }
        }
    }
}
