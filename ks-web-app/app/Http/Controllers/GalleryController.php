<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\ContentCategory;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request('artist') || request('content_category') || request('search')) {
            $title = '';
            $content_category = ContentCategory::firstWhere('slug', request('content_category'));
            $artist = Artist::firstWhere('codename', request('artist'));

            if (request('artist') && request('search')) {
                $title = request('search') . " & " . $artist->artist_name;
            } elseif (request('content_category') && request('search')) {
                $title = request('search') . " & " . $content_category->name;
            } elseif (request('search')) {
                $title = request('search');
            } elseif (request('artist')) {
                $title = $artist->artist_name;
            } elseif (request('content_category')) {
                $title = $content_category->name;
            }

            return view('gallery', [
                "title" => "Explore " . $title,
                "active" => 'gallery',
                "gallery" => Project::latest()->filter(request(['search', 'content_category', 'artist']))->get(),
                'artists_total' => Project::groupBy('artist_id')->select('artist_id', Project::raw('count(*) as total'))->inRandomOrder()->get()->take(6),
                'categories' =>  Project::groupBy('content_category_id')->select('content_category_id', Project::raw('count(*) as total'))->get()->sort()->take(4),
                'latest_video' =>  Project::get(['id', 'project_title', 'content_category_id', 'project_date', 'project_thumbnail', 'project_class', 'artist_id', 'project_status'])->sortByDesc('project_date')->take(3),
                'recommendation_video' =>  Project::get(['id', 'project_title', 'content_category_id', 'project_date', 'project_thumbnail', 'project_class', 'artist_id', 'project_status'])->shuffle()->take(6),
            ]);
        } else {
            return view('gallery', [
                "title" => "Gallery",
                "active" => 'gallery',
                "gallery" => Project::latest()->filter(request(['search', 'content_category', 'artist']))->get(),
                'artists_total' => Project::groupBy('artist_id')->select('artist_id', Project::raw('count(*) as total'))->inRandomOrder()->get()->take(6),
                // 'artists_total' => Project::groupBy('artist_id')->select('artist_id', Project::raw('count(*) as total'))->get()->sortBy('artist_id')->take(6),
                'categories' =>  Project::groupBy('content_category_id')->select('content_category_id', Project::raw('count(*) as total'))->get()->sort()->take(4),
                // 'pro_count' =>  Project::get('project_category')->countBy('project_category')->sortKeys(),
                'latest_video' =>  Project::get(['id', 'project_title', 'content_category_id', 'project_date', 'project_thumbnail', 'project_class', 'artist_id', 'project_status'])->sortByDesc('project_date')->take(3),
                'recommendation_video' =>  Project::get(['id', 'project_title', 'content_category_id', 'project_date', 'project_thumbnail', 'project_class', 'artist_id', 'project_status'])->shuffle()->take(6),
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

    public function all_content_categories()
    {
        return view('content_categories', [
            'title' => 'All Content Categories',
            'active' => 'gallery',
            'content_categories' => ContentCategory::query()->join('projects', 'projects.content_category_id', '=', 'content_categories.id')->select('content_categories.name', 'content_categories.slug', 'content_categories.icon_class')->selectRaw('count(projects.content_category_id) AS total')->groupby('content_categories.id')->orderby('content_categories.name')->get()
        ]);
    }
}
