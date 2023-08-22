@extends('layouts.main')

@section('container')
    <div class="row req-list-header">
        <div class="d-flex justify-content-between flex-column flex-md-row">
            <h1 class="mb-3 order-1">Request List</h1>
            @if ($projectCompletedProgress < 50)
                <a class="btn btn-outline-main align-self-center text-sb-18 col-12 col-md-auto dis mb-3 order-3"
                    aria-disabled="true" data-bs-toggle="tooltip" data-bs-placement="bottom"
                    data-bs-title="Sorry Couldn't Fulfill Requests Until 80% Completed">
                    <i class="las la-plus"></i> Make A
                    Request</a>
            @else
                <a href="{{ route('request-form') }}"
                    class="btn btn-outline-main align-self-center text-sb-18 col-12 col-md-auto dis mb-3 order-3"><i
                        class="las la-edit"></i> Make A
                    Request</a>
            @endif
            <p class="project-text d-md-none order-2">Request list consists of all of your requests from
                Google
                forms and
                YouTube
                comments.
            </p>
        </div>
        <p class="project-text mb-0 d-none d-md-block">Request list consists of all of your requests from Google forms
            and YouTube
            comments.
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
                        <h2>{{ $projectNumber }}</h2>
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
                        <h2>{{ $projectCompletedNumber }} / {{ $projectNumber }}</h2>
                        <small>Progress </small>
                    </div>
                    <div class="card-logo align-self-center">
                        <i class="las la-clipboard-check"></i>
                    </div>
                </div>
                <div class="progress rounded-pill">
                    <div class="progress-bar bg-main rounded-pill" role="progressbar"
                        style="width: {{ $projectCompletedProgress }}%;" aria-valuemin="0" aria-valuemax="100">
                        {{ $projectCompletedProgress }}%
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
                        <h2>{{ $projectRejectedNumber }}</h2>
                        <small>From {{ $projectNumber }} requests</small>
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
                <ul class="nav nav-underline mb-4 text-responsive" id="underline-tab" role="tablist">
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
                        <button class="nav-link" id="underline-onprocess-tab" data-bs-toggle="tab"
                            data-bs-target="#underline-onprocess" type="button" role="tab"
                            aria-controls="underline-onprocess" aria-selected="false">On Process</button>
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
                                        <th>Project Title</th>
                                        <th>Category</th>
                                        <th>Date</th>
                                        <th>Project Type</th>
                                        <th>Requester</th>
                                        <th>Status</th>
                                        <th>Votes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($projects as $project)
                                        <tr>
                                            <td class="align-middle">{{ $project->project_title }}</td>
                                            <td class="align-middle">{{ $project->category->category_name }}</td>
                                            <td class="align-middle"><i class="lar la-calendar"></i>
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $project->date)->format('d F Y') }}
                                            </td>
                                            <td class="align-middle">{{ $project->type->type_name }}</td>
                                            <td class="align-middle">{{ $project->requester }}</td>
                                            @if ($project->status == 'Completed')
                                                <td class="align-middle">
                                                    <span class="btn btn-complete">
                                                        {{ $project->status }}
                                                    </span>
                                                </td>
                                            @elseif ($project->status == 'On Process')
                                                <td class="align-middle">
                                                    <span class="btn btn-onprocess">
                                                        {{ $project->status }}
                                                    </span>
                                                </td>
                                            @elseif ($project->status == 'Pending')
                                                <td class="align-middle">
                                                    <span class="btn btn-pending">
                                                        {{ $project->status }}
                                                    </span>
                                                </td>
                                            @elseif ($project->status == 'Rejected')
                                                <td class="align-middle">
                                                    <span class="btn btn-rejected">
                                                        {{ $project->status }}
                                                    </span>
                                                </td>
                                            @else
                                                <td class="align-middle">
                                                    <span class="btn btn-default">
                                                        {{ $project->status }}
                                                    </span>
                                                </td>
                                            @endif
                                            <td class="align-middle">{{ $project->votes }}</td>
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
                                {{ $projects->onEachSide(0)->links() }}
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
                                        <th>Project Title</th>
                                        <th>Category</th>
                                        <th>Date</th>
                                        <th>Project Type</th>
                                        <th>Requester</th>
                                        <th>Status</th>
                                        <th>Votes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($completedProjects as $completedPro)
                                        <tr>
                                            <td class="align-middle">{{ $completedPro->project_title }}</td>
                                            <td class="align-middle">{{ $completedPro->category->category_name }}</td>
                                            <td class="align-middle"><i class="lar la-calendar"></i>
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $completedPro->date)->format('d F Y') }}
                                            </td>
                                            <td class="align-middle">{{ $completedPro->type->type_name }}</td>
                                            <td class="align-middle">{{ $completedPro->requester }}</td>
                                            @if ($completedPro->status == 'Completed')
                                                <td class="align-middle">
                                                    <span class="btn btn-complete">
                                                        {{ $completedPro->status }}
                                                    </span>
                                                </td>
                                            @elseif ($completedPro->status == 'On Process')
                                                <td class="align-middle">
                                                    <span class="btn btn-onprocess">
                                                        {{ $completedPro->status }}
                                                    </span>
                                                </td>
                                            @elseif ($completedPro->status == 'Pending')
                                                <td class="align-middle">
                                                    <span class="btn btn-pending">
                                                        {{ $completedPro->status }}
                                                    </span>
                                                </td>
                                            @elseif ($completedPro->status == 'Rejected')
                                                <td class="align-middle">
                                                    <span class="btn btn-rejected">
                                                        {{ $completedPro->status }}
                                                    </span>
                                                </td>
                                            @else
                                                <td class="align-middle">
                                                    <span class="btn btn-default">
                                                        {{ $completedPro->status }}
                                                    </span>
                                                </td>
                                            @endif
                                            <td class="align-middle">{{ $completedPro->votes }}</td>
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
                            <div class="">
                                {{ $completedProjects->onEachSide(0)->links() }}
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="underline-onprocess" role="tabpanel"
                        aria-labelledby="underline-onprocess-tab" tabindex="0">
                        <div class="d-flex justify-content-between">
                            <h3 class="mb-3">On Process Request</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover req-list-table display" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Project Title</th>
                                        <th>Category</th>
                                        <th>Date</th>
                                        <th>Project Type</th>
                                        <th>Requester</th>
                                        <th>Status</th>
                                        <th>Votes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($onProcessProjects as $onProcessPro)
                                        <tr>
                                            <td class="align-middle">{{ $onProcessPro->project_title }}</td>
                                            <td class="align-middle">{{ $onProcessPro->category->category_name }}</td>
                                            <td class="align-middle"><i class="lar la-calendar"></i>
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $onProcessPro->date)->format('d F Y') }}
                                            </td>
                                            <td class="align-middle">{{ $onProcessPro->type->type_name }}</td>
                                            <td class="align-middle">{{ $onProcessPro->requester }}</td>
                                            @if ($onProcessPro->status == 'Completed')
                                                <td class="align-middle">
                                                    <span class="btn btn-complete">
                                                        {{ $onProcessPro->status }}
                                                    </span>
                                                </td>
                                            @elseif ($onProcessPro->status == 'On Process')
                                                <td class="align-middle">
                                                    <span class="btn btn-onprocess">
                                                        {{ $onProcessPro->status }}
                                                    </span>
                                                </td>
                                            @elseif ($onProcessPro->status == 'Pending')
                                                <td class="align-middle">
                                                    <span class="btn btn-pending">
                                                        {{ $onProcessPro->status }}
                                                    </span>
                                                </td>
                                            @elseif ($onProcessPro->status == 'Rejected')
                                                <td class="align-middle">
                                                    <span class="btn btn-rejected">
                                                        {{ $onProcessPro->status }}
                                                    </span>
                                                </td>
                                            @else
                                                <td class="align-middle">
                                                    <span class="btn btn-default">
                                                        {{ $onProcessPro->status }}
                                                    </span>
                                                </td>
                                            @endif
                                            <td class="align-middle">{{ $onProcessPro->votes }}</td>
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
                            <div class="">
                                {{ $onProcessProjects->onEachSide(0)->links() }}
                            </div>
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
                                        <th>Project Title</th>
                                        <th>Category</th>
                                        <th>Date</th>
                                        <th>Project Type</th>
                                        <th>Requester</th>
                                        <th>Status</th>
                                        <th>Votes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pendingProjects as $pendingPro)
                                        <tr>
                                            <td class="align-middle">{{ $pendingPro->project_title }}</td>
                                            <td class="align-middle">{{ $pendingPro->category->category_name }}</td>
                                            <td class="align-middle"><i class="lar la-calendar"></i>
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $pendingPro->date)->format('d F Y') }}
                                            </td>
                                            <td class="align-middle">{{ $pendingPro->type->type_name }}</td>
                                            <td class="align-middle">{{ $pendingPro->requester }}</td>
                                            @if ($pendingPro->status == 'Completed')
                                                <td class="align-middle">
                                                    <span class="btn btn-complete">
                                                        {{ $pendingPro->status }}
                                                    </span>
                                                </td>
                                            @elseif ($pendingPro->status == 'On Process')
                                                <td class="align-middle">
                                                    <span class="btn btn-onprocess">
                                                        {{ $pendingPro->status }}
                                                    </span>
                                                </td>
                                            @elseif ($pendingPro->status == 'Pending')
                                                <td class="align-middle">
                                                    <span class="btn btn-pending">
                                                        {{ $pendingPro->status }}
                                                    </span>
                                                </td>
                                            @elseif ($pendingPro->status == 'Rejected')
                                                <td class="align-middle">
                                                    <span class="btn btn-rejected">
                                                        {{ $pendingPro->status }}
                                                    </span>
                                                </td>
                                            @else
                                                <td class="align-middle">
                                                    <span class="btn btn-onprocess">
                                                        {{ $pendingPro->status }}
                                                    </span>
                                                </td>
                                            @endif
                                            <td class="align-middle">{{ $pendingPro->votes }}</td>
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
                            <div class="">
                                {{ $pendingProjects->onEachSide(0)->links() }}
                            </div>
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
                                        <th>Project Title</th>
                                        <th>Category</th>
                                        <th>Date</th>
                                        <th>Project Type</th>
                                        <th>Requester</th>
                                        <th>Status</th>
                                        <th>Votes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($rejectedProjects as $rejectedPro)
                                        <tr>
                                            <td class="align-middle">{{ $rejectedPro->project_title }}</td>
                                            <td class="align-middle">{{ $rejectedPro->category->category_name }}</td>
                                            <td class="align-middle"><i class="lar la-calendar"></i>
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $rejectedPro->date)->format('d F Y') }}
                                            </td>
                                            <td class="align-middle">{{ $rejectedPro->type->type_name }}</td>
                                            <td class="align-middle">{{ $rejectedPro->requester }}</td>
                                            @if ($rejectedPro->status == 'Completed')
                                                <td class="align-middle">
                                                    <span class="btn btn-complete">
                                                        {{ $rejectedPro->status }}
                                                    </span>
                                                </td>
                                            @elseif ($rejectedPro->status == 'On Process')
                                                <td class="align-middle">
                                                    <span class="btn btn-onprocess">
                                                        {{ $rejectedPro->status }}
                                                    </span>
                                                </td>
                                            @elseif ($rejectedPro->status == 'Pending')
                                                <td class="align-middle">
                                                    <span class="btn btn-pending">
                                                        {{ $rejectedPro->status }}
                                                    </span>
                                                </td>
                                            @elseif ($rejectedPro->status == 'Rejected')
                                                <td class="align-middle">
                                                    <span class="btn btn-rejected">
                                                        {{ $rejectedPro->status }}
                                                    </span>
                                                </td>
                                            @else
                                                <td class="align-middle">
                                                    <span class="btn btn-onprocess">
                                                        {{ $rejectedPro->status }}
                                                    </span>
                                                </td>
                                            @endif
                                            <td class="align-middle">{{ $rejectedPro->votes }}</td>
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
                            <div class="">
                                {{ $rejectedProjects->onEachSide(0)->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
