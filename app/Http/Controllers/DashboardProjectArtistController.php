<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Project;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;

class DashboardProjectArtistController extends Controller
{
    final public const DASHBOARD_PROJECT_ARTIST_PATH = '/dashboard/project-artist';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $project = Project::with('artists')->orderBy('title')->get();

        return view('dashboard.project_artist.index', [
            'title' => 'Project Artists Table',
            'projectArtist' => $project,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.project_artist.create', [
            'title' => 'Create Project Artist',
            'artists' => Artist::orderBy('artist_name')->where('classification', 'Group')->get(),
            'projects' => Project::orderBy('title')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'artist_id' => 'required',
            'project_id' => 'required',
        ]);

        $project = Project::find($validateData['project_id']);

        try {
            $project->artists()->attach($validateData['artist_id']);
            return redirect(self::DASHBOARD_PROJECT_ARTIST_PATH)->with('success', 'The Relation has been created!');
        } catch (UniqueConstraintViolationException) {
            return redirect(self::DASHBOARD_PROJECT_ARTIST_PATH)->with('warning', 'This project has already associated with the artist!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $project = Project::find($id);

        $project->artists()->detach($request->artist_id);

        return redirect(self::DASHBOARD_PROJECT_ARTIST_PATH)->with('success', 'The Relation has been deleted!');
    }
}
