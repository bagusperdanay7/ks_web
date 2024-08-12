<?php

namespace App\Http\Controllers;

use App\Enums\SongCategory;
use App\Models\Album;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;

class DashboardSongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $songQuery = Song::orderBy('title')->paginate(50)->withQueryString();

        if (request('search')) {
            $songQuery = Song::orderBy('title')->where('title', 'like', '%' . request('search') . '%')->paginate(50)->withQueryString();
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
            'categories' => SongCategory::cases(),
            'albums' => Album::all()->sortBy('name'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => ['required', 'max:191'],
            'duration' => ['integer', 'nullable'],
            'track_number' => ['integer', 'required'],
            'category' => ['required', Rule::enum(SongCategory::class)],
            'album_id' => ['required'],
            'lyrics' => ['nullable'],
        ]);

        Song::create($validateData);

        return redirect('/dashboard/songs')->with('success', 'New Song has been created!');
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
            'categories' => SongCategory::cases(),
            'albums' => Album::all()->sortBy('name')
        ]);
    }

    /**
     * Update the specified resource in storage.
     * 
     */
    public function update(Request $request, Song $song)
    {
        $rules = [
            'title' => ['required', 'max:191'],
            'duration' => ['integer', 'nullable'],
            'track_number' => ['integer', 'required'],
            'category' => ['required', Rule::enum(SongCategory::class)],
            'album_id' => ['required'],
            'lyrics' => ['nullable'],
        ];

        $validateData = $request->validate($rules);

        Song::where('id', $song->id)->update($validateData);

        return redirect('/dashboard/songs')->with('success', 'The Song has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Song $song)
    {
        // TODO: Bikin sesuai laravel try catchnya
        try {
            Song::destroy($song->id);
            return redirect('/dashboard/songs')->with('success', 'The song has been deleted!');
        } catch (QueryException $e) {
            if ($e->getCode() == "23000") {
                return redirect('/dashboard/songs')->with('danger', "Cannot delete this record because it is referenced in a related table. Please remove the related records before attempting to delete this one.");
            }
        }
    }
}
