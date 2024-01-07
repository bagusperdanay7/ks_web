<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\ProjectType;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $galleryQuery = Project::latest()
                                ->where([['status', 'Completed'], ['is_exclusive', 'No']])
                                ->filter(request(['search', 'category', 'type']))
                                ->get();
                                
        if (request('sort') == 'title_asc') {
            $galleryQuery = Project::orderBy('project_title')
            ->where([['status', 'Completed'], ['is_exclusive', 'No']])
            ->filter(request(['search', 'category', 'type']))
            ->get();
        } elseif (request('sort') == 'latest') {
            $galleryQuery = Project::orderByDesc('date')
            ->where([['status', 'Completed'], ['is_exclusive', 'No']])
            ->filter(request(['search', 'category', 'type']))
            ->get();
        } elseif (request('sort') == 'oldest') {
            $galleryQuery = Project::orderBy('date')
            ->where([['status', 'Completed'], ['is_exclusive', 'No']])
            ->filter(request(['search', 'category', 'type']))
            ->get();
        }

        $artistTotalQuery = Project::where([['status', 'Completed'], ['is_exclusive', 'No']])
                                    ->groupBy('artist_id')
                                    ->select('artist_id', Project::raw('count(*) as total'))
                                    ->inRandomOrder()
                                    ->get()
                                    ->take(6);

        $categoriesQuery = Project::where([['status', 'Completed'], ['is_exclusive', 'No']])
                                    ->groupBy('category_id')
                                    ->select('category_id', Project::raw('count(*) as total'))
                                    ->get()
                                    ->sort()
                                    ->take(4);

        $latestVideoQuery = Project::where([['status', 'Completed'], ['is_exclusive', 'No']])
                                    ->get(['id', 'project_title', 'category_id', 'date', 'thumbnail', 'type_id', 'artist_id', 'status'])
                                    ->sortByDesc('date')
                                    ->take(3);

        $recVideoQuery = Project::where([['status', 'completed'], ['is_exclusive', 'No']])
                                ->get(['id', 'project_title', 'category_id', 'date', 'thumbnail', 'type_id', 'artist_id', 'status'])
                                ->shuffle()
                                ->take(6);

        $allCategoryQuery = Category::all()->sortBy('category_name');

        $allTypeQuery = ProjectType::all()->sortBy('type_name');

        $title = '';

        if (request('type') || request('category') || request('search')) {

            if (request('search')) {
                $title = request('search');
            }

            $preTitle = "Explore ";

        } else {
            $preTitle = "Gallery";
        }

        return view('gallery', [
            "title" => $preTitle . $title ,
            "galleries" => $galleryQuery,
            'artistsTotal' => $artistTotalQuery,
            'categories' =>  $categoriesQuery,
            'latestVideo' => $latestVideoQuery,
            'recommendationVideo' =>  $recVideoQuery,
            'allCategory' => $allCategoryQuery,
            'allType' => $allTypeQuery,
            // "posts" => Project::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString()
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $relatedVideoQ = $project::join('artists', 'artists.id', '=', 'projects.artist_id')
        ->select('projects.*', 'artists.codename')
        ->where([['artists.id', $project->artist_id], ['projects.id', '!=', $project->id], ['projects.status', 'Completed'], ['projects.is_exclusive', 'No']])
        ->limit(6)
        ->get()->shuffle();

        // $user->posts()->where('active', 1)->get(); # has many

        if ($project->status !== "Completed" || $project->is_exclusive !== "No") {
            abort(404);
        }

        return view('video', [
            "title" => $project->project_title,
            "video" => $project,
            "relatedVideo" => $relatedVideoQ
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
