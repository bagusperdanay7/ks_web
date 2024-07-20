<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Artist;
use App\Models\AIModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;

class DashboardAIModelController extends Controller
{
    // TODO: Ubah nanti saja
    // public $maxCharacterValidate = "max:191";
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
            'statuses' => Status::cases(),
            'artists' => Artist::all()->sortBy('artist_name'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'model_name' => ['required', 'max:191'],
            'url' => ['url', 'max:191'],
            'status' => ['required'],
            'audio_sample' => [File::types(['mp3', 'wav', 'mp4a'])->max('5mb')],
            'artist_id' => ['required']
        ]);

        if ($request->file('audio_sample')) {
            $validateData['audio_sample'] = $request->file('audio_sample')->store('audio/ai-models/sample');
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
            'statuses' => Status::cases(),
            'artists' => Artist::all()->sortBy('artist_name'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AIModel $aiModel)
    {
        $rules = [
            'model_name' => ['required', 'max:191'],
            'url' => ['url', 'max:191'],
            'status' => ['required'],
            'sample' => [File::types(['mp3', 'wav', 'mp4a'])->max('5mb')],
            'artist_id' => ['required']
        ];

        $validateData = $request->validate($rules);

        if ($request->file('audio_sample')) {
            if ($aiModel->audio_sample !== null) {
                Storage::delete($aiModel->audio_sample);
            }

            $validateData['audio_sample'] = $request->file('audio_sample')->store('audio/ai-models/audio_sample');
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
        if ($aiModel->audio_sample !== null) {
            Storage::delete($aiModel->audio_sample);
        }

        AIModel::destroy($aiModel->id);

        return redirect('/dashboard/ai-models')->with('success', "The Model has been deleted!");
    }
}
