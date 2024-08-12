<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Artist;
use App\Models\Project;
use App\Models\Category;
use App\Models\ProjectType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;

class DashboardProjectController extends Controller
{
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
            'artists' => Artist::all()->sortBy('artist_name'),
            'statuses' => Status::cases(),
            'categories' => Category::all()->sortBy('category_name'),
            'types' => ProjectType::all()->sortBy('type_name'),
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
            'title' => ['required', 'max:191'],
            'date' => ['nullable', 'date'],
            'requester' => ['required', 'max:191'],
            'status' => ['required', Rule::enum(Status::class)],
            'youtube_id' => ['nullable', 'max:191'],
            'progress' => ['integer'],
            'votes' => ['integer'],
            'exclusive' => ['nullable'],
            'created_at' => ['date']
        ]);

        // TODO: Kalau kosong biarkan
        $validateData['notes'] = strip_tags($request->notes);

        Project::create($validateData);

        return redirect('/dashboard/projects')->with('success', 'New Project has been created!');
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
            'categories' => Category::all()->sortBy('category_name'),
            'types' => ProjectType::all()->sortBy('type_name'),
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
            'title' => ['required', 'max:191'],
            'date' => ['nullable', 'date'],
            'requester' => ['required', 'max:191'],
            'status' => ['required', Rule::enum(Status::class)],
            'youtube_id' => ['nullable', 'max:191'],
            'progress' => ['integer'],
            'votes' => ['integer'],
            'exclusive' => ['nullable'],
            'created_at' => ['date']
        ];

        $validateData = $request->validate($rules);

        $validateData['notes'] = strip_tags($request->notes);

        Project::where('id', $project->id)->update($validateData);

        return redirect('/dashboard/projects')->with('success', 'The Project has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // TODO: Bikin sesuai laravel try catchnya
        try {
            Project::destroy($project->id);
            return redirect('/dashboard/projects')->with('success', 'The Project has been deleted!');
        } catch (QueryException $e) {
            if ($e->getCode() == "23000") {
                return redirect('/dashboard/projects')->with('danger', "Cannot delete this record because it is referenced in a related table. Please remove the related records before attempting to delete this one.");
            }
        }
    }
}
