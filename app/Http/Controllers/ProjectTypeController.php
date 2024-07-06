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
        $projectTypeQuery = $projectType;

        if (request('status') !== null) {
            if (request('sort') === 'title_asc') {
                $projectTypeQuery = $projectType->projects->where('status', request('status'))->sortBy('project_title');
            } elseif (request('sort') == 'latest') {
                $projectTypeQuery = $projectType->projects->where('status', request('status'))->sortByDesc('date');
            } elseif (request('sort') == 'oldest') {
                $projectTypeQuery = $projectType->projects->where('status', request('status'))->sortBy('date');
            } elseif (request('sort') === 'most') {
                $projectTypeQuery = $projectType->projects->where('status', request('status'))->sortByDesc('votes')            ;
            } elseif (request('sort') === 'least') {
                $projectTypeQuery = $projectType->projects->where('status', request('status'))->sortBy('votes');
            } elseif (request('sort') === null) {
                $projectTypeQuery = $projectType->projects->where('status', request('status'));
            }
        } else {
            if (request('sort') === 'title_asc') {
                $projectTypeQuery = $projectType->projects->sortBy('project_title');
            } elseif (request('sort') == 'latest') {
                $projectTypeQuery = $projectType->projects->sortByDesc('date');
            } elseif (request('sort') == 'oldest') {
                $projectTypeQuery = $projectType->projects->sortBy('date');
            } elseif (request('sort') === 'most') {
                $projectTypeQuery = $projectType->projects->sortByDesc('votes')            ;
            } elseif (request('sort') === 'least') {
                $projectTypeQuery = $projectType->projects->sortBy('votes');
            } elseif (request('sort') === null) {
                $projectTypeQuery = $projectType;
            }
        }

        return view('project_types', [
            "title" => $projectType->type_name,
            "projectType" => $projectType,
            "projectTypes" => $projectTypeQuery,
        ]);
    }
}