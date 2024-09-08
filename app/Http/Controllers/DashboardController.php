<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\ProjectType;

class DashboardController extends Controller
{
    public function index()
    {
        // $this->authorize('admin'); #pake gate untuk contoh
        $endPoint = 'https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=' . env('YOUTUBE_ID') . '&key=';

        $fetchApiResult = PublicAPIController::getYoutubeChannelStatistics($endPoint . env('GOOGLE_API_KEY'));

        $totalVideo = $fetchApiResult['items'][0]['statistics']['videoCount'];

        $requestTotal = Project::join('project_types', 'project_types.id', '=', 'projects.project_type_id')
            ->where('project_types.type_name', '!=', 'Non-Project')
            ->count();

        $completedRequestTotal = Project::join('project_types', 'project_types.id', '=', 'projects.project_type_id')
            ->where([['status', 'Completed'], ['project_types.type_name', '!=', 'Non-Project']])
            ->count();

        $rejectedRequestTotal = Project::join('project_types', 'project_types.id', '=', 'projects.project_type_id')
            ->where([['status', 'Rejected'], ['project_types.type_name', '!=', 'Non-Project']])
            ->count();

        $requestTotalWithOutRejected = Project::join('project_types', 'project_types.id', '=', 'projects.project_type_id')
            ->where([['project_types.type_name', '!=', 'Non-Project'], ['status', '!=', 'Rejected']])
            ->count();

        $allTypes = ProjectType::all()->load('projects');

        $typesProgress = Project::join('project_types', 'project_types.id', '=', 'projects.project_type_id')->get()->groupBy('type_name');

        $allCategory = Category::all()->load('projects');

        $requestTotal === 0 ? $progressRequests = 0
            : $progressRequests = (int) (($completedRequestTotal / $requestTotalWithOutRejected) * 100);

        return view('dashboard.analytics.index', [
            'title' => 'Dashboard',
            'requestList' => Project::where('status', 'Pending')->orderBy('date')->take(10)->get(),
            'upcomings' => Project::where('status', 'In Progress')->orderBy('date')->take(5)->get(),
            'totalVideo' => $totalVideo,
            'requests' => $requestTotal,
            'completedRequests' => $completedRequestTotal,
            'rejectedRequests' => $rejectedRequestTotal,
            'numberRequestWithOutRejected' => $requestTotalWithOutRejected,
            'progress' => $progressRequests,
            'types' => $allTypes,
            'typeProgress' => $typesProgress,
            'categories' => $allCategory
        ]);
    }
}
