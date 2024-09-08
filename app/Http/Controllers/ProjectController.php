<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectType;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {

        // TODO: Ubah script di bawah ini & Update performance untuk query dibawah
        // $users = User::with(['posts' => function (Builder $query) {
        //     $query->where('title', 'like', '%code%');
        // }])->get();

        // $hugeProject = ProjectType::with(['category' => function (Builder $query) {
        //     $query->where('category_name', 'Line Distribution');
        // }]);

        // $allType = ProjectType::orderBy('id')->get();

        $hugeProjectsQuery = Project::join('project_types', 'project_types.id', '=', 'projects.project_type_id')
            ->where('project_types.type_name', 'Huge Project Vol.#01')
            ->limit(10)
            ->get();

        $nostalgicVibesQuery = Project::join('project_types', 'project_types.id', '=', 'projects.project_type_id')
            ->where('project_types.type_name', 'Nostalgic Vibes')
            ->limit(10)
            ->get();

        $youtubeCommentQuery = Project::join('project_types', 'project_types.id', '=', 'projects.project_type_id')
            ->where('project_types.type_name', 'Youtube Comment')
            ->limit(10)
            ->get();

        $nonProjectQuery = Project::join('project_types', 'project_types.id', '=', 'projects.project_type_id')
            ->where('project_types.type_name', 'Non-Project')
            ->limit(10)
            ->get();

        return view('projects', [
            'title' => 'All Projects',
            'active' => 'projects',
            'upcomingProjects' => Project::where('status', 'In Progress')->orderBy('date')->get(),
            'allProjectType' => ProjectType::all(),
            'nonProjects' => $nonProjectQuery,
            'hugeProjects' => $hugeProjectsQuery,
            'nostalgicVibesProjects' => $nostalgicVibesQuery,
            'youtubeCommentProjects' => $youtubeCommentQuery,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('project', [
            'title' => $project->title,
            'project' => $project
        ]);
    }

    public function upvote(Project $project)
    {

        $upvote = $project->votes + 1;

        Project::where('id', $project->id)->update(['votes' => $upvote]);

        return redirect('/projects/' . $project->id)->with('upvoteSuccess', 'Upvote successful!. You are only able upvote a project three times per day!.');
    }
}
