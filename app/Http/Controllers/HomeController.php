<?php

namespace App\Http\Controllers;

use App\Models\Project;

class HomeController extends Controller
{

    public function index()
    {

        $scheduleQuery = Project::where('status', 'In Progress')
            ->get()
            ->sortBy('date');

        return view('home', [
            "title" => "Home",
            'schedules' => $scheduleQuery,
        ]);
    }
}
