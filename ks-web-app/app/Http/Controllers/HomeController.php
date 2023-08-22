<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index() {

        $scheduleQuery = Project::where('status', 'On Process')
                                ->get()
                                ->sortBy('date');

        return view('home', [
            "title" => "home",
            "active" => 'home',
            'schedules' => $scheduleQuery,
            // "posts" => Project::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString()
            // $collection->take(3);
        ]);
    }
}
