<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  TODO: EDIT MENGGUNAKAN load saja, tidak perlu join, karena sudah join menggunakan load
    public function index()
    {
        $galleryQuery = Project::latest()
                                ->filter(request(['search', 'category', 'artist']))
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


        if (request('artist') || request('category') || request('search')) {
            $title = '';
            $category = Category::firstWhere('slug', request('category'));
            $artist = Artist::firstWhere('codename', request('artist'));

            if (request('artist') && request('search')) {
                $title = request('search') . " & " . $artist->artist_name;
            } elseif (request('category') && request('search')) {
                $title = request('search') . " & " . $category->category_name;
            } elseif (request('search')) {
                $title = request('search');
            } elseif (request('artist')) {
                $title = $artist->artist_name;
            } elseif (request('category')) {
                $title = $category->category_name;
            }

            return view('gallery', [
                "title" => "Explore " . $title,
                "active" => 'gallery',
                "gallery" => $galleryQuery,
                'artistsTotal' => $artistTotalQuery,
                'categories' =>  $categoriesQuery,
                'latestVideo' =>  $latestVideoQuery,
                'recommendationVideo' =>  $recVideoQuery,
            ]);
        } else {
            return view('gallery', [
                "title" => "Gallery",
                "active" => 'gallery',
                "gallery" => $galleryQuery,
                'artistsTotal' => $artistTotalQuery,
                'categories' =>  $categoriesQuery,
                'latestVideo' => $latestVideoQuery,
                'recommendationVideo' =>  $recVideoQuery,
                // 'artistTotal' => Project::groupBy('artist_id')->select('artist_id', Project::raw('count(*) as total'))->get()->sortBy('artist_id')->take(6),
                // 'pro_count' =>  Project::get('project_category')->countBy('project_category')->sortKeys(),
                // "posts" => Project::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString()
                // $collection->take(3);
            ]);
        }
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
        return view('video', [
            "title" => $project->project_title,
            "active" => "gallery",
            "video" => $project
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

    public function all_categories()
    {
        $allCategoryQuery = Category::query()
                                    ->join('projects', 'projects.category_id', '=', 'categories.id')
                                    ->select('categories.category_name', 'categories.slug', 'categories.icon_class')
                                    ->selectRaw('count(projects.category_id) AS total')
                                    ->groupby('categories.id')
                                    ->orderby('categories.category_name')
                                    ->get();

        return view('categories', [
            'title' => 'All Content Categories',
            'active' => 'gallery',
            'categories' => $allCategoryQuery,
        ]);
    }
}
