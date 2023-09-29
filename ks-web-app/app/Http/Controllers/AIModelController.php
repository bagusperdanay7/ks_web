<?php

namespace App\Http\Controllers;

use App\Models\AIModel;
use App\Http\Requests\StoreAIModelRequest;
use App\Http\Requests\UpdateAIModelRequest;

class AIModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modelsQuery = AIModel::orderBy('model_name')->paginate(50);

        return view('ai_model', [
            "title" => "AI Models" ,
            "models" => $modelsQuery,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAIModelRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AIModel $aIModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AIModel $aIModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAIModelRequest $request, AIModel $aIModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AIModel $aIModel)
    {
        //
    }
}
