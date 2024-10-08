@extends('dashboard.layouts.main')

@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb fs-sm-12">
            <li class="breadcrumb-item"><a class="text-decoration-none text-color-100"
                    href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none text-color-100"
                    href="{{ route('projects.index') }}">Projects</a>
            </li>
            <li class="breadcrumb-item text-decoration-none text-color-100 fw-medium text-truncate" aria-current="page"
                title="{{ $project->title }}">
                {{ $project->title }}</li>
        </ol>
    </nav>

    <section id="project-single-dashboard">
        <div class="row m-bottom-25">
            <div class="col">
                <div class="d-flex justify-content-between flex-sm-row flex-column flex-wrap">
                    <div class="title-heading">
                        <h2 class="fw-bold text-color-100">{{ $project->title }}</h2>
                    </div>

                    <div class="button-group">
                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-light-border">
                            <i class="las la-edit fs-18 m-right-5"></i>
                            Update
                        </a>
                        <button class="btn btn-alert-color" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                            <i class="las la-trash-alt fs-18 m-right-5"></i>
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row m-bottom-30">
            <div class="col-12 col-md-7 col-xl-8 order-md-1 order-2">
                <div class="p-25 rounded-10 bg-white">
                    <div class="row m-bottom-15">
                        <div class="col">
                            <p class="m-bottom-10 text-color-100 fw-medium fs-14">Title</p>
                            <p class="text-color-100 fs-14 m-0">{{ $project->title }}</p>
                        </div>
                        <div class="col">
                            <p class="m-bottom-10 text-color-100 fw-medium fs-14">Artist</p>
                            <p class="text-color-100 fs-14 m-0">
                                @forelse ($project->artists->sortBy('artist_name') as $projectArtists)
                                    @if ($project->artists->count() > 1)
                                        <span>{{ $projectArtists->artist_name }}{{ $loop->last ? '' : ',' }}</span>
                                    @else
                                        {{ $projectArtists->artist_name }}
                                    @endif
                                @empty
                                    <span class="text-danger fw-medium">No Artist</span>
                                @endforelse

                            </p>
                        </div>
                    </div>
                    <div class="row m-bottom-15">
                        <div class="col">
                            <p class="m-bottom-10 text-color-100 fw-medium fs-14">Category</p>
                            @if ($project->category->category_name === 'Line Distribution')
                                <p class="text-color-ld fs-14 fw-medium m-0">
                                    {{ $project->category->category_name }}
                                </p>
                            @elseif ($project->category->category_name === 'Line Evolution')
                                <p class="text-color-le fs-14 fw-medium m-0">
                                    {{ $project->category->category_name }}
                                </p>
                            @elseif ($project->category->category_name === 'Album Distribution')
                                <p class="text-color-ad fs-14 fw-medium m-0">
                                    {{ $project->category->category_name }}
                                </p>
                            @elseif ($project->category->category_name === 'Total Line Evolution')
                                <p class="text-color-ae fs-14 fw-medium m-0">
                                    {{ $project->category->category_name }}
                                </p>
                            @elseif ($project->category->category_name === 'Center Distribution')
                                <p class="text-color-cd fs-14 fw-medium m-0">
                                    {{ $project->category->category_name }}
                                </p>
                            @elseif ($project->category->category_name === 'How Would')
                                <p class="text-color-hw fs-14 fw-medium m-0">
                                    {{ $project->category->category_name }}
                                </p>
                            @elseif ($project->category->category_name === 'How Should')
                                <p class="text-color-hs fs-14 fw-medium m-0">
                                    {{ $project->category->category_name }}
                                </p>
                            @elseif ($project->category->category_name === 'Ranking Battle')
                                <p class="text-color-rb fs-14 fw-medium m-0">
                                    {{ $project->category->category_name }}
                                </p>
                            @elseif ($project->category->category_name === 'Other')
                                <p class="text-info fs-14 fw-medium m-0">
                                    {{ $project->category->category_name }}
                                </p>
                            @else
                                <p class="text-color-100 fs-14 m-0">
                                    {{ $project->category->category_name }}
                                </p>
                            @endif
                        </div>
                        <div class="col">
                            <p class="m-bottom-10 text-color-100 fw-medium fs-14">Type</p>
                            <p class="text-color-100 fs-14 m-0">{{ $project->projectType?->type_name }}</p>
                        </div>
                    </div>
                    <div class="row m-bottom-15">
                        <div class="col">
                            <p class="m-bottom-10 text-color-100 fw-medium fs-14">Date</p>
                            <p class="text-color-100 fs-14 m-0">
                                {{ \Carbon\Carbon::parse($project->date)->format('d F Y, G:i T') }}</p>
                        </div>
                        <div class="col">
                            <p class="m-bottom-10 text-color-100 fw-medium fs-14">Created At</p>
                            <p class="text-color-100 fs-14 m-0">{{ $project->created_at }}</p>
                        </div>
                    </div>
                    <div class="row m-bottom-15">
                        <div class="col">
                            <p class="m-bottom-10 text-color-100 fw-medium fs-14">Requester</p>
                            <p class="text-color-100 fs-14 m-0">{{ $project->requester }}</p>
                        </div>
                        <div class="col">
                            <p class="m-bottom-10 text-color-100 fw-medium fs-14">Status</p>
                            @if ($project->status === 'Completed')
                                <span class="btn btn-completed">{{ $project->status }}</span>
                            @elseif ($project->status === 'In Progress')
                                <span class="btn btn-onprocess">{{ $project->status }}</span>
                            @elseif ($project->status === 'Pending')
                                <span class="btn btn-pending">{{ $project->status }}</span>
                            @elseif ($project->status === 'Rejected')
                                <span class="btn btn-rejected">{{ $project->status }}</span>
                            @else
                                <span class="btn btn-default">{{ $project->status }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row m-bottom-15">
                        <div class="col">
                            <p class="m-bottom-10 text-color-100 fw-medium fs-14">Progress</p>
                            <div class="row">
                                <div class="col align-self-center">
                                    <div class="progress bg-main-20" role="progressbar" aria-label="Progress Bar"
                                        aria-valuenow="{{ $project->progress }}" aria-valuemin="0" aria-valuemax="100"
                                        style="height: 10px">
                                        <div class="progress-bar bg-main" style="width: {{ $project->progress }}%">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-3">
                                    <p class="fs-14 text-color-100 m-0 text-end">{{ $project->progress }}% </p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <p class="m-bottom-10 text-color-100 fw-medium fs-14">Votes</p>
                            <p class="text-color-100 fs-14 m-0">{{ $project->votes }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p class="m-bottom-10 text-color-100 fw-medium fs-14">Notes</p>
                            @if ($project->notes === null)
                                <p class="text-color-100 fs-14 m-0">-</p>
                            @else
                                <p class="text-color-100 fs-14 m-0">{{ $project->notes }}</p>
                            @endif
                        </div>
                        <div class="col">
                            <p class="m-bottom-10 text-color-100 fw-medium fs-14">Exclusive</p>
                            <p class="text-color-100 fs-14 m-0">{{ $project->exclusive }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-5 col-xl-4 order-md-2 m-bottom-30 order-1">
                @if ($project->youtube_id !== null)
                    <img src="{{ 'https://i3.ytimg.com/vi/' . $project->youtube_id . '/maxresdefault.jpg' }}"
                        alt="{{ $project->title }} thumbnail" class="img-fluid rounded-top-10">
                @else
                    <img src="{{ asset('img/no_thumbnail.jpg') }}" alt="{{ $project->title }} thumbnail"
                        class="img-fluid rounded-top-10">
                @endif
                <div class="p-15 rounded-bottom-10 bg-white">
                    <p class="text-color-100 fw-medium fs-14 m-0">Youtube Id</p>
                    <p class="text-color-100 fs-12 text-break m-0">{{ $project->youtube_id }}</p>

                    <p class="m-bottom-0 m-top-15 text-color-100 fw-medium fs-14">URL</p>
                    <a href="{{ 'https://www.youtube.com/watch?v=' . $project->youtube_id }}" target="_blank"
                        class="text-decoration-none text-color-secondary fs-12 text-break">{{ 'https://www.youtube.com/watch?v=' . $project->youtube_id }}</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Confirm Delete -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-10">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column align-items-center">
                        <i class="las la-trash-alt fs-24 text-color-ad rounded-circle bg-alert-10 m-bottom-15 p-2"></i>
                        <h6 class="fw-semibold m-bottom-5">Delete {{ $project->title }}</h6>
                        <p class="fs-14">Are you sure you want to delete this project?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-border" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('projects.destroy', $project->id) }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-alert-color">Yes, Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
