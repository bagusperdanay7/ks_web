@extends('dashboard.layouts.main')
@if (session()->has('success'))
    <div class="container-fluid">
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast-container end-0 top-0 p-3">
                <div class="toast show rounded-10" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-success-10 text-color-100 rounded-top-8">
                        <strong class="me-auto"><i class="las la-check-circle text-success fs-18"></i> Kpop
                            Soulmate</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body bg-success-10 fs-14 font-inter text-color-100 rounded-bottom-8">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if (session()->has('danger'))
    <div class="container-fluid">
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast-container end-0 top-0 p-3">
                <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-alert-10 text-color-100">
                        <strong class="me-auto"><i class="las la-check-circle text-danger fs-18"></i> Kpop
                            Soulmate</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body bg-alert-10 fs-14 font-inter text-color-100">
                        {{ session('danger') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@section('content')
    <section id="header-analytics" class="m-bottom-15">
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-between flex-wrap">
                    <div>
                        <h1 class="fw-bold text-color-100 mb-0">Projects</h1>
                    </div>

                    <div>
                        <a class="btn btn-primary-color" href="{{ route('projects.create') }}">
                            <i class="las la-plus fs-18 m-right-5"></i>
                            Add Project
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="search-project" class="m-bottom-30">
        <div class="row">
            <div class="col">
                <form action="{{ route('projects.index') }}" method="GET">
                    <div class="input-group">
                        <span class="input-group-text background-color-secondary border"><i
                                class='bx bx-search fs-18'></i></span>
                        <input type="search" class="form-control" id="searchProject" placeholder="Search Project"
                            name="search" autocomplete="off" aria-label="Search Project" value="{{ request('search') }}"
                            accesskey="/" autofocus>
                    </div>
                </form>

                @if (request('search'))
                    <div class="filter-clear m-top-5 text-end">
                        <a href="{{ route('projects.index') }}"
                            class="fs-14 font-inter text-decoration-none text-color-100 fw-medium">
                            <i class="las la-times-circle"></i> Clear Filter
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section id="table-project">
        <div class="row mb-5">
            <div class="col">
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table-hover table">
                            <thead>
                                <tr class="fs-14 fw-semibold">
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Artist</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Requester</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Votes</th>
                                    <th scope="col">Progress</th>
                                    <th>
                                        <i class="las la-ellipsis-v" id="projectMenu" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($projects as $project)
                                    <tr class="fs-12">
                                        <td class="align-middle">{{ $projects->firstItem() + $loop->index }}</td>
                                        <td class="align-middle">{{ $project->title }}</td>
                                        <td class="align-middle">
                                            @forelse ($project->artists->sortBy('artist_name') as $projectArtists)
                                                @if ($project->artists->count() > 1)
                                                    <span>{{ $projectArtists->artist_name }}{{ $loop->last ? '' : ',' }}</span>
                                                @else
                                                    {{ $projectArtists->artist_name }}
                                                @endif
                                            @empty
                                                <span class="text-danger fw-medium">No Artist</span>
                                            @endforelse
                                        </td>
                                        @switch($project->category->category_name)
                                            @case('Line Distribution')
                                                <td class="text-color-ld fw-medium align-middle">
                                                    {{ $project->category->category_name }}</td>
                                            @break

                                            @case('Line Evolution')
                                                <td class="text-color-le fw-medium align-middle">
                                                    {{ $project->category->category_name }}
                                                </td>
                                            @break

                                            @case('Album Distribution')
                                                <td class="text-color-ad fw-medium align-middle">
                                                    {{ $project->category->category_name }}
                                                </td>
                                            @break

                                            @case('Total Line Evolution')
                                                <td class="text-color-ae fw-medium align-middle">
                                                    {{ $project->category->category_name }}
                                                </td>
                                            @break

                                            @case('Center Distribution')
                                                <td class="text-color-cd fw-medium align-middle">
                                                    {{ $project->category->category_name }}
                                                </td>
                                            @break

                                            @case('How Would')
                                                <td class="text-color-hw fw-medium align-middle">
                                                    {{ $project->category->category_name }}
                                                </td>
                                            @break

                                            @case('How Should')
                                                <td class="text-color-hs fw-medium align-middle">
                                                    {{ $project->category->category_name }}
                                                </td>
                                            @break

                                            @case('Ranking Battle')
                                                <td class="text-color-rb fw-medium align-middle">
                                                    {{ $project->category->category_name }}
                                                </td>
                                            @break

                                            @case('Other')
                                                <td class="text-info fw-medium align-middle">
                                                    {{ $project->category->category_name }}
                                                </td>
                                            @break

                                            @default
                                                <td class="text-color-100 fw-medium align-middle">
                                                    {{ $project->category->category_name }}
                                                </td>
                                        @endswitch
                                        <td class="align-middle">{{ $project->projectType?->type_name }}</td>
                                        <td class="align-middle">
                                            {{ \Carbon\Carbon::parse($project->date)->format('d F Y, G:i T') }}
                                        </td>
                                        <td class="align-middle">{{ $project->requester }}</td>
                                        <td class="align-middle">
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
                                        </td>
                                        <td class="align-middle">{{ $project->votes }}</td>
                                        <td class="fw-medium align-middle" style="width: 150px">
                                            {{ $project->progress }} %
                                            <div class="progress bg-main-20" role="progressbar"
                                                aria-label="Example 1px high" aria-valuenow="{{ $project->progress }}"
                                                aria-valuemin="0" aria-valuemax="100" style="height: 10px">
                                                <div class="progress-bar bg-main"
                                                    style="width: {{ $project->progress }}%">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="btn-group dropstart">
                                                <button class="btn p-0" type="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="las la-ellipsis-v"> </i>
                                                </button>
                                                <ul class="dropdown-menu rounded-10 fs-14">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('projects.show', $project->id) }}"><i
                                                                class="las la-external-link-alt"></i> Detail</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('projects.edit', $project->id) }}"
                                                            class="dropdown-item" type="button"><i
                                                                class="las la-edit"></i>
                                                            Update</a>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item button-delete" type="button"
                                                            data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                                            data-id="{{ $project->id }}"
                                                            data-title="{{ $project->title }}"><i
                                                                class="las la-trash-alt"
                                                                id="buttonDelete{{ $project->id }}"></i>
                                                            Delete</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11" class="text-color-100 text-center">
                                                <svg width="48" height="48" viewBox="0 0 84 84" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                                        fill="#EA8887" />
                                                    <path
                                                        d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                                        fill="#787878" />
                                                </svg>
                                                <p class="fs-14 fw-medium mb-0 mt-1">No Project Found!</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination-container mt-3">
                            {{ $projects->links() }}
                        </div>
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
                            <h6 class="fw-semibold m-bottom-5">Delete OH MY GIRL - Celebrate</h6>
                            <p class="fs-14">Are you sure you want to delete this project?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-border" data-bs-dismiss="modal">Close</button>
                        <form action="{{ route('projects.destroy', $project->id ?? '') }}" method="post"
                            id="deleteForm">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-alert-color">Yes, Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            var buttonDelete = document.querySelectorAll('.button-delete');
            var modalTitle = document.querySelector('.modal-body h6')

            for (var i = 0; i < buttonDelete.length; i++) {

                var buttons = buttonDelete[i];
                buttonDelete[i].addEventListener('click', function() {

                    modalTitle.textContent = "Delete " + this.attributes[5].value;

                    document.querySelector("#deleteForm").attributes[0].textContent =
                        "/dashboard/projects/" + this
                        .attributes[4].value;

                }, false);
            }
        </script>
    @endsection
