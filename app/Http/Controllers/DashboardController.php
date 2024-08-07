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
        // TODO: Masukkin env saja biar, idnya tidak terdeteksi
        $endPoint = 'https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=UCeSgNMXPV1263WUwV-BTkIQ&key=';

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

        if ($requestTotal === 0) {
            $progressRequests = 0;
        } else {
            $progressRequests = (int) (($completedRequestTotal / $requestTotalWithOutRejected) * 100);
        }

        return view('dashboard.analytics.index', [
            'title' => 'Dashboard',
            'requestList' => Project::where('status', 'Pending')->get()->take(10)->sortBy('date'),
            'upcomings' => Project::where('status', 'In Progress')->get()->sortBy('date'),
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
