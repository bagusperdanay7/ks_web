@extends('dashboard.layouts.main')
@if (session()->has('success'))
    <div class="container-fluid">
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast-container top-0 end-0 p-3">
                <div class="toast show rounded-10" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-success-10 text-color-100 rounded-top-8">
                        <strong class="me-auto"><i class="las la-check-circle text-success fs-18"></i> Kpop
                            Soulmate</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body bg-success-10 fs-inter-14 text-color-100 rounded-bottom-8">
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
            <div class="toast-container top-0 end-0 p-3">
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
                        <h1 class="fw-bold text-color-100">Songs</h1>
                    </div>
                    <div>
                        <a class="btn btn-primary-color" href="{{ route('songs.create') }}">
                            <i class="las la-plus fs-18 m-right-5"></i>
                            Add Song
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="search-song" class="m-bottom-30">
        <div class="row">
            <div class="col">
                <form action="{{ route('songs.index') }}" method="GET">
                    <div class="input-group">
                        <span class="input-group-text background-color-secondary border"><i
                                class='bx bx-search fs-18'></i></span>
                        <input type="search" class="form-control" id="searchSong" placeholder="Search Song" name="search"
                            autocomplete="off" aria-label="Search Song" value="{{ request('search') }}" accesskey="/" autofocus>
                    </div>
                </form>

                @if (request('search'))
                <div class="filter-clear m-top-5 text-end">
                    <a href="{{ route('songs.index') }}"
                        class="fs-14 font-inter text-decoration-none text-color-100 fw-medium">
                        <i class="las la-times-circle"></i> Clear Filter
                    </a>
                </div>
                @endif
            </div>
        </div>
    </section>

    <section id="table-songs">
        <div class="row mb-5">
            <div class="col">
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="fs-14 fw-semibold">
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Track Number</th>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Album</th>
                                    <th>
                                        <i class="las la-ellipsis-v" id="songMenu" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($songs as $song)
                                    <tr class="fs-12">
                                        <td class="align-middle">{{ $songs->firstItem() + $loop->index }}</td>
                                        <td class="align-middle">{{ $song->title }}</td>
                                        <td class="align-middle">{{ $song->track_number }}</td>
                                        <td class="align-middle">{{ $song->duration }}</td>
                                        <td class="align-middle">{{ $song->category }}</td>
                                        <td class="align-middle">{{ $song->album->name }}</td>
                                        <td class="align-middle">
                                            <div class="btn-group dropstart">
                                                <button class="btn p-0" type="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="las la-ellipsis-v"> </i>
                                                </button>
                                                <ul class="dropdown-menu rounded-10 fs-14">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('songs.show', $song->id) }}"><i
                                                                class="las la-external-link-alt"></i> Detail</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('songs.edit', $song->id) }}"
                                                            class="dropdown-item" type="button"><i class="las la-edit"></i>
                                                            Update</a>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item button-delete" type="button"
                                                            data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                                            data-id="{{ $song->id }}"
                                                            data-title="{{ $song->title }}"><i class="las la-trash-alt"
                                                                id="buttonDelete{{ $song->id }}"></i>
                                                            Delete</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-color-100">
                                            <i class="las la-music fs-48"></i>
                                            <p class="fs-14 fw-medium mt-1 mb-0">No Song Found!</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination-container mt-3">
                        {{ $songs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Confirm Delete -->
    <div class="modal fade " id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-10">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column align-items-center">
                        <i class="las la-trash-alt fs-24 text-color-ad rounded-circle p-2 bg-alert-10 m-bottom-15"></i>
                        <h6 class="fw-semibold m-bottom-5">Delete Song</h6>
                        <p class="fs-14">Are you sure you want to delete this song?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-border" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('songs.destroy', $song->id ?? '') }}" method="post" id="deleteForm">
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
                    "/dashboard/songs/" + this
                    .attributes[4].value;

            }, false);
        }
    </script>
@endsection
