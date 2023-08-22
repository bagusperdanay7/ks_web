<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\ProjectType;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {

        $hugeProjectsQuery = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
                                    ->where('project_types.type_name', 'Huge Project Vol.#01')
                                    ->limit(10)
                                    ->get();

        $nostalgicVibesQuery = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
                                    ->where('project_types.type_name', 'Nostalgic Vibes')
                                    ->limit(10)
                                    ->get();

        $youtubeCommentQuery = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
                                    ->where('project_types.type_name', 'Nostalgic Vibes')
                                    ->limit(10)
                                    ->get();
                                    
        $nonProjectQuery = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
                                    ->where('project_types.type_name', 'Non-Project')
                                    ->limit(10)
                                    ->get();

        return view('projects', [
            "title" => "All Projects",
            "active" => "projects",
            "projectsUpcoming" => Project::where('status', 'On Process')->get()->sortBy('date'),
            "nonProjectType" => ProjectType::all()->find(1),
            "hugeProjectType" => ProjectType::all()->find(2),
            "nostalgicVibesType" => ProjectType::all()->find(3),
            "youtubeCommentType" => ProjectType::all()->find(4),
            "hugeProjects" => $hugeProjectsQuery,
            "nostalgicVibesProjects" => $nostalgicVibesQuery,
            "youtubeCommentProjects" => $youtubeCommentQuery,
            "nonProjects" => $nonProjectQuery,
            // "posts" => Project::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString()
            // $collection->take(3);
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
    public function store(StoreProjectRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }

    public function huge_project_vol1()
    {
        return view('projects.huge_project_vol1', [
            "title" => "Huge Project Vol.#01",
            "active" => 'huge_project_vol1',
            'hugeProjects' => Project::where('project_class', 'Huge Project Vol.#01')->get(),
        ]);
    }

    public function nostalgic_vibes()
    {
        return view('projects.nostalgic_vibes', [
            "title" => "Nostalgic Vibes",
            "active" => 'nostalgic_vibes',
            'nostalgicVibes' => Project::where('project_class', 'Nostalgic Vibes')->get(),
        ]);
    }

    public function youtube_comment()
    {
        return view('projects.youtube_comment', [
            "title" => "Youtube Comment",
            "active" => 'youtube_comment',
            'youtubeCommentProjects' => Project::where('project_class', 'Youtube Comments')->get(),
        ]);
    }

    public function non_project()
    {
        return view('projects.non-project', [
            "title" => "Non-Project",
            "active" => 'non_project',
            'nonProjects' => Project::where('project_class', 'Non-Project')->get(),
        ]);
    }

    public function getYoutubeAPICURL($url) {

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        curl_close($curl);
    
        return json_decode($result, true);
    }
    
    public function request_list()
    {
        // Youtube API Call
        $apiKey = 'AIzaSyC9X67kK6KirTPzzxrodASGpum3eyXbQcA';
        

        $fetchApiResult = $this->getYoutubeAPICURL('https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=UCeSgNMXPV1263WUwV-BTkIQ&key=' . $apiKey);

        // $channelResult = $this->getYoutubeAPICURL('https://youtube.googleapis.com/youtube/v3/channels?part=snippet%2CcontentDetails%2Cstatistics&forUsername=' . request('') . '&prettyPrint=true&key=[YOUR_API_KEY]' . $apiKey);
        
        $subscriber = $fetchApiResult['items'][0]['statistics']['subscriberCount'];
        $totalVideo = $fetchApiResult['items'][0]['statistics']['videoCount'];

        // Penutup Youtube API

        $requestList = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
                                    ->where('project_types.type_name', '!=', 'Non-Project')->orderBy('project_title')
                                    ->paginate(25, ['*'], 'requestListpage');

        $completedRequestList = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
                                    ->where([['status', 'Completed'], ['project_types.type_name', '!=', 'Non-Project']])
                                    ->orderBy('project_title')
                                    ->paginate(25, ['*'], 'completedpage');

        $onProcessRequestList = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
                                    ->where([['status', 'On Process'], ['project_types.type_name', '!=', 'Non-Project']])
                                    ->orderBy('project_title')
                                    ->paginate(25, ['*'], 'onprocessPage');

        $pendingRequestList = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
                                    ->where([['status', 'Pending'], ['project_types.type_name', '!=', 'Non-Project']])
                                    ->orderBy('project_title')
                                    ->paginate(25, ['*'], 'pendingPage');

        $rejectedRequestList = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
                                    ->where([['status', 'Rejected'], ['project_types.type_name', '!=', 'Non-Project']])
                                    ->orderBy('project_title')
                                    ->paginate(25, ['*'], 'rejectedPage'); # add withQueryString

        $projectNumber = $requestList->count();
        $projectCompletedNumber = $requestList->where('status', 'Completed')->count();
        $projectRejectedNumber = $requestList->where('status', 'Rejected')->count();

        if ($projectNumber == 0) {
            $projectCompletedProgress = 0;
        } else {
            $projectCompletedProgress = (int) (($projectCompletedNumber / $projectNumber) * 100);
        }

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
            'completedProjects' => $completedRequestList,
            'onProcessProjects' => $onProcessRequestList,
            'pendingProjects' => $pendingRequestList,
            'rejectedProjects' => $rejectedRequestList,
        ]);
    }
}
