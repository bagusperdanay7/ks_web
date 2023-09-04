<?php

namespace App\Http\Controllers;

use App\Models\ProjectType;
use App\Http\Requests\StoreProjectTypeRequest;
use App\Http\Requests\UpdateProjectTypeRequest;

class ProjectTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreProjectTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectType $projectType)
    {
        return view('project_types', [
            "title" => $projectType->type_name,
            "active" => "projects",
            "projectType" => $projectType,
            "projectsTypes" => $projectType->load('projects'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectType $projectType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectTypeRequest $request, ProjectType $projectType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectType $projectType)
    {
        //
    }

    // public function huge_project_vol1()
    // {
    //     return view('projects.huge_project_vol1', [
    //         "title" => "Huge Project Vol.#01",
    //         "active" => 'huge_project_vol1',
    //         'hugeProjects' => Project::where('project_class', 'Huge Project Vol.#01')->get(),
    //     ]);
    // }

    // public function nostalgic_vibes()
    // {
    //     return view('projects.nostalgic_vibes', [
    //         "title" => "Nostalgic Vibes",
    //         "active" => 'nostalgic_vibes',
    //         'nostalgicVibes' => Project::where('project_class', 'Nostalgic Vibes')->get(),
    //     ]);
    // }

    // public function youtube_comment()
    // {
    //     return view('projects.youtube_comment', [
    //         "title" => "Youtube Comment",
    //         "active" => 'youtube_comment',
    //         'youtubeCommentProjects' => Project::where('project_class', 'Youtube Comments')->get(),
    //     ]);
    // }

    // public function non_project()
    // {
    //     return view('projects.non-project', [
    //         "title" => "Non-Project",
    //         "active" => 'non_project',
    //         'nonProjects' => Project::where('project_class', 'Non-Project')->get(),
    //     ]);
    // }
}
