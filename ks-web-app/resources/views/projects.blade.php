@extends('layouts.main')

@section('container')
    <div class="row project-header">
        <h1>Projects</h1>
        <p class="project-text">The projects we are currently working on consists of Huge Project, Nostalgic Vibes, and
            requests from Youtube comments.</p>
    </div>

    <div class="row">
        <div class="col">
            <div class="project-section">
                <h3>Upcoming Schedule</h3>
                <p>The upcoming Schedule shows what projects are coming up in a short time.</p>
                <div class="table-responsive">
                    <table class="table table-hover projects-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Project Name</th>
                                <th>Project Class</th>
                                <th>Category</th>
                                <th>Requester</th>
                                <th>Status</th>
                                <th>Progress</th>
                                <th>Votes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($projects_upcoming as $project)
                                <tr>
                                    <td class="align-middle"><i class="lar la-calendar"></i>
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $project->project_date)->format('d F Y') }}
                                    </td>
                                    <td class="align-middle">{{ $project->project_title }}</td>
                                    <td class="align-middle">{{ $project->project_class }}</td>
                                    <td class="align-middle">{{ $project->content_category->name }}</td>
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
                                            <span class="btn btn-onprocess">
                                                {{ $project->project_status }}
                                            </span>
                                        </td>
                                    @endif

                                    <td class="align-middle">{{ $project->progress }}%
                                        <div class="progress">
                                            <div class="progress-bar bg-second rounded-pill" role="progressbar"
                                                style="width: {{ $project->progress }}%;"
                                                aria-valuenow="{{ $project->progress }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">{{ $project->votes }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center no-data-val">
                                        <i class="las la-ban"></i> No Upcoming Projects
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="project-section">
                <div class="d-flex justify-content-between">
                    <h3>Huge Project Vol.#01</h3>
                    <a href="{{ route('huge-project-vol1') }}">
                        <span>Show All
                            <i class="las la-angle-right"></i>
                        </span>
                    </a>
                </div>
                <p>Huge Project Vol.#01 is a project based on Google Forms requests, where the content will be the line
                    evolution of
                    the female group of your choice.</p>
                <div class="table-responsive">
                    <table class="table table-hover projects-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Project Name</th>
                                <th>Category</th>
                                <th>Requester</th>
                                <th>Status</th>
                                <th>Votes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($huge_projects as $huge_proj)
                                <tr>
                                    <td class="align-middle"><i class="lar la-calendar"></i>
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $huge_proj->project_date)->format('d F Y') }}
                                    </td>
                                    <td class="align-middle">{{ $huge_proj->project_title }}</td>
                                    <td class="align-middle">{{ $huge_proj->content_category->name }}</td>
                                    <td class="align-middle">{{ $huge_proj->project_requester }}</td>
                                    @if ($huge_proj->project_status == 'Completed')
                                        <td class="align-middle">
                                            <span class="btn btn-complete">
                                                {{ $huge_proj->project_status }}
                                            </span>
                                        </td>
                                    @elseif ($huge_proj->project_status == 'On Process')
                                        <td class="align-middle">
                                            <span class="btn btn-onprocess">
                                                {{ $huge_proj->project_status }}
                                            </span>
                                        </td>
                                    @elseif ($huge_proj->project_status == 'Pending')
                                        <td class="align-middle">
                                            <span class="btn btn-pending">
                                                {{ $huge_proj->project_status }}
                                            </span>
                                        </td>
                                    @elseif ($huge_proj->project_status == 'Rejected')
                                        <td class="align-middle">
                                            <span class="btn btn-rejected">
                                                {{ $huge_proj->project_status }}
                                            </span>
                                        </td>
                                    @else
                                        <td class="align-middle">
                                            <span class="btn btn-onprocess">
                                                {{ $huge_proj->project_status }}
                                            </span>
                                        </td>
                                    @endif
                                    <td class="align-middle">{{ $huge_proj->votes }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center no-data-val">
                                        <i class="las la-ban"></i> No Project Found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="project-section">
                <div class="d-flex justify-content-between">
                    <h3>Nostalgic Vibes</h3>
                    <a href="{{ route('nostalgic-vibes') }}">
                        <span>Show All
                            <i class="las la-angle-right"></i>
                        </span>
                    </a>
                </div>
                <p>Nostalgic Vibes is a project that is planned to be uploaded every weekend. Where the video contains the
                    line
                    distribution of old songs.</p>
                <div class="table-responsive">
                    <table class="table table-hover projects-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Project Name</th>
                                <th>Category</th>
                                <th>Requester</th>
                                <th>Status</th>
                                <th>Votes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($nv_projects as $nv_pro)
                                <tr>
                                    <td class="align-middle"><i class="lar la-calendar"></i>
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $nv_pro->project_date)->format('d F Y') }}
                                    </td>
                                    <td class="align-middle">{{ $nv_pro->project_title }}</td>
                                    <td class="align-middle">{{ $nv_pro->content_category->name }}</td>
                                    <td class="align-middle">{{ $nv_pro->project_requester }}</td>
                                    @if ($nv_pro->project_status == 'Completed')
                                        <td class="align-middle">
                                            <span class="btn btn-complete">
                                                {{ $nv_pro->project_status }}
                                            </span>
                                        </td>
                                    @elseif ($nv_pro->project_status == 'On Process')
                                        <td class="align-middle">
                                            <span class="btn btn-onprocess">
                                                {{ $nv_pro->project_status }}
                                            </span>
                                        </td>
                                    @elseif ($nv_pro->project_status == 'Pending')
                                        <td class="align-middle">
                                            <span class="btn btn-pending">
                                                {{ $nv_pro->project_status }}
                                            </span>
                                        </td>
                                    @elseif ($nv_pro->project_status == 'Rejected')
                                        <td class="align-middle">
                                            <span class="btn btn-rejected">
                                                {{ $nv_pro->project_status }}
                                            </span>
                                        </td>
                                    @else
                                        <td class="align-middle">
                                            <span class="btn btn-onprocess">
                                                {{ $nv_pro->project_status }}
                                            </span>
                                        </td>
                                    @endif
                                    <td class="align-middle">{{ $nv_pro->votes }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center no-data-val">
                                        <i class="las la-ban"></i> No Project Found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="project-section">
                <div class="d-flex justify-content-between">
                    <h3>Youtube Comments</h3>
                    <a href="{{ route('youtube-comment') }}">
                        <span>Show All
                            <i class="las la-angle-right"></i>
                        </span>
                    </a>
                </div>
                <p>This project is retrieved from youtube comments.</p>
                <div class="table-responsive">
                    <table class="table table-hover projects-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Project Name</th>
                                <th>Category</th>
                                <th>Requester</th>
                                <th>Status</th>
                                <th>Votes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($youtube_com_projects as $you_com_pro)
                                <tr>
                                    <td class="align-middle"><i class="lar la-calendar"></i>
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $you_com_pro->project_date)->format('d F Y') }}
                                    </td>
                                    <td class="align-middle">{{ $you_com_pro->project_title }}</td>
                                    <td class="align-middle">{{ $you_com_pro->content_category->name }}</td>
                                    <td class="align-middle">{{ $you_com_pro->project_requester }}</td>
                                    @if ($you_com_pro->project_status == 'Completed')
                                        <td class="align-middle">
                                            <span class="btn btn-complete">
                                                {{ $you_com_pro->project_status }}
                                            </span>
                                        </td>
                                    @elseif ($you_com_pro->project_status == 'On Process')
                                        <td class="align-middle">
                                            <span class="btn btn-onprocess">
                                                {{ $you_com_pro->project_status }}
                                            </span>
                                        </td>
                                    @elseif ($you_com_pro->project_status == 'Pending')
                                        <td class="align-middle">
                                            <span class="btn btn-pending">
                                                {{ $you_com_pro->project_status }}
                                            </span>
                                        </td>
                                    @elseif ($you_com_pro->project_status == 'Rejected')
                                        <td class="align-middle">
                                            <span class="btn btn-rejected">
                                                {{ $you_com_pro->project_status }}
                                            </span>
                                        </td>
                                    @else
                                        <td class="align-middle">
                                            <span class="btn btn-onprocess">
                                                {{ $you_com_pro->project_status }}
                                            </span>
                                        </td>
                                    @endif
                                    <td class="align-middle">{{ $you_com_pro->votes }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center no-data-val">
                                        <i class="las la-ban"></i> No Project Found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="project-section">
                <div class="d-flex justify-content-between">
                    <h3>Non-Project</h3>
                    <a href="{{ route('non-project') }}">
                        <span>Show All
                            <i class="las la-angle-right"></i>
                        </span>
                    </a>
                </div>
                <p>Non-project Isn't based on your requests. Instead, it's based on our own desires and upcoming new
                    comeback songs from particular artists. </p>
                <div class="table-responsive">
                    <table class="table table-hover projects-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Project Name</th>
                                <th>Category</th>
                                <th>Requester</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($non_projects as $non_pro)
                                <tr>
                                    <td class="align-middle"><i class="lar la-calendar"></i>
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $non_pro->project_date)->format('d F Y') }}
                                    </td>
                                    <td class="align-middle">{{ $non_pro->project_title }}</td>
                                    <td class="align-middle">{{ $non_pro->content_category->name }}</td>
                                    <td class="align-middle">{{ $non_pro->project_requester }}</td>
                                    @if ($non_pro->project_status == 'Completed')
                                        <td class="align-middle">
                                            <span class="btn btn-complete">
                                                {{ $non_pro->project_status }}
                                            </span>
                                        </td>
                                    @elseif ($non_pro->project_status == 'On Process')
                                        <td class="align-middle">
                                            <span class="btn btn-onprocess">
                                                {{ $non_pro->project_status }}
                                            </span>
                                        </td>
                                    @elseif ($non_pro->project_status == 'Pending')
                                        <td class="align-middle">
                                            <span class="btn btn-pending">
                                                {{ $non_pro->project_status }}
                                            </span>
                                        </td>
                                    @elseif ($non_pro->project_status == 'Rejected')
                                        <td class="align-middle">
                                            <span class="btn btn-rejected">
                                                {{ $non_pro->project_status }}
                                            </span>
                                        </td>
                                    @else
                                        <td class="align-middle">
                                            <span class="btn btn-onprocess">
                                                {{ $non_pro->project_status }}
                                            </span>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center no-data-val">
                                        <i class="las la-ban"></i> No Project Found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col">
            <div class="projects-section-href text-center">
                <a href="{{ route('request-list') }}">All Request List <i class="las la-arrow-right"></i></a>
            </div>
        </div>
    </div>
@endsection
