<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        return view('dashboard.index', [
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'requestList' => Project::where('status', 'Pending')->get()->take(10)->sortBy('date'),
            'upcomings' => Project::where('status', 'On Process')->get()->sortBy('date'),
        ]);
    }
}
