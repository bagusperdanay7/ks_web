<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('projects', [
            "title" => "All Projects",
            "active" => 'projects',
            'projects_upcoming' => Project::where('project_status', 'On Process')->get()->sortBy('project_date'),
            'huge_projects' => Project::where('project_class', 'Huge Project Vol.#01')->limit(10)->get(),
            'nv_projects' => Project::where('project_class', 'Nostalgic Vibes')->limit(10)->get(),
            'youtube_com_projects' => Project::where('project_class', 'Youtube Comments')->limit(10)->get(),
            'non_projects' => Project::where('project_class', 'Non-Project')->limit(10)->get(),
            // "posts" => Project::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString()
            // $collection->take(3);
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }

    public function huge_project_vol1()
    {
        return view('projects.huge_project_vol1', [
            "title" => "Huge Project Vol.#01",
            "active" => 'huge_project_vol1',
            'huge_projects' => Project::where('project_class', 'Huge Project Vol.#01')->get(),
        ]);
    }

    public function nostalgic_vibes()
    {
        return view('projects.nostalgic_vibes', [
            "title" => "Nostalgic Vibes",
            "active" => 'nostalgic_vibes',
            'nv_projects' => Project::where('project_class', 'Nostalgic Vibes')->get(),
        ]);
    }

    public function youtube_comment()
    {
        return view('projects.youtube_comment', [
            "title" => "Youtube Comment",
            "active" => 'youtube_comment',
            'youtube_com_projects' => Project::where('project_class', 'Youtube Comments')->get(),
        ]);
    }

    public function non_project()
    {
        return view('projects.non-project', [
            "title" => "Non-Project",
            "active" => 'non_project',
            'non_project' => Project::where('project_class', 'Non-Project')->get(),
        ]);
    }

    public function request_list()
    {
        return view('request_list', [
            'title' => 'Request List',
            'active' => 'request_list',
            'projects' => Project::orderBy('project_title')->where('project_class', '!=', 'Non-Project')->paginate(20),
            'completed_projects_req' => Project::where([['project_status', 'Completed'], ['project_class', '!=', 'Non-Project']])->get()->sortBy('project_title'),
            'pending_projects_req' => Project::where([['project_status', 'Pending'],  ['project_class', '!=', 'Non-Project']])->get()->sortBy('project_title'),
            'rejected_projects_req' => Project::where([['project_status', 'Rejected'],  ['project_class', '!=', 'Non-Project']])->get()->sortBy('project_title'),
        ]);
    }
}
