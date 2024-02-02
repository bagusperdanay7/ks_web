<?php

namespace App\Http\Controllers;

use App\Models\AIModel;

class AIModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
<<<<<<< HEAD
        $modelsQuery = AIModel::orderBy('model_name')->paginate(25)->withQueryString();
=======
        $modelsQuery = AIModel::orderBy('model_name')->paginate(25);
>>>>>>> f18853d370fd6012683fb0fcdcc189fe71f044e4

        return view('ai_model', [
            "title" => "AI Models" ,
            "models" => $modelsQuery,
        ]);
    }
}
