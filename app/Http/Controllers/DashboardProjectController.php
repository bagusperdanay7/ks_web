<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Project;
use App\Models\Category;
use App\Models\ProjectType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;

class DashboardProjectController extends Controller
{
    final public const MAX_STRING_CHAR_VALIDATION = 'max:191';
    final public const DASHBOARD_PROJECT_PATH = '/dashboard/projects';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $project = Project::orderBy('title')->paginate(50)->withQueryString();

        if (request('search')) {
            $project = Project::where('title', 'like', '%' . request('search') . '%')
                ->orderBy('title')->paginate(50)->withQueryString();
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
            'statuses' => Status::cases(),
            'categories' => Category::orderBy('category_name')->get(),
            'types' => ProjectType::orderBy('type_name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'category_id' => ['required'],
            'project_type_id' => ['required'],
            'title' => ['required', self::MAX_STRING_CHAR_VALIDATION],
            'date' => ['nullable', 'date'],
            'requester' => ['required', self::MAX_STRING_CHAR_VALIDATION],
            'status' => ['required', Rule::enum(Status::class)],
            'youtube_id' => ['nullable', self::MAX_STRING_CHAR_VALIDATION],
            'progress' => ['integer'],
            'votes' => ['integer'],
            'exclusive' => ['nullable'],
            'created_at' => ['date']
        ]);

        if ($request->notes !== null) {
            $validateData['notes'] = strip_tags($request->notes);
        }

        Project::create($validateData);

        return redirect(self::DASHBOARD_PROJECT_PATH)->with('success', 'New Project has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('dashboard.projects.show', [
            'title' => $project->title,
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
            'statuses' => Status::cases(),
            'categories' => Category::orderBy('category_name')->get(),
            'types' => ProjectType::orderBy('type_name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $rules = [
            'category_id' => ['required'],
            'project_type_id' => ['required'],
            'title' => ['required', self::MAX_STRING_CHAR_VALIDATION],
            'date' => ['nullable', 'date'],
            'requester' => ['required', self::MAX_STRING_CHAR_VALIDATION],
            'status' => ['required', Rule::enum(Status::class)],
            'youtube_id' => ['nullable', self::MAX_STRING_CHAR_VALIDATION],
            'progress' => ['integer'],
            'votes' => ['integer'],
            'exclusive' => ['nullable'],
            'created_at' => ['date']
        ];

        $validateData = $request->validate($rules);

        if ($request->notes !== null) {
            $validateData['notes'] = strip_tags($request->notes);
        }

        Project::where('id', $project->id)->update($validateData);

        return redirect(self::DASHBOARD_PROJECT_PATH)->with('success', 'The Project has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try {
            Project::destroy($project->id);
            return redirect(self::DASHBOARD_PROJECT_PATH)->with('success', 'The Project has been deleted!');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect(self::DASHBOARD_PROJECT_PATH)->with('danger', 'Cannot delete this record because it is referenced in a related table. Please remove the related records before attempting to delete this one.');
            }
        }
    }
}
