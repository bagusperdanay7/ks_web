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
                            @forelse ($projectsUpcoming as $project)
                                <tr>
                                    <td class="align-middle title-with-progress">
                                        <div>
                                            <div class="d-flex justify-content-between text-sb-14">
                                                <p class="p-0 m-0">
                                                    {{ $project->project_title }}
                                                </p>
                                                <span class="p-0 m-0 ">
                                                    {{ $project->progress }}%
                                                </span>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar bg-second rounded-pill" role="progressbar"
                                                    style="width: {{ $project->progress }}%;"
                                                    aria-valuenow="{{ $project->progress }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    @if ($project->category->category_name === 'Line Distribution')
                                        <td class="align-middle category-text-ld">{{ $project->category->category_name }}
                                        </td>
                                    @elseif ($project->category->category_name === 'Line Evolution')
                                        <td class="align-middle category-text-le">{{ $project->category->category_name }}
                                        </td>
                                    @elseif ($project->category->category_name === 'Album Distribution')
                                        <td class="align-middle category-text-ad">{{ $project->category->category_name }}
                                        </td>
                                    @elseif ($project->category->category_name === 'Album Evolution')
                                        <td class="align-middle category-text-ae">{{ $project->category->category_name }}
                                        </td>
                                    @elseif ($project->category->category_name === 'Ranking Battle')
                                        <td class="align-middle category-text-rb">{{ $project->category->category_name }}
                                        </td>
                                    @elseif ($project->category->category_name === 'How Should')
                                        <td class="align-middle category-text-hs">{{ $project->category->category_name }}
                                        </td>
                                    @elseif ($project->category->category_name === 'How Would')
                                        <td class="align-middle category-text-hw">{{ $project->category->category_name }}
                                        </td>
                                    @elseif ($project->category->category_name === 'Center Distribution')
                                        <td class="align-middle category-text-cd">{{ $project->category->category_name }}
                                        </td>
                                    @endif
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
                                            <span class="btn btn-onprocess">
                                                {{ $project->status }}
                                            </span>
                                        </td>
                                    @endif
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
                    <h3>{{ $nonProjectType->type_name }}</h3>
                </div>
                <p>{{ $nonProjectType->about }}</p>

                <div class="table-responsive mb-2">
                    <table class="table table-hover projects-table">
                        <thead>
                            <tr>
                                <th>Project Title</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Requester</th>
                                <th>Status</th>
                                <th>Votes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($nonProjects as $nonProject)
                                <tr>
                                    <td class="align-middle">{{ $nonProject->project_title }}</td>
                                    @if ($nonProject->category->category_name === 'Line Distribution')
                                        <td class="align-middle category-text-ld">
                                            {{ $nonProject->category->category_name }}
                                        </td>
                                    @elseif ($nonProject->category->category_name === 'Line Evolution')
                                        <td class="align-middle category-text-le">
                                            {{ $nonProject->category->category_name }}
                                        </td>
                                    @elseif ($nonProject->category->category_name === 'Album Distribution')
                                        <td class="align-middle category-text-ad">
                                            {{ $nonProject->category->category_name }}
                                        </td>
                                    @elseif ($nonProject->category->category_name === 'Album Evolution')
                                        <td class="align-middle category-text-ae">
                                            {{ $nonProject->category->category_name }}
                                        </td>
                                    @elseif ($nonProject->category->category_name === 'Ranking Battle')
                                        <td class="align-middle category-text-rb">
                                            {{ $nonProject->category->category_name }}
                                        </td>
                                    @elseif ($nonProject->category->category_name === 'How Should')
                                        <td class="align-middle category-text-hs">
                                            {{ $nonProject->category->category_name }}
                                        </td>
                                    @elseif ($nonProject->category->category_name === 'How Would')
                                        <td class="align-middle category-text-hw">
                                            {{ $nonProject->category->category_name }}
                                        </td>
                                    @elseif ($nonProject->category->category_name === 'Center Distribution')
                                        <td class="align-middle category-text-cd">
                                            {{ $nonProject->category->category_name }}
                                        </td>
                                    @endif
                                    <td class="align-middle"><i class="lar la-calendar"></i>
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $nonProject->date)->format('d F Y') }}
                                    </td>
                                    <td class="align-middle">{{ $nonProject->requester }}</td>
                                    @if ($nonProject->status == 'Completed')
                                        <td class="align-middle">
                                            <span class="btn btn-complete">
                                                {{ $nonProject->status }}
                                            </span>
                                        </td>
                                    @elseif ($nonProject->status == 'On Process')
                                        <td class="align-middle">
                                            <span class="btn btn-onprocess">
                                                {{ $nonProject->status }}
                                            </span>
                                        </td>
                                    @elseif ($nonProject->status == 'Pending')
                                        <td class="align-middle">
                                            <span class="btn btn-pending">
                                                {{ $nonProject->status }}
                                            </span>
                                        </td>
                                    @elseif ($nonProject->status == 'Rejected')
                                        <td class="align-middle">
                                            <span class="btn btn-rejected">
                                                {{ $nonProject->status }}
                                            </span>
                                        </td>
                                    @else
                                        <td class="align-middle">
                                            <span class="btn btn-onprocess">
                                                {{ $nonProject->status }}
                                            </span>
                                        </td>
                                    @endif
                                    <td class="align-middle">{{ $nonProject->votes }}</td>
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
                <div class="d-flex justify-content-center align-items-center">
                    <a href="{{ route('non-project') }}" class="link-show-all text-decoration-none text-mdm-14">Show
                        All <i class="las la-arrow-right"> </i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="project-section">
                <div class="d-flex justify-content-between">
                    <h3>{{ $hugeProjectType->type_name }}</h3>
                </div>
                <p>{{ $hugeProjectType->about }}</p>
                <div class="table-responsive">
                    <table class="table table-hover projects-table">
                        <thead>
                            <tr>
                                <th>Project Title</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Requester</th>
                                <th>Status</th>
                                <th>Votes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($hugeProjects as $hugeProj)
                                <tr>
                                    <td class="align-middle">{{ $hugeProj->project_title }}</td>
                                    @if ($hugeProj->category->category_name === 'Line Distribution')
                                        <td class="align-middle category-text-ld">{{ $hugeProj->category->category_name }}
                                        </td>
                                    @elseif ($hugeProj->category->category_name === 'Line Evolution')
                                        <td class="align-middle category-text-le">{{ $hugeProj->category->category_name }}
                                        </td>
                                    @elseif ($hugeProj->category->category_name === 'Album Distribution')
                                        <td class="align-middle category-text-ad">{{ $hugeProj->category->category_name }}
                                        </td>
                                    @elseif ($hugeProj->category->category_name === 'Album Evolution')
                                        <td class="align-middle category-text-ae">{{ $hugeProj->category->category_name }}
                                        </td>
                                    @elseif ($hugeProj->category->category_name === 'Ranking Battle')
                                        <td class="align-middle category-text-rb">{{ $hugeProj->category->category_name }}
                                        </td>
                                    @elseif ($hugeProj->category->category_name === 'How Should')
                                        <td class="align-middle category-text-hs">{{ $hugeProj->category->category_name }}
                                        </td>
                                    @elseif ($hugeProj->category->category_name === 'How Would')
                                        <td class="align-middle category-text-hw">{{ $hugeProj->category->category_name }}
                                        </td>
                                    @elseif ($hugeProj->category->category_name === 'Center Distribution')
                                        <td class="align-middle category-text-cd">{{ $hugeProj->category->category_name }}
                                        </td>
                                    @endif
                                    <td class="align-middle"><i class="lar la-calendar"></i>
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $hugeProj->date)->format('d F Y') }}
                                    </td>
                                    <td class="align-middle">{{ $hugeProj->requester }}</td>
                                    @if ($hugeProj->status == 'Completed')
                                        <td class="align-middle">
                                            <span class="btn btn-complete">
                                                {{ $hugeProj->status }}
                                            </span>
                                        </td>
                                    @elseif ($hugeProj->status == 'On Process')
                                        <td class="align-middle">
                                            <span class="btn btn-onprocess">
                                                {{ $hugeProj->status }}
                                            </span>
                                        </td>
                                    @elseif ($hugeProj->status == 'Pending')
                                        <td class="align-middle">
                                            <span class="btn btn-pending">
                                                {{ $hugeProj->status }}
                                            </span>
                                        </td>
                                    @elseif ($hugeProj->status == 'Rejected')
                                        <td class="align-middle">
                                            <span class="btn btn-rejected">
                                                {{ $hugeProj->status }}
                                            </span>
                                        </td>
                                    @else
                                        <td class="align-middle">
                                            <span class="btn btn-onprocess">
                                                {{ $hugeProj->status }}
                                            </span>
                                        </td>
                                    @endif
                                    <td class="align-middle">{{ $hugeProj->votes }}</td>
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
                <div class="d-flex justify-content-center align-items-center">
                    <a href="{{ route('huge-project-vol1') }}"
                        class="link-show-all text-decoration-none text-mdm-14">Show
                        All <i class="las la-arrow-right"> </i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="project-section">
                <div class="d-flex justify-content-between">
                    <h3>{{ $nostalgicVibesType->type_name }}</h3>
                </div>
                <p>{{ $nostalgicVibesType->about }}</p>
                <div class="table-responsive">
                    <table class="table table-hover projects-table">
                        <thead>
                            <tr>
                                <th>Project Title</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Requester</th>
                                <th>Status</th>
                                <th>Votes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($nostalgicVibesProjects as $nostalgicVibesProj)
                                <tr>
                                    <td class="align-middle">{{ $nostalgicVibesProj->project_title }}</td>
                                    @if ($nostalgicVibesProj->category->category_name === 'Line Distribution')
                                        <td class="align-middle category-text-ld">
                                            {{ $nostalgicVibesProj->category->category_name }}
                                        </td>
                                    @elseif ($nostalgicVibesProj->category->category_name === 'Line Evolution')
                                        <td class="align-middle category-text-le">
                                            {{ $nostalgicVibesProj->category->category_name }}
                                        </td>
                                    @elseif ($nostalgicVibesProj->category->category_name === 'Album Distribution')
                                        <td class="align-middle category-text-ad">
                                            {{ $nostalgicVibesProj->category->category_name }}
                                        </td>
                                    @elseif ($nostalgicVibesProj->category->category_name === 'Album Evolution')
                                        <td class="align-middle category-text-ae">
                                            {{ $nostalgicVibesProj->category->category_name }}
                                        </td>
                                    @elseif ($nostalgicVibesProj->category->category_name === 'Ranking Battle')
                                        <td class="align-middle category-text-rb">
                                            {{ $nostalgicVibesProj->category->category_name }}
                                        </td>
                                    @elseif ($nostalgicVibesProj->category->category_name === 'How Should')
                                        <td class="align-middle category-text-hs">
                                            {{ $nostalgicVibesProj->category->category_name }}
                                        </td>
                                    @elseif ($nostalgicVibesProj->category->category_name === 'How Would')
                                        <td class="align-middle category-text-hw">
                                            {{ $nostalgicVibesProj->category->category_name }}
                                        </td>
                                    @elseif ($nostalgicVibesProj->category->category_name === 'Center Distribution')
                                        <td class="align-middle category-text-cd">
                                            {{ $nostalgicVibesProj->category->category_name }}
                                        </td>
                                    @endif
                                    <td class="align-middle"><i class="lar la-calendar"></i>
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $nostalgicVibesProj->date)->format('d F Y') }}
                                    </td>
                                    <td class="align-middle">{{ $nostalgicVibesProj->requester }}</td>
                                    @if ($nostalgicVibesProj->status == 'Completed')
                                        <td class="align-middle">
                                            <span class="btn btn-complete">
                                                {{ $nostalgicVibesProj->status }}
                                            </span>
                                        </td>
                                    @elseif ($nostalgicVibesProj->status == 'On Process')
                                        <td class="align-middle">
                                            <span class="btn btn-onprocess">
                                                {{ $nostalgicVibesProj->status }}
                                            </span>
                                        </td>
                                    @elseif ($nostalgicVibesProj->status == 'Pending')
                                        <td class="align-middle">
                                            <span class="btn btn-pending">
                                                {{ $nostalgicVibesProj->status }}
                                            </span>
                                        </td>
                                    @elseif ($nostalgicVibesProj->status == 'Rejected')
                                        <td class="align-middle">
                                            <span class="btn btn-rejected">
                                                {{ $nostalgicVibesProj->status }}
                                            </span>
                                        </td>
                                    @else
                                        <td class="align-middle">
                                            <span class="btn btn-onprocess">
                                                {{ $nostalgicVibesProj->status }}
                                            </span>
                                        </td>
                                    @endif
                                    <td class="align-middle">{{ $nostalgicVibesProj->votes }}</td>
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
                <div class="d-flex justify-content-center align-items-center">
                    <a href="{{ route('nostalgic-vibes') }}" class="link-show-all text-decoration-none text-mdm-14">Show
                        All <i class="las la-arrow-right"> </i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="project-section">
                <div class="d-flex justify-content-between">
                    <h3>{{ $youtubeCommentType->type_name }}</h3>
                </div>
                <p>{{ $youtubeCommentType->about }}</p>
                <div class="table-responsive">
                    <table class="table table-hover projects-table">
                        <thead>
                            <tr>
                                <th>Project Title</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Requester</th>
                                <th>Status</th>
                                <th>Votes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($youtubeCommentProjects as $youtubeCommentProj)
                                <tr>
                                    <td class="align-middle">{{ $youtubeCommentProj->project_title }}</td>
                                    @if ($youtubeCommentProj->category->category_name === 'Line Distribution')
                                        <td class="align-middle category-text-ld">
                                            {{ $youtubeCommentProj->category->category_name }}
                                        </td>
                                    @elseif ($youtubeCommentProj->category->category_name === 'Line Evolution')
                                        <td class="align-middle category-text-le">
                                            {{ $youtubeCommentProj->category->category_name }}
                                        </td>
                                    @elseif ($youtubeCommentProj->category->category_name === 'Album Distribution')
                                        <td class="align-middle category-text-ad">
                                            {{ $youtubeCommentProj->category->category_name }}
                                        </td>
                                    @elseif ($youtubeCommentProj->category->category_name === 'Album Evolution')
                                        <td class="align-middle category-text-ae">
                                            {{ $youtubeCommentProj->category->category_name }}
                                        </td>
                                    @elseif ($youtubeCommentProj->category->category_name === 'Ranking Battle')
                                        <td class="align-middle category-text-rb">
                                            {{ $youtubeCommentProj->category->category_name }}
                                        </td>
                                    @elseif ($youtubeCommentProj->category->category_name === 'How Should')
                                        <td class="align-middle category-text-hs">
                                            {{ $youtubeCommentProj->category->category_name }}
                                        </td>
                                    @elseif ($youtubeCommentProj->category->category_name === 'How Would')
                                        <td class="align-middle category-text-hw">
                                            {{ $youtubeCommentProj->category->category_name }}
                                        </td>
                                    @elseif ($youtubeCommentProj->category->category_name === 'Center Distribution')
                                        <td class="align-middle category-text-cd">
                                            {{ $youtubeCommentProj->category->category_name }}
                                        </td>
                                    @endif
                                    <td class="align-middle"><i class="lar la-calendar"></i>
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $youtubeCommentProj->date)->format('d F Y') }}
                                    </td>
                                    <td class="align-middle">{{ $youtubeCommentProj->requester }}</td>
                                    @if ($youtubeCommentProj->status == 'Completed')
                                        <td class="align-middle">
                                            <span class="btn btn-complete">
                                                {{ $youtubeCommentProj->status }}
                                            </span>
                                        </td>
                                    @elseif ($youtubeCommentProj->status == 'On Process')
                                        <td class="align-middle">
                                            <span class="btn btn-onprocess">
                                                {{ $youtubeCommentProj->status }}
                                            </span>
                                        </td>
                                    @elseif ($youtubeCommentProj->status == 'Pending')
                                        <td class="align-middle">
                                            <span class="btn btn-pending">
                                                {{ $youtubeCommentProj->status }}
                                            </span>
                                        </td>
                                    @elseif ($youtubeCommentProj->status == 'Rejected')
                                        <td class="align-middle">
                                            <span class="btn btn-rejected">
                                                {{ $youtubeCommentProj->status }}
                                            </span>
                                        </td>
                                    @else
                                        <td class="align-middle">
                                            <span class="btn btn-onprocess">
                                                {{ $youtubeCommentProj->status }}
                                            </span>
                                        </td>
                                    @endif
                                    <td class="align-middle">{{ $youtubeCommentProj->votes }}</td>
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
                <div class="d-flex justify-content-center align-items-center">
                    <a href="{{ route('youtube-comment') }}" class="link-show-all text-decoration-none text-mdm-14">Show
                        All <i class="las la-arrow-right"> </i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
