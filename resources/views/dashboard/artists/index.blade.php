@extends('dashboard.layouts.main')
@if (session()->has('success'))
    <div class="container-fluid">
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast-container top-0 end-0 p-3">
                <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-success-10 text-color-100">
                        <strong class="me-auto"><i class="las la-check-circle text-success fs-18"></i> Kpop
                            Soulmate</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body bg-success-10 fs-14 font-inter text-color-100">
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
                <div class="d-flex justify-content-between">
                    <div>
                        <h1 class="fw-bold">Artists</h1>
                    </div>

                    <div>
                        <a class="btn btn-primary-color" href="{{ route('artists.create') }}">
                            <i class="las la-plus fs-18 m-right-5"></i>
                            Add Artist
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="search-artist" class="m-bottom-30">
        <div class="row">
            <div class="col">
                <form action="{{ route('artists.index') }}" method="GET">
                    <div class="input-group">
                        <span class="input-group-text background-color-secondary border"><i
                                class='bx bx-search fs-18'></i></span>
                        <input type="search" class="form-control" id="searchArtist" placeholder="Search Artist" name="search"
                            autocomplete="off" aria-label="Search Artist" value="{{ request('search') }}" accesskey="/" autofocus>
                    </div>
                </form>

                @if (request('search'))
                <div class="filter-clear m-top-5 text-end">
                    <a href="{{ route('artists.index') }}"
                        class="fs-14 font-inter text-decoration-none text-color-100 fw-medium">
                        <i class="las la-times-circle"></i> Clear Filter
                    </a>
                </div>
                @endif
            </div>
        </div>
    </section>

    <section id="table-artist">
        <div class="row mb-5">
            <div class="col">
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="fs-14 fw-semibold">
                                    <th scope="col">#</th>
                                    <th scope="col">Picture</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Codename</th>
                                    <th scope="col">Classification</th>
                                    <th scope="col">Birthdate</th>
                                    <th scope="col">Origin</th>
                                    <th scope="col">Fandom</th>
                                    <th scope="col">Company</th>
                                    <th>
                                        <i class="las la-ellipsis-v" id="artistMenu" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($artists as $artist)
                                    <tr class="fs-12">
                                        <td class="align-middle">{{ $artists->firstItem() + $loop->index }}</td>
                                        <td class="align-middle">
                                            @if ($artist->artist_picture)
                                                <img src="{{ asset('storage/' . $artist->artist_picture) }}"
                                                    alt="{{ $artist->artist_name }}" class="img-fluid img-avatar">
                                            @else
                                                <img src="{{ asset('img/unknown_artist.jpg') }}"
                                                    alt="{{ $artist->artist_name }}" class="img-fluid img-avatar">
                                            @endif
                                        </td>
                                        <td class="align-middle">{{ $artist->artist_name }}</td>
                                        <td class="align-middle text-color-100">
                                            {{ $artist->codename }}
                                        </td>
                                        <td class="align-middle">{{ $artist->classification }}</td>
                                        <td class="align-middle">
                                            {{ \Carbon\Carbon::parse($artist->birthdate)->format('d F Y') }}
                                        </td>
                                        <td class="align-middle">{{ $artist->origin }}</td>
                                        <td class="align-middle">{{ $artist->fandom }}</td>
                                        <td class="align-middle">{{ $artist->company->name }}</td>
                                        <td class="align-middle">
                                            <div class="btn-group dropstart">
                                                <button class="btn p-0" type="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="las la-ellipsis-v"> </i>
                                                </button>
                                                <ul class="dropdown-menu rounded-10 fs-14">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('artists.show', $artist->codename) }}"><i
                                                                class="las la-external-link-alt"></i> Detail</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('artists.edit', $artist->codename) }}"
                                                            class="dropdown-item" type="button"><i class="las la-edit"></i>
                                                            Update</a>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item button-delete" type="button"
                                                            data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                                            data-id="{{ $artist->codename }}"
                                                            data-title="{{ $artist->artist_name }}"><i
                                                                class="las la-trash-alt"
                                                                id="buttonDelete{{ $artist->codename }}"></i>
                                                            Delete</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-color-100">
                                            <i class="las la-user-slash fs-48"></i>
                                            <p class="fs-14 fw-medium mt-1 mb-0">No Artist Found!</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination-container mt-3">
                        {{ $artists->links() }}
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
                        <h6 class="fw-semibold m-bottom-5">Delete Artist</h6>
                        <p class="fs-14">Are you sure you want to delete this artist?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-border" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('artists.destroy', $artist->codename ?? '') }}" method="post" id="deleteForm">
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
                    "/dashboard/artists/" + this
                    .attributes[4].value;

            }, false);
        }
    </script>
@endsection
