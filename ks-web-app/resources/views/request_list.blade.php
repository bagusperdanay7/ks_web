@extends('layouts.main')

{{-- PHP Variabel --}}
@php
    $project_number = $projects->count();
    $project_completed_num = $projects->where('project_status', 'Completed')->count();
    $project_rejected_num = $projects->where('project_status', 'Rejected')->count();
    
    if ($project_number == 0) {
        $project_completed_progress = 0;
    } else {
        $project_completed_progress = (int) (($project_completed_num / $project_number) * 100);
    }
    
    // Youtube API
    function get_CURL($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
    
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        curl_close($curl);
    
        return json_decode($result, true);
    }
    
    $result = get_CURL('https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=UCeSgNMXPV1263WUwV-BTkIQ&key=AIzaSyDxyx9VQzYZThh3ZOwDH5Doio4_hriJEGc');
    
    $subscriber = $result['items'][0]['statistics']['subscriberCount'];
    $totalVideo = $result['items'][0]['statistics']['videoCount'];
    
    // Penutup Youtube API
    
@endphp

@section('container')
    <div class="row req-list-header">
        <div class="d-flex justify-content-between">
            <h1 class="mb-2">Request List</h1>
            @if ($project_completed_progress < 50)
                <a class="btn btn-outline-main align-self-center dis" aria-disabled="true" data-bs-toggle="tooltip"
                    data-bs-placement="bottom" data-bs-title="Sorry Couldn't Fulfill Requests Until 80% Completed">
                    <i class="las la-edit"></i> Make A
                    Request</a>
            @else
                <a href="" class="btn btn-outline-main align-self-center"><i class="las la-edit"></i> Make A
                    Request</a>
            @endif
        </div>

        <p class="project-text mb-0">Request list consists of all of your requests from Google forms and YouTube comments.
        </p>
    </div>

    <div class="row mb-5">
        <div class="col">
            <div class="card-analytics-project">
                <div class="d-flex flex-row justify-content-between">
                    <div class="card-info">
                        <div class="card-head">
                            <span>Requests</span>
                            <small>Number of Requests</small>
                        </div>
                        <h2>{{ $project_number }}</h2>
                        <small>On Google Form and Youtube</small>
                    </div>
                    <div class="card-logo align-self-center">
                        <i class="las la-clipboard-list"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card-analytics-project">
                <div class="d-flex flex-row justify-content-between">
                    <div class="card-info">
                        <div class="card-head">
                            <span>Video</span>
                            <small>Number of Videos</small>
                        </div>
                        <h2>{{ $totalVideo }}</h2>
                        <small>Uploaded On Youtube</small>
                    </div>
                    <div class="card-logo align-self-center">
                        <i class="lab la-youtube"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card-analytics-project">
                <div class="d-flex flex-row justify-content-between">
                    <div class="card-info">
                        <div class="card-head">
                            <span>Requests Completed</span>
                            <small>Number of Completed Requests</small>
                        </div>
                        <h2>{{ $project_completed_num }} / {{ $project_number }}</h2>
                        <small>Progress </small>
                    </div>
                    <div class="card-logo align-self-center">
                        <i class="las la-clipboard-check"></i>
                    </div>
                </div>
                <div class="progress rounded-pill">
                    <div class="progress-bar bg-second rounded-pill" role="progressbar"
                        style="width: {{ $project_completed_progress }}%;" aria-valuemin="0" aria-valuemax="100">
                        {{ $project_completed_progress }}%
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card-analytics-project">
                <div class="d-flex flex-row justify-content-between">
                    <div class="card-info">
                        <div class="card-head">
                            <span>Requests Rejected</span>
                            <small>Number of Rejected requests</small>
                        </div>
                        <h2>{{ $project_rejected_num }}</h2>
                        <small>From {{ $project_number }} requests</small>
                    </div>
                    <div class="card-logo align-self-center">
                        <i class="las la-comment-slash"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TODO: Bikin filter sama search aja --}}
    <div class="row">
        <div class="col">
            <div class="req-list-section">
                <ul class="nav nav-underline mb-4" id="underline-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="underline-all-req-tab" data-bs-toggle="tab"
                            data-bs-target="#underline-all-req" type="button" role="tab"
                            aria-controls="underline-all-req" aria-selected="true">All</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="underline-completed-tab" data-bs-toggle="tab"
                            data-bs-target="#underline-completed" type="button" role="tab"
                            aria-controls="underline-completed" aria-selected="false">Completed</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="underline-pending-tab" data-bs-toggle="tab"
                            data-bs-target="#underline-pending" type="button" role="tab"
                            aria-controls="underline-pending" aria-selected="false">Pending</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="underline-rejected-tab" data-bs-toggle="tab"
                            data-bs-target="#underline-rejected" type="button" role="tab"
                            aria-controls="underline-rejected" aria-selected="false">Rejected</button>
                    </li>
                </ul>

                <div class="tab-content" id="underline-tabContent">
                    <div class="tab-pane fade show active" id="underline-all-req" role="tabpanel"
                        aria-labelledby="underline-all-req-tab" tabindex="0">
                        <div class="d-flex justify-content-between">
                            <h3 class="mb-3">All Request List</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover req-list-table display" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Artis</th>
                                        <th>Project Name</th>
                                        <th>Category</th>
                                        <th>Project Class</th>
                                        <th>Requester</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($projects as $project)
                                        <tr>
                                            <td class="align-middle"><i class="lar la-calendar"></i>
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $project->project_date)->format('d F Y') }}
                                            </td>
                                            <td class="align-middle">{{ $project->artist->artist_name }}</td>
                                            <td class="align-middle">{{ $project->project_title }}</td>
                                            <td class="align-middle">{{ $project->content_category->name }}</td>
                                            <td class="align-middle">{{ $project->project_class }}</td>
                                            <td class="align-middle">{{ $project->project_requester }}</td>
                                            @if ($project->project_status == 'Completed')
                                                <td class="align-middle">
                                                    <span class="btn btn-complete">
                                                        {{ $project->project_status }}
                                                    </span>
                                                </td>
                                            @elseif ($project->project_status == 'On Process')
                                                <td class="align-middle">
                                                    <span class="btn btn-onprocess">
                                                        {{ $project->project_status }}
                                                    </span>
                                                </td>
                                            @elseif ($project->project_status == 'Pending')
                                                <td class="align-middle">
                                                    <span class="btn btn-pending">
                                                        {{ $project->project_status }}
                                                    </span>
                                                </td>
                                            @elseif ($project->project_status == 'Rejected')
                                                <td class="align-middle">
                                                    <span class="btn btn-rejected">
                                                        {{ $project->project_status }}
                                                    </span>
                                                </td>
                                            @else
                                                <td class="align-middle">
                                                    <span class="btn btn-default">
                                                        {{ $project->project_status }}
                                                    </span>
                                                </td>
                                            @endif
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center no-data-val">
                                                <i class="las la-ban"></i> No Requests Found
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{-- Untuk PAGINATION --}}
                            <div class="">
                                {{ $projects->links() }}
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="underline-completed" role="tabpanel"
                        aria-labelledby="underline-completed-tab" tabindex="0">
                        <div class="d-flex justify-content-between">
                            <h3 class="mb-3">Completed Request</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover req-list-table display" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Artis</th>
                                        <th>Project Name</th>
                                        <th>Category</th>
                                        <th>Project Class</th>
                                        <th>Requester</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($completed_projects_req as $completed_req)
                                        <tr>
                                            <td class="align-middle"><i class="lar la-calendar"></i>
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $completed_req->project_date)->format('d F Y') }}
                                            </td>
                                            <td class="align-middle">{{ $completed_req->artist->artist_name }}</td>
                                            <td class="align-middle">{{ $completed_req->project_title }}</td>
                                            <td class="align-middle">{{ $completed_req->content_category->name }}</td>
                                            <td class="align-middle">{{ $completed_req->project_class }}</td>
                                            <td class="align-middle">{{ $completed_req->project_requester }}</td>
                                            @if ($completed_req->project_status == 'Completed')
                                                <td class="align-middle">
                                                    <span class="btn btn-complete">
                                                        {{ $completed_req->project_status }}
                                                    </span>
                                                </td>
                                            @elseif ($completed_req->project_status == 'On Process')
                                                <td class="align-middle">
                                                    <span class="btn btn-onprocess">
                                                        {{ $completed_req->project_status }}
                                                    </span>
                                                </td>
                                            @elseif ($completed_req->project_status == 'Pending')
                                                <td class="align-middle">
                                                    <span class="btn btn-pending">
                                                        {{ $completed_req->project_status }}
                                                    </span>
                                                </td>
                                            @elseif ($completed_req->project_status == 'Rejected')
                                                <td class="align-middle">
                                                    <span class="btn btn-rejected">
                                                        {{ $completed_req->project_status }}
                                                    </span>
                                                </td>
                                            @else
                                                <td class="align-middle">
                                                    <span class="btn btn-default">
                                                        {{ $completed_req->project_status }}
                                                    </span>
                                                </td>
                                            @endif
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center no-data-val">
                                                <i class="las la-ban"></i> No completed requests yet
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="underline-pending" role="tabpanel"
                        aria-labelledby="underline-pending-tab" tabindex="0">
                        <div class="d-flex justify-content-between">
                            <h3 class="mb-3">Pending Request</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover req-list-table display" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Artis</th>
                                        <th>Project Name</th>
                                        <th>Category</th>
                                        <th>Project Class</th>
                                        <th>Requester</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pending_projects_req as $pending_req)
                                        <tr>
                                            <td class="align-middle"><i class="lar la-calendar"></i>
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $pending_req->project_date)->format('d F Y') }}
                                            </td>
                                            <td class="align-middle">{{ $pending_req->artist->artist_name }}</td>
                                            <td class="align-middle">{{ $pending_req->project_title }}</td>
                                            <td class="align-middle">{{ $pending_req->content_category->name }}</td>
                                            <td class="align-middle">{{ $pending_req->project_class }}</td>
                                            <td class="align-middle">{{ $pending_req->project_requester }}</td>
                                            @if ($pending_req->project_status == 'Completed')
                                                <td class="align-middle">
                                                    <span class="btn btn-complete">
                                                        {{ $pending_req->project_status }}
                                                    </span>
                                                </td>
                                            @elseif ($pending_req->project_status == 'On Process')
                                                <td class="align-middle">
                                                    <span class="btn btn-onprocess">
                                                        {{ $pending_req->project_status }}
                                                    </span>
                                                </td>
                                            @elseif ($pending_req->project_status == 'Pending')
                                                <td class="align-middle">
                                                    <span class="btn btn-pending">
                                                        {{ $pending_req->project_status }}
                                                    </span>
                                                </td>
                                            @elseif ($pending_req->project_status == 'Rejected')
                                                <td class="align-middle">
                                                    <span class="btn btn-rejected">
                                                        {{ $pending_req->project_status }}
                                                    </span>
                                                </td>
                                            @else
                                                <td class="align-middle">
                                                    <span class="btn btn-onprocess">
                                                        {{ $pending_req->project_status }}
                                                    </span>
                                                </td>
                                            @endif
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center no-data-val">
                                                <i class="las la-ban"></i> No pending requests
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="underline-rejected" role="tabpanel"
                        aria-labelledby="underline-rejected-tab" tabindex="0">
                        <h3 class="mb-2">Rejected Request</h3>
                        <p class="mb-3">The reason I rejected this, due some reasons.</p>
                        <div class="table-responsive">
                            <table class="table table-hover req-list-table display" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Artis</th>
                                        <th>Project Name</th>
                                        <th>Category</th>
                                        <th>Project Class</th>
                                        <th>Requester</th>
                                        <th>Status</th>
                                        <th>Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($rejected_projects_req as $rejected_req)
                                        <tr>
                                            <td class="align-middle"><i class="lar la-calendar"></i>
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $rejected_req->project_date)->format('d F Y') }}
                                            </td>
                                            <td class="align-middle">{{ $rejected_req->artist->artist_name }}</td>
                                            <td class="align-middle">{{ $rejected_req->project_title }}</td>
                                            <td class="align-middle">{{ $rejected_req->content_category->name }}</td>
                                            <td class="align-middle">{{ $rejected_req->project_class }}</td>
                                            <td class="align-middle">{{ $rejected_req->project_requester }}</td>
                                            @if ($rejected_req->project_status == 'Completed')
                                                <td class="align-middle">
                                                    <span class="btn btn-complete">
                                                        {{ $rejected_req->project_status }}
                                                    </span>
                                                </td>
                                            @elseif ($rejected_req->project_status == 'On Process')
                                                <td class="align-middle">
                                                    <span class="btn btn-onprocess">
                                                        {{ $rejected_req->project_status }}
                                                    </span>
                                                </td>
                                            @elseif ($rejected_req->project_status == 'Pending')
                                                <td class="align-middle">
                                                    <span class="btn btn-pending">
                                                        {{ $rejected_req->project_status }}
                                                    </span>
                                                </td>
                                            @elseif ($rejected_req->project_status == 'Rejected')
                                                <td class="align-middle">
                                                    <span class="btn btn-rejected">
                                                        {{ $rejected_req->project_status }}
                                                    </span>
                                                </td>
                                            @else
                                                <td class="align-middle">
                                                    <span class="btn btn-onprocess">
                                                        {{ $rejected_req->project_status }}
                                                    </span>
                                                </td>
                                            @endif
                                            <td class="align-middle">{{ $rejected_req->notes }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center no-data-val">
                                                <i class="las la-ban"></i> No rejected requests
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
