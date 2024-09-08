<?php

namespace App\Http\Controllers;

use App\Models\ProjectType;

class ProjectTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProjectType $projectType)
    {
        if (request('status') !== null) {
            switch (request('sort')) {
                case 'title_asc':
                    $projectTypeQuery = $projectType->projects->where('status', request('status'))->sortBy('title');
                    break;
                case 'latest':
                    $projectTypeQuery = $projectType->projects->where('status', request('status'))->sortByDesc('date');
                    break;
                case 'oldest':
                    $projectTypeQuery = $projectType->projects->where('status', request('status'))->sortBy('date');
                    break;
                case 'most':
                    $projectTypeQuery = $projectType->projects->where('status', request('status'))->sortByDesc('votes');
                    break;
                case 'least':
                    $projectTypeQuery = $projectType->projects->where('status', request('status'))->sortBy('votes');
                    break;
                default:
                    $projectTypeQuery = $projectType->projects->where('status', request('status'));
                    break;
            }
        } else {
            switch (request('sort')) {
                case 'title_asc':
                    $projectTypeQuery = $projectType->projects->sortBy('title');
                    break;
                case 'latest':
                    $projectTypeQuery = $projectType->projects->sortByDesc('date');
                    break;
                case 'oldest':
                    $projectTypeQuery = $projectType->projects->sortBy('date');
                    break;
                case 'most':
                    $projectTypeQuery = $projectType->projects->sortByDesc('votes');
                    break;
                case 'least':
                    $projectTypeQuery = $projectType->projects->sortBy('votes');
                    break;
                default:
                    $projectTypeQuery = $projectType;
                    break;
            }
        }

        return view('project_types', [
            'title' => $projectType->type_name,
            'projectType' => $projectType,
            'projectTypes' => $projectTypeQuery,
        ]);
    }
}
