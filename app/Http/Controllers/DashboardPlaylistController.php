<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class DashboardPlaylistController extends Controller
{
    final public const DASHBOARD_PLAYLIST_PATH = '/dashboard/playlists';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.playlists.index', [
            'title' => 'Playlist Table',
            'playlists' => Playlist::orderBy('name')->paginate(50),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.playlists.create', [
            'title' => 'Create Playlist',
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

        Playlist::create($validateData);

        return redirect(self::DASHBOARD_PLAYLIST_PATH)->with('success', 'New Playlist has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Playlist $playlist)
    {
        return view('dashboard.playlists.show', [
            'title' => $playlist->name,
            'playlist' => $playlist,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Playlist $playlist)
    {
        return view('dashboard.playlists.edit', [
            'title' => 'Update Playlist',
            'playlist' => $playlist,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Playlist $playlist)
    {
        $rules = [
            'name' => ['required', 'max:191'],
        ];

        $validateData = $request->validate($rules);

        Playlist::where('id', $playlist->id)->update($validateData);

        return redirect(self::DASHBOARD_PLAYLIST_PATH)->with('success', 'The Playlist has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Playlist $playlist)
    {
        try {
            Playlist::destroy($playlist->id);
            return redirect(self::DASHBOARD_PLAYLIST_PATH)->with('success', 'The playlist has been deleted!');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect(self::DASHBOARD_PLAYLIST_PATH)->with('danger', 'Cannot delete this record because it is referenced in a related table. Please remove the related records before attempting to delete this one.');
            }
        }
    }
}
