<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('categories', [
            'title' => 'All Content Categories',
            'categories' => Category::all()->load('projects')->sortBy('category_name'),
        ]);
    }
}
