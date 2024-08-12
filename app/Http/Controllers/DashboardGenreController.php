<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DashboardGenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.genres.index', [
            'title' => 'Genre Table',
            'genres' => Genre::orderBy('name')->paginate(50),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.genres.create', [
            'title' => 'Create Genre',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => ['required', 'max:191'],
        ]);

        Genre::create($validateData);

        return redirect('/dashboard/genres')->with('success', 'New Genre has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        return view('dashboard.genres.show', [
            'title' => $genre->name,
            'genre' => $genre,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        return view('dashboard.genres.edit', [
            'title' => 'Update Genre',
            'genre' => $genre,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genre $genre)
    {
        $rules = [
            'name' => ['required', 'max:191'],
        ];

        $validateData = $request->validate($rules);

        Genre::where('id', $genre->id)->update($validateData);

        return redirect('/dashboard/genres')->with('success', 'The Genre has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        try {
            Genre::destroy($genre->id);
            return redirect('/dashboard/genres')->with('success', 'The genre has been deleted!');
        } catch (QueryException $e) {
            if ($e->getCode() == "23000") {
                return redirect('/dashboard/genres')->with('danger', "Cannot delete this record because it is referenced in a related table. Please remove the related records before attempting to delete this one.");
            }
        }
    }
}
