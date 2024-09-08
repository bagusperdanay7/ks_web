<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardPlaylistProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $playlists = Playlist::with(['projects' => function ($q) {
        //     $q->paginate(50);
        // }])->orderBy('name')->get();
        $playlists = Playlist::with('projects')->orderBy('name')->get();

        return view('dashboard.playlist_project.index', [
            'title' => 'Project Playlist Table',
            'playlistProject' => $playlists,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.playlist_project.create', [
            'title' => 'Create Playlist Project',
            'playlists' => Playlist::orderBy('name')->get(),
            'projects' => Project::orderBy('title')->where('status', 'Completed')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'order' => 'required',
            'playlist_id' => 'required',
            'project_id' => 'required',
            'main_video' => 'required',
        ]);

        $playlist = Playlist::find($validateData['playlist_id']);

        $playlist->projects()->attach($validateData['project_id'],  [
            'order' => $validateData['order'],
            'main_video' => $validateData['main_video']
        ]);

        return redirect('/dashboard/playlist-project')->with('success', 'The Relation has been created!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $playlist = Playlist::find($id);

        $playlist->projects()->detach($request->project_id);

        return redirect('/dashboard/playlist-project')->with('success', 'The Relation has been deleted!');
    }
}
