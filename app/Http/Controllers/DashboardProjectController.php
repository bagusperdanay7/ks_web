<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Category;
use App\Models\Project;
use App\Models\ProjectType;
use Illuminate\Http\Request;

class DashboardProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $project = Project::orderBy('project_title')->paginate(50)->withQueryString();

        if (request('search')) {
            $project = Project::where('project_title', 'like', '%' . request('search') . '%')
                ->orderBy('project_title')->paginate(50)->withQueryString();
        }

        return view('dashboard.projects.index', [
            'title' => 'Projects Table',
            'projects' => $project,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.projects.create', [
            'title' => 'Create Project',
            'artists' => Artist::all()->sortBy('artist_name'),
            "categories" => Category::all()->sortBy('category_name'),
            "types" => ProjectType::all()->sortBy('type_name'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'artist_id' => 'required',
            'category_id' => 'required',
            'type_id' => 'required',
            'project_title' => 'required|max:191',
            'date' => 'nullable|date',
            'requester' => 'required|max:191',
            'status' => 'required',
            'url' => 'max:191',
            'thumbnail' => 'max:191',
            'progress' => 'integer',
            'votes' => 'integer',
            'exclusive' => 'required',
            'created_at' => 'nullable|date'
        ]);

        $validateData['notes'] = strip_tags($request->notes);

        Project::create($validateData);

        return redirect('/dashboard/projects')->with('success', "New Project has been created!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('dashboard.projects.show', [
            'title' => $project->project_title,
            'project' => $project,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('dashboard.projects.edit', [
            'title' => 'Update Project',
            'project' => $project,
            'artists' => Artist::all()->sortBy('artist_name'),
            "categories" => Category::all()->sortBy('category_name'),
            "types" => ProjectType::all()->sortBy('type_name'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {

        $rules = [
            'artist_id' => 'required',
            'category_id' => 'required',
            'type_id' => 'required',
            'project_title' => 'required|max:191',
            'requester' => 'required|max:191',
            'date' => 'nullable|date',
            'status' => 'required',
            'url' => 'max:191',
            'thumbnail' => 'max:191',
            'progress' => 'integer',
            'votes' => 'integer',
            'is_exclusive' => 'required',
            'created_at' => 'nullable|date'
        ];

        $validateData = $request->validate($rules);

        $validateData['notes'] = strip_tags($request->notes);

        Project::where('id', $project->id)->update($validateData);

        return redirect('/dashboard/projects')->with('success', "The Project has been updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        Project::destroy($project->id);

        return redirect('/dashboard/projects')->with('success', "The Project has been deleted!");
    }
}
