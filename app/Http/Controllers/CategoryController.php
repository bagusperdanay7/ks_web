<?php

namespace App\Http\Controllers;

use App\Models\Project;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $categories = Category::with('projects')->withCount(['projects' => function (Builder $query) {
        //     $query->where('status', 'Completed')->where('exclusive', false);
        // }])->having('projects_count', '>', 0)->orderBy('category_name')->get();

        $categories = Project::where([['status', 'Completed'], ['exclusive', false]])
            ->groupBy('category_id')
            ->select('category_id', Project::raw('count(*) as total'))
            ->get()
            ->sortByDesc('total');

        return view('categories', [
            'title' => 'All Content Categories',
            'categories' => $categories,
        ]);
    }
}
