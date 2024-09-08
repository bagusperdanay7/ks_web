<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\ProjectType;
use Illuminate\Database\Eloquent\Builder;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Match
        $galleryQuery = match (request('sort')) {
            'title_asc' => Project::orderBy('title')->where([['status', 'Completed'], ['exclusive', false]])
                ->filter(request(['search', 'category', 'type']))
                ->get(),
            'latest' => Project::orderByDesc('date')
                ->where([['status', 'Completed'], ['exclusive', false]])
                ->filter(request(['search', 'category', 'type']))
                ->get(),
            'oldest' => Project::orderBy('date')
                ->where([['status', 'Completed'], ['exclusive', false]])
                ->filter(request(['search', 'category', 'type']))
                ->get(),
            null => Project::latest()
                ->where([['status', 'Completed'], ['exclusive', false]])
                ->filter(request(['search', 'category', 'type']))
                ->get()
        };

        $artistWithProjectCount = Artist::with(['projects'])->withCount(['projects' => function (Builder $query) {
            $query->where('status', 'Completed')->where('exclusive', false);
        }])->having('projects_count', '>', 0)->inRandomOrder()->take(6)->get();

        $projectCategoriesCount = Project::where([['status', 'Completed'], ['exclusive', false]])
            ->groupBy('category_id')
            ->select('category_id', Project::raw('count(*) as total'))
            ->take(4)
            ->get()
            ->sortByDesc('total');

        $latestVideoQuery = Project::orderByDesc('date')
            ->where([['status', 'Completed'], ['exclusive', false]])
            ->take(3)
            ->get(['id', 'title', 'category_id', 'date', 'youtube_id', 'project_type_id', 'status']);

        $recVideoQuery = Project::where([['status', 'completed'], ['exclusive', false]])
            ->take(6)
            ->get(['id', 'title', 'category_id', 'date', 'youtube_id', 'project_type_id', 'status'])
            ->shuffle();

        $categoriesQuery = Category::orderBy('category_name')->get();

        $typesQuery = ProjectType::orderBy('type_name')->get();

        $title = '';

        if (request('type') || request('category') || request('search')) {

            if (request('search')) {
                $title = request('search');
            }

            $preTitle = 'Explore ';
        } else {
            $preTitle = 'Gallery ';
        }

        return view('gallery', [
            'title' => $preTitle . $title,
            'galleries' => $galleryQuery,
            'artists' => $artistWithProjectCount,
            'projectCategories' =>  $projectCategoriesCount,
            'latestVideo' => $latestVideoQuery,
            'recommendationVideo' =>  $recVideoQuery,
            'categories' => $categoriesQuery,
            'types' => $typesQuery,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        // $relatedVideoQ = $project::join('artists', 'artists.id', '=', 'projects.artist_id')
        //     ->select('projects.*', 'artists.codename')
        //     ->where([['artists.id', $project->artists->id], ['projects.id', '!=', $project->id], ['projects.status', 'Completed'], ['projects.exclusive', true]])
        //     ->limit(6)
        //     ->get()->shuffle();


        // $user->posts()->where('active', 1)->get(); # has many
        $relatedVideoQ = $project::where([['status', 'Completed'], ['exclusive', false], ['id', '!=', $project->id]])
            ->limit(6)
            ->get()
            ->shuffle();

        if ($project->status !== 'Completed' || $project->exclusive === true) {
            abort(404);
        }

        return view('video', [
            'title' => $project->title,
            'video' => $project,
            'relatedVideo' => $relatedVideoQ
        ]);
    }
}
