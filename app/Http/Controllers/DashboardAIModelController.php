<?php

namespace App\Http\Controllers;

use App\Models\AIModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class DashboardAIModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.ai_models.index', [
            'title' => 'AI Models Table',
            'aiModels' => AIModel::orderBy('model_name')->paginate(50),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.ai_models.create', [
            'title' => 'Create AI Model',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'model_name' => 'required|max:191',
            'cover_model' => [File::image()->max('1mb')],
            'url' => 'url|max:191',
            'status' => 'required|max:10' ,
            'sample' => [File::types(['mp3', 'wav', 'mp4a'])->max('5mb')],
        ]);

        if ($request->file('cover_model')) {
            $validateData['cover_model'] = $request->file('cover_model')->store('img/ai-models/cover');
        }

        if ($request->file('sample')) {
            $validateData['sample'] = $request->file('sample')->store('audio/ai-models/sample');
        }

        $validateData['description'] = strip_tags($request->description);

        AIModel::create($validateData);

        return redirect('/dashboard/ai-models')->with('success', "New AI Model has been created!");
    }

    /**
     * Display the specified resource.
     */
    public function show(AIModel $aiModel)
    {
        return view('dashboard.ai_models.show', [
            'title' => $aiModel->model_name,
            'aiModel' => $aiModel,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AIModel $aiModel)
    {
        return view('dashboard.ai_models.edit', [
            'title' => 'Update AI Model',
            'aiModel' => $aiModel,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AIModel $aiModel)
    {
        $rules = [
            'model_name' => 'required|max:191',
            'cover_model' => [File::image()->max('1mb')],
            'url' => 'url|max:191',
            'status' => 'required|max:10' ,
            'sample' => [File::types(['mp3', 'wav', 'mp4a'])->max('5mb')],
        ];

        $validateData = $request->validate($rules);

        if ($request->file('cover_model')) {
            if($aiModel->cover_model !== null) {
                Storage::delete($aiModel->cover_model);
            }

            $validateData['cover_model'] = $request->file('cover_model')->store('img/ai-models/cover');
        }

        if ($request->file('sample')) {
            if($aiModel->sample !== null) {
                Storage::delete($aiModel->sample);
            }

            $validateData['sample'] = $request->file('sample')->store('audio/ai-models/sample');
        }

        $validateData['description'] = strip_tags($request->description);

        AIModel::where('id', $aiModel->id)->update($validateData);

        return redirect('/dashboard/ai-models')->with('success', "The AI Model has been updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AIModel $aiModel)
    {
        if($aiModel->cover_model !== null) {
            Storage::delete($aiModel->cover_model);
        }

        if($aiModel->sample !== null) {
            Storage::delete($aiModel->sample);
        }

        AIModel::destroy($aiModel->id);

        return redirect('/dashboard/ai-models')->with('success', "The Model has been deleted!");
    }
}
