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

        // switch (request('sort')) {
        //     case 'title_asc':
        //         $galleryQuery = Project::orderBy('title')
        //             ->where([['status', 'Completed'], ['exclusive', false]])
        //             ->filter(request(['search', 'category', 'type']))
        //             ->get();
        //         break;
        //     case 'latest':
        //         $galleryQuery = Project::orderByDesc('date')
        //             ->where([['status', 'Completed'], ['exclusive', false]])
        //             ->filter(request(['search', 'category', 'type']))
        //             ->get();
        //         break;
        //     case 'oldest':
        //         $galleryQuery = Project::orderBy('date')
        //             ->where([['status', 'Completed'], ['exclusive', false]])
        //             ->filter(request(['search', 'category', 'type']))
        //             ->get();
        //         break;
        //     default:
        //         $galleryQuery = Project::latest()
        //             ->where([['status', 'Completed'], ['exclusive', false]])
        //             ->filter(request(['search', 'category', 'type']))
        //             ->get();

        //         break;
        // }

        $artistWithProjectCount = Artist::with(['projects'])->withCount(['projects' => function (Builder $query) {
            $query->where('status', 'Completed')->where('exclusive', false);
        }])->having('projects_count', '>', 0)->inRandomOrder()->take(6)->get();

        $projectCategoriesCount = Project::where([['status', 'Completed'], ['exclusive', false]])
            ->groupBy('category_id')
            ->select('category_id', Project::raw('count(*) as total'))
            ->take(4)
            ->get()
            ->sort();

        $latestVideoQuery = Project::where([['status', 'Completed'], ['exclusive', false]])
            ->get(['id', 'title', 'category_id', 'date', 'youtube_id', 'project_type_id', 'status'])
            ->sortByDesc('date')
            ->take(3);

        $recVideoQuery = Project::where([['status', 'completed'], ['exclusive', false]])
            ->get(['id', 'title', 'category_id', 'date', 'youtube_id', 'project_type_id', 'status'])
            ->shuffle()
            ->take(6);

        $categoriesQuery = Category::all()->sortBy('category_name');

        $typesQuery = ProjectType::all()->sortBy('type_name');

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


        $relatedVideoQ = $project::where([['status', 'Completed'], ['exclusive', false], ['id', '!=', $project->id]])->limit(6)->get()->shuffle();
        // $user->posts()->where('active', 1)->get(); # has many

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
