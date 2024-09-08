<?php

namespace App\Http\Controllers;

use App\Models\ProjectType;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class DashboardProjectTypeController extends Controller
{
    final public const MAX_STRING_CHAR_VALIDATION = 'max:50';
    final public const DASHBOARD_PROJECT_TYPE_PATH = '/dashboard/project-types';

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
            'type_name' => ['required', self::MAX_STRING_CHAR_VALIDATION],
            'slug' => ['required', 'unique:project_types', self::MAX_STRING_CHAR_VALIDATION],
        ]);

        $validateData['about'] = strip_tags($request->about);

        ProjectType::create($validateData);

        return redirect(self::DASHBOARD_PROJECT_TYPE_PATH)->with('success', 'New Type has been created!');
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
            'type_name' => ['required', self::MAX_STRING_CHAR_VALIDATION],
        ];

        if ($request->slug !== $projectType->slug) {
            $rules['slug'] = ['required', 'unique:project_types', self::MAX_STRING_CHAR_VALIDATION];
        }

        $validateData = $request->validate($rules);

        $validateData['about'] = strip_tags($request->about);

        ProjectType::where('id', $projectType->id)->update($validateData);

        return redirect(self::DASHBOARD_PROJECT_TYPE_PATH)->with('success', 'The Type has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectType $projectType)
    {
        try {
            ProjectType::destroy($projectType->id);
            return redirect(self::DASHBOARD_PROJECT_TYPE_PATH)->with('success', 'The Project Type has been deleted!');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect(self::DASHBOARD_PROJECT_TYPE_PATH)->with('danger', 'Cannot delete this record because it is referenced in a related table. Please remove the related records before attempting to delete this one.');
            }
        }
    }
}
