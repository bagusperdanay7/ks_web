<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('home', [
            "title" => "home",
            "active" => 'home',
            'schedules' => Project::where('project_status', 'On Process')->get()->sortBy('project_date'),
            // 'schedule' => Project::where('project_status', 'On Process')->get()->groupBy('project_date'),
            // "posts" => Project::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString()
            // $collection->take(3);
        ]);
    }
}
