<?php

namespace App\Http\Controllers;

class TutorialController extends Controller
{
    public function index()
    {
        return view('tutorials.index', [
            'title' => 'Tutorials'
        ]);
    }
}
