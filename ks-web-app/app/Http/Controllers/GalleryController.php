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
    public function index()
    {
        if (request('artist') || request('category') || request('search')) {
            $title = '';
            $category = Category::firstWhere('slug', request('category'));
            $artist = Artist::firstWhere('codename', request('artist'));

            if (request('artist') && request('search')) {
                $title = request('search') . " & " . $artist->artist_name;
            } elseif (request('category') && request('search')) {
                $title = request('search') . " & " . $category->name;
            } elseif (request('search')) {
                $title = request('search');
            } elseif (request('artist')) {
                $title = $artist->artist_name;
            } elseif (request('category')) {
                $title = $category->name;
            }

            return view('gallery', [
                "title" => "Explore " . $title,
                "active" => 'gallery',
                "gallery" => Project::latest()->filter(request(['search', 'category', 'artist']))->get(),
                'artists_total' => Project::groupBy('artist_id')->select('artist_id', Project::raw('count(*) as total'))->inRandomOrder()->get()->take(6),
                'categories' =>  Project::groupBy('category_id')->select('category_id', Project::raw('count(*) as total'))->get()->sort()->take(4),
                'latest_video' =>  Project::get(['id', 'project_title', 'category_id', 'project_date', 'project_thumbnail', 'project_class', 'artist_id', 'project_status'])->sortByDesc('project_date')->take(3),
                'recommendation_video' =>  Project::get(['id', 'project_title', 'category_id', 'project_date', 'project_thumbnail', 'project_class', 'artist_id', 'project_status'])->shuffle()->take(6),
            ]);
        } else {
            return view('gallery', [
                "title" => "Gallery",
                "active" => 'gallery',
                "gallery" => Project::latest()->filter(request(['search', 'category', 'artist']))->get(),
                'artists_total' => Project::groupBy('artist_id')->select('artist_id', Project::raw('count(*) as total'))->inRandomOrder()->get()->take(6),
                // 'artists_total' => Project::groupBy('artist_id')->select('artist_id', Project::raw('count(*) as total'))->get()->sortBy('artist_id')->take(6),
                'categories' =>  Project::groupBy('category_id')->select('category_id', Project::raw('count(*) as total'))->get()->sort()->take(4),
                // 'pro_count' =>  Project::get('project_category')->countBy('project_category')->sortKeys(),
                'latest_video' =>  Project::get(['id', 'project_title', 'category_id', 'project_date', 'project_thumbnail', 'project_class', 'artist_id', 'project_status'])->sortByDesc('project_date')->take(3),
                'recommendation_video' =>  Project::get(['id', 'project_title', 'category_id', 'project_date', 'project_thumbnail', 'project_class', 'artist_id', 'project_status'])->shuffle()->take(6),
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
        return view('categories', [
            'title' => 'All Content Categories',
            'active' => 'gallery',
            'categories' => Category::query()->join('projects', 'projects.category_id', '=', 'categories.id')->select('categories.name', 'categories.slug', 'categories.icon_class')->selectRaw('count(projects.category_id) AS total')->groupby('categories.id')->orderby('categories.name')->get()
        ]);
    }
}
