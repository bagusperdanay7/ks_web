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

    //  TODO: Filter Perbaiki
    public function index()
    {
        $galleryQuery = Project::latest()
                                ->filter(request(['search', 'category', 'type']))
                                ->get();

        $artistTotalQuery = Project::groupBy('artist_id')
                                    ->select('artist_id', Project::raw('count(*) as total'))
                                    ->inRandomOrder()
                                    ->get()
                                    ->take(6);

        $categoriesQuery = Project::groupBy('category_id')
                                    ->select('category_id', Project::raw('count(*) as total'))
                                    ->get()
                                    ->sort()
                                    ->take(4);

        $latestVideoQuery = Project::get(['id', 'project_title', 'category_id', 'date', 'thumbnail', 'type_id', 'artist_id', 'status'])
                                    ->sortByDesc('date')
                                    ->take(3);

        $recVideoQuery = Project::get(['id', 'project_title', 'category_id', 'date', 'thumbnail', 'type_id', 'artist_id', 'status'])
                                            ->shuffle()
                                            ->take(6);

        $title = '';

        if (request('type') || request('category') || request('search')) {
            $category = Category::firstWhere('slug', request('category'));
            $type = ProjectType::firstWhere('type_name', request('type'));

            if (request('type') && request('search')) {
                $title = request('search') . " & " . $type?->type_name;
            } elseif (request('category') && request('search')) {
                $title = request('search') . " & " . $category->category_name;
            } elseif (request('search')) {
                $title = request('search');
            } elseif (request('type')) {
                $title = $type?->type_name;
            } elseif (request('category')) {
                $title = $category->category_name;
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
            // "posts" => Project::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString()
            // $collection->take(3);
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
        ->where([['artists.id', $project->artist_id], ['projects.id', '!=', $project->id]])
        ->limit(6)
        ->get()->shuffle();

        // $user->posts()->where('active', 1)->get(); # has many

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
