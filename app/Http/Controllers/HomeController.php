<?php

namespace App\Http\Controllers;

use App\Models\Project;

class HomeController extends Controller
{
    
    public function index() {

        $scheduleQuery = Project::where('status', 'On Process')
                                ->get()
                                ->sortBy('date');

        return view('home', [
            "title" => "Home",
            'schedules' => $scheduleQuery,
        ]);
    }
}
