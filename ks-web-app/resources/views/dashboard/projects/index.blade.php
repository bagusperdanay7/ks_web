@extends('dashboard.layouts.main')
@if (session()->has('success'))
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container top-0 end-0 p-3">
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-success-10 text-color-100">
                    <strong class="me-auto"><i class="las la-check-circle text-color-hs fs-18"></i> Kpop
                        Soulmate</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body bg-success-10 fs-inter-14 text-color-100">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    </div>
@endif

@section('content')
    {{-- TODO: Ubah Beberapa Teks menjadi inter --}}
    <section id="header-analytics">
        <div class="row m-bottom-30">
            <div class="col">
                <div class="d-flex justify-content-between">
                    <div>
                        <h1 class="fw-bold">Projects</h1>
                    </div>

                    <div>
                        <a class="btn btn-primary-color" href="/dashboard/projects/create">
                            <i class="las la-plus fs-18 m-right-5"></i>
                            Add Project
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="table-project">
        <div class="row mb-5">
            <div class="col">
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-hover">
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
                                @foreach ($projects as $project)
                                    <tr class="fs-12">
                                        <td class="align-middle">{{ $projects->firstItem() + $loop->index }}</td>
                                        <td class="align-middle">{{ $project->project_title }}</td>
                                        <td class="align-middle">{{ $project->artist->artist_name ?? 'No Artist' }}</td>
                                        @if ($project->category->category_name === 'Line Distribution')
                                            <td class="align-middle text-color-ld fw-medium">
                                                {{ $project->category->category_name }}
                                            </td>
                                        @elseif ($project->category->category_name === 'Line Evolution')
                                            <td class="align-middle text-color-le fw-medium">
                                                {{ $project->category->category_name }}
                                            </td>
                                        @elseif ($project->category->category_name === 'Album Distribution')
                                            <td class="align-middle text-color-ad fw-medium">
                                                {{ $project->category->category_name }}
                                            </td>
                                        @elseif ($project->category->category_name === 'Album Evolution')
                                            <td class="align-middle text-color-ae fw-medium">
                                                {{ $project->category->category_name }}
                                            </td>
                                        @elseif ($project->category->category_name === 'Center Distribution')
                                            <td class="align-middle text-color-cd fw-medium">
                                                {{ $project->category->category_name }}
                                            </td>
                                        @elseif ($project->category->category_name === 'How Would')
                                            <td class="align-middle text-color-hw fw-medium">
                                                {{ $project->category->category_name }}
                                            </td>
                                        @elseif ($project->category->category_name === 'How Should')
                                            <td class="align-middle text-color-hs fw-medium">
                                                {{ $project->category->category_name }}
                                            </td>
                                        @elseif ($project->category->category_name === 'Ranking Battle')
                                            <td class="align-middle text-color-rb fw-medium">
                                                {{ $project->category->category_name }}
                                            </td>
                                        @else
                                            <td class="align-middle text-color-100 fw-medium">
                                                {{ $project->category->category_name }}
                                            </td>
                                        @endif
                                        <td class="align-middle">{{ $project->type->type_name }}</td>
                                        <td class="align-middle">
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $project->date)->format('d F Y') }}
                                        </td>
                                        <td class="align-middle">{{ $project->requester }}</td>
                                        <td class="align-middle">
                                            @if ($project->status === 'Completed')
                                                <span class="btn btn-completed">{{ $project->status }}</span>
                                            @elseif ($project->status === 'On Process')
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
                                        <td class="align-middle fw-medium" style="width: 150px">
                                            {{ $project->progress }} %
                                            <div class="progress bg-main-20" role="progressbar"
                                                aria-label="Example 1px high" aria-valuenow="{{ $project->progress }}"
                                                aria-valuemin="0" aria-valuemax="100" style="height: 10px">
                                                <div class="progress-bar bg-main" style="width: {{ $project->progress }}%">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="btn-group dropstart">
                                                <button class="btn p-0" type="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="las la-ellipsis-v"> </i>
                                                </button>
                                                <ul class="dropdown-menu fs-14">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="/dashboard/projects/{{ $project->id }}"><i
                                                                class="las la-external-link-alt"></i> Detail</a>
                                                    </li>
                                                    <li>
                                                        <a href="/dashboard/projects/{{ $project->id }}/edit"
                                                            class="dropdown-item" type="button"><i class="las la-edit"></i>
                                                            Update</a>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item button-delete" type="button"
                                                            data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                                            data-id="{{ $project->id }}"
                                                            data-title="{{ $project->project_title }}"><i
                                                                class="las la-trash-alt"
                                                                id="buttonDelete{{ $project->id }}"></i>
                                                            Delete</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Confirm Delete -->
    <div class="modal fade " id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column align-items-center">
                        <i class="las la-trash-alt fs-24 text-color-ad rounded-circle p-2 bg-alert-10 m-bottom-15"></i>
                        <h6 class="fw-semibold m-bottom-5">Delete OH MY GIRL - Celebrate</h6>
                        <p class="fs-14">Are you sure you want to delete this project?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-border" data-bs-dismiss="modal">Close</button>
                    <form action="/dashboard/projects/" method="post" id="deleteForm">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-alert-color">Yes, Delete Project</button>
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
