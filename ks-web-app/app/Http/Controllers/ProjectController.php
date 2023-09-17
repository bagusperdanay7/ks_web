<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Project;
use App\Models\Category;
use App\Models\ProjectType;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\RedirectResponse;

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
                                    ->where('project_types.type_name', 'Youtube Comment')
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
        return view('request_form', [
            'title' => 'Form Request',
            'artists' => Artist::all()->sortBy('artist_name'),
            "categories" => Category::all()->sortBy('category_name'),
            "types" => ProjectType::all()->sortBy('type_name'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
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

        return redirect(route('request-list'))->with('success', "We have received your request, we will proceed later. Thank you");
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('project', [
            "title" => $project->project_title,
            "project" => $project
        ]);
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
        $projectAll = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
        ->where('project_types.type_name', '!=', 'Non-Project')->orderBy('project_title');

        $requestList = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
                                    ->select('projects.*', 'project_types.type_name')
                                    ->where('project_types.type_name', '!=', 'Non-Project')->orderBy('project_title')
                                    ->paginate(25, ['*'], 'requestListpage');

        $completedRequestList = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
                                    ->select('projects.*', 'project_types.type_name')
                                    ->where([['status', 'Completed'], ['project_types.type_name', '!=', 'Non-Project']])
                                    ->orderBy('project_title')
                                    ->paginate(25, ['*'], 'completedpage');

        $onProcessRequestList = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
                                    ->select('projects.*', 'project_types.type_name')
                                    ->where([['status', 'On Process'], ['project_types.type_name', '!=', 'Non-Project']])
                                    ->orderBy('project_title')
                                    ->paginate(25, ['*'], 'onprocessPage');

        $pendingRequestList = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
                                    ->select('projects.*', 'project_types.type_name')
                                    ->where([['status', 'Pending'], ['project_types.type_name', '!=', 'Non-Project']])
                                    ->orderBy('project_title')
                                    ->paginate(25, ['*'], 'pendingPage');

        $rejectedRequestList = Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
                                    ->select('projects.*', 'project_types.type_name')
                                    ->where([['status', 'Rejected'], ['project_types.type_name', '!=', 'Non-Project']])
                                    ->orderBy('project_title')
                                    ->paginate(25, ['*'], 'rejectedPage'); # add withQueryString

        $projectNumber = $projectAll->count();
        $projectCompletedNumber = $projectAll->where('status', 'Completed')->count();
        $projectRejectedNumber =  Project::join('project_types', 'project_types.id', '=', 'projects.type_id')
                                        ->where([['status', 'Rejected'], ['project_types.type_name', '!=', 'Non-Project']])
                                        ->orderBy('project_title')->count();

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
