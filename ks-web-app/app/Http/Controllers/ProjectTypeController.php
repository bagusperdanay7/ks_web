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
        $projectTypeQuery = $projectType;

        if (request('status') !== null) {
            if (request('sort') === 'title_asc') {
                $projectTypeQuery = $projectType->projects->where('status', request('status'))->sortBy('project_title');
            } elseif (request('sort') == 'latest') {
                $projectTypeQuery = $projectType->projects->where('status', request('status'))->sortByDesc('date');
            } elseif (request('sort') == 'oldest') {
                $projectTypeQuery = $projectType->projects->where('status', request('status'))->sortBy('date');
            } elseif (request('sort') === 'most') {
                $projectTypeQuery = $projectType->projects->where('status', request('status'))->sortByDesc('votes')            ;
            } elseif (request('sort') === 'least') {
                $projectTypeQuery = $projectType->projects->where('status', request('status'))->sortBy('votes');
            } elseif (request('sort') === null) {
                $projectTypeQuery = $projectType->projects->where('status', request('status'));
            }
        } else {
            if (request('sort') === 'title_asc') {
                $projectTypeQuery = $projectType->projects->sortBy('project_title');
            } elseif (request('sort') == 'latest') {
                $projectTypeQuery = $projectType->projects->sortByDesc('date');
            } elseif (request('sort') == 'oldest') {
                $projectTypeQuery = $projectType->projects->sortBy('date');
            } elseif (request('sort') === 'most') {
                $projectTypeQuery = $projectType->projects->sortByDesc('votes')            ;
            } elseif (request('sort') === 'least') {
                $projectTypeQuery = $projectType->projects->sortBy('votes');
            } elseif (request('sort') === null) {
                $projectTypeQuery = $projectType;
            }
        }

        return view('project_types', [
            "title" => $projectType->type_name,
            "projectType" => $projectType,
            "projectTypes" => $projectTypeQuery,
            // 'orderProjectType' => ProjectType::with('projects')->where('')->get()->sortBy('project_title'),
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

}