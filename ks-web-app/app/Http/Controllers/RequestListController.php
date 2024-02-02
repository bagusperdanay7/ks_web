<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PublicAPIController;
use App\Models\Artist;
use App\Models\Project;
use App\Models\Category;
use App\Models\ProjectType;
use App\Mail\RequestProcessed;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class RequestListController extends Controller
{
    public function index()
    {
        // $channelResult = $this->getYoutubeAPICURL('https://youtube.googleapis.com/youtube/v3/channels?part=snippet%2CcontentDetails%2Cstatistics&forUsername=' . request('') . '&prettyPrint=true&key=[YOUR_API_KEY]' . $apiKey);
        $endPoint = "https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=UCeSgNMXPV1263WUwV-BTkIQ&key=";
        $fetchApiResult = PublicAPIController::getYoutubeChannelStatistics($endPoint . env('GOOGLE_API_KEY'));
        $subscriber = $fetchApiResult['items'][0]['statistics']['subscriberCount'];
        $totalVideo = $fetchApiResult['items'][0]['statistics']['videoCount'];

        $allRequestProject = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
            ->where('project_types.type_name', '!=', 'Non-Project')->get();

        $requestListTitle = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
            ->where('project_types.type_name', '!=', 'Non-Project')
            ->orderBy('project_title')->get('project_title');

        $requestList = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
            ->select('*', 'projects.id as project_id')
            ->where('project_types.type_name', '!=', 'Non-Project')
            ->filter(request(['search', 'category', 'type']))
            ->paginate(25, ['*'], 'requestListpage')->withQueryString();

        if (request('status') !== null) {
            if (request('sort') == 'title_asc') {
                $requestList = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
                    ->select('*', 'projects.id as project_id')
                    ->where([['project_types.type_name', '!=', 'Non-Project'], ['status', request('status')]])
                    ->orderBy('project_title')
                    ->filter(request(['search', 'category', 'type']))
                    ->paginate(25, ['*'], 'requestListpage')->withQueryString();
            } elseif (request('sort') == 'oldest') {
                $requestList = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
                    ->select('*', 'projects.id as project_id')
                    ->where([['project_types.type_name', '!=', 'Non-Project'], ['status', request('status')]])
                    ->orderBy('date')
                    ->filter(request(['search', 'category', 'type']))
                    ->paginate(25, ['*'], 'requestListpage')->withQueryString();
            } elseif (request('sort') == 'latest') {
                $requestList = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
                    ->select('*', 'projects.id as project_id')
                    ->where([['project_types.type_name', '!=', 'Non-Project'], ['status', request('status')]])
                    ->orderByDesc('date')
                    ->filter(request(['search', 'category', 'type']))
                    ->paginate(25, ['*'], 'requestListpage')->withQueryString();
            } elseif (request('sort') == 'least') {
                $requestList = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
                    ->select('*', 'projects.id as project_id')
                    ->where([['project_types.type_name', '!=', 'Non-Project'], ['status', request('status')]])
                    ->orderBy('votes')
                    ->filter(request(['search', 'category', 'type']))
                    ->paginate(25, ['*'], 'requestListpage')->withQueryString();
            } elseif (request('sort') == 'most') {
                $requestList = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
                    ->select('*', 'projects.id as project_id')
                    ->where([['project_types.type_name', '!=', 'Non-Project'], ['status', request('status')]])
                    ->orderByDesc('votes')
                    ->filter(request(['search', 'category', 'type']))
                    ->paginate(25, ['*'], 'requestListpage')->withQueryString();
            } else {
                $requestList = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
                    ->select('*', 'projects.id as project_id')
                    ->where([['project_types.type_name', '!=', 'Non-Project'], ['status', request('status')]])
                    ->filter(request(['search', 'category', 'type']))
                    ->paginate(25, ['*'], 'requestListpage')->withQueryString();
            }
        } else {
            if (request('sort') == 'title_asc') {
                $requestList = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
                    ->select('*', 'projects.id as project_id')
                    ->where('project_types.type_name', '!=', 'Non-Project')
                    ->orderBy('project_title')
                    ->filter(request(['search', 'category', 'type']))
                    ->paginate(25, ['*'], 'requestListpage')->withQueryString();
            } elseif (request('sort') == 'oldest') {
                $requestList = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
                    ->select('*', 'projects.id as project_id')
                    ->where('project_types.type_name', '!=', 'Non-Project')
                    ->orderBy('date')
                    ->filter(request(['search', 'category', 'type']))
                    ->paginate(25, ['*'], 'requestListpage')->withQueryString();
            } elseif (request('sort') == 'latest') {
                $requestList = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
                    ->select('*', 'projects.id as project_id')
                    ->where('project_types.type_name', '!=', 'Non-Project')
                    ->orderByDesc('date')
                    ->filter(request(['search', 'category', 'type']))
                    ->paginate(25, ['*'], 'requestListpage')->withQueryString();
            } elseif (request('sort') == 'least') {
                $requestList = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
                    ->select('*', 'projects.id as project_id')
                    ->where('project_types.type_name', '!=', 'Non-Project')
                    ->orderBy('votes')
                    ->filter(request(['search', 'category', 'type']))
                    ->paginate(25, ['*'], 'requestListpage')->withQueryString();
            } elseif (request('sort') == 'most') {
                $requestList = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
                    ->select('*', 'projects.id as project_id')
                    ->where('project_types.type_name', '!=', 'Non-Project')
                    ->orderByDesc('votes')
                    ->filter(request(['search', 'category', 'type']))
                    ->paginate(25, ['*'], 'requestListpage')->withQueryString();
            }
        }

        $projectNumber = $allRequestProject->count();
        $projectNumberWithOutRejected = $allRequestProject->where('status', '!=', 'Rejected')->count();
        $projectCompletedNumber = $allRequestProject->where('status', 'Completed')->count();
        $projectRejectedNumber =  Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
            ->where([['status', 'Rejected'], ['project_types.type_name', '!=', 'Non-Project']])
            ->orderBy('project_title')->count();

        if ($projectNumber == 0) {
            $projectCompletedProgress = 0;
        } else {
            $projectCompletedProgress = (int) (($projectCompletedNumber / $projectNumberWithOutRejected) * 100);
        }

        $allCategoryQuery = Category::all()->sortBy('category_name');

        $allTypeQuery = ProjectType::all()->except(['id', '1'])->sortBy('type_name');


        return view('request_list', [
            'title' => 'Request List',
            'active' => 'request_list',
            'subscriber' => $subscriber,
            'totalVideo' => $totalVideo,
            'projects' => $requestList,
            'projectNumber' => $projectNumber,
            'projectCompletedNumber' => $projectCompletedNumber,
            'projectRejectedNumber' => $projectRejectedNumber,
            'projectCompletedProgress' => $projectCompletedProgress,
            'numberRequestWithOutRejected' => $projectNumberWithOutRejected,
            'categories' => $allCategoryQuery,
            'types' => $allTypeQuery,
            'allProjectTitle' => $requestListTitle,
        ]);
    }

    public function create()
    {
        return view('request_form', [
            'title' => 'Form Request',
            'artists' => Artist::orderBy('artist_name')->get(),
            "categories" => Category::orderBy('category_name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validateData = $request->validate([
            'artist_id' => 'required',
            'category_id' => 'required',
            'project_title' => 'required|max:191',
            'requester' => 'required|max:191',
        ]);

        $validateData['notes'] = strip_tags($request->notes);
        $validateData['type_id'] = 1;
        $validateData['votes'] = 1;

        Project::create($validateData);

        $project = Project::latest()->first();

        // return (new RequestProcessed($project))->render(); #debug html
        Mail::to($request->user())->send(new RequestProcessed($project));

        return redirect(route('request-list'))->with('requestSuccess', "We have received your request, we will proceed later. Check your email for further information about your request. Thank you");
    }
}
