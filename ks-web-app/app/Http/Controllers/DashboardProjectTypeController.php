<?php

namespace App\Http\Controllers;

use App\Models\ProjectType;
use Illuminate\Http\Request;

class DashboardProjectTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.project_types.index', [
            'title' => 'Project Type Table',
            'types' => ProjectType::all()->sortBy('type_name'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.project_types.create', [
            'title' => 'Create Project Type',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'type_name' => 'required|max:50',
            'slug' => 'required|unique:project_types|max:50',
        ]);

        $validateData['about'] = strip_tags($request->about);

        ProjectType::create($validateData);

        return redirect('/dashboard/project-types')->with('success', "New Type has been created!");
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectType $projectType)
    {
        return view('dashboard.project_types.show', [
            'title' => $projectType->type_name,
            'type' => $projectType,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectType $projectType)
    {
        return view('dashboard.project_types.edit', [
            'title' => 'Update Project Type',
            'type' => $projectType,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProjectType $projectType)
    {
        $rules = [
            'type_name' => 'required|max:50',
        ];

        if ($request->slug !== $projectType->slug) {
            $rules['slug'] = "required|unique:project_types|max:50";
        }
        
        $validateData = $request->validate($rules);

        $validateData['about'] = strip_tags($request->about);

        ProjectType::where('id', $projectType->id)->update($validateData);

        return redirect('/dashboard/project-types')->with('success', "The Type has been updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectType $projectType)
    {
        ProjectType::destroy($projectType->id);

        return redirect('/dashboard/project-types')->with('success', 'The Project Type has been deleted!');
    }
}
