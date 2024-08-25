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
        $modelsQuery = AIModel::orderBy('model_name')->paginate(25)->withQueryString();

        return view('ai_model', [
            "title" => "AI Models",
            "models" => $modelsQuery,
        ]);
    }
}
