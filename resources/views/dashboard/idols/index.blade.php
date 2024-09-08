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
                        <h1 class="fw-bold">Idols</h1>
                    </div>

                    <div>
                        <a class="btn btn-primary-color" href="{{ route('idols.create') }}">
                            <i class="las la-plus fs-18 m-right-5"></i>
                            Add Idol
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="search-idol" class="m-bottom-30">
        <div class="row">
            <div class="col">
                <form action="{{ route('idols.index') }}" method="GET">
                    <div class="input-group">
                        <span class="input-group-text background-color-secondary border"><i
                                class='bx bx-search fs-18'></i></span>
                        <input type="search" class="form-control" id="searchIdol" placeholder="Search Idol" name="search"
                            autocomplete="off" aria-label="Search Idol" value="{{ request('search') }}" accesskey="/" autofocus>
                    </div>
                </form>

                @if (request('search'))
                <div class="filter-clear m-top-5 text-end">
                    <a href="{{ route('idols.index') }}"
                        class="fs-14 font-inter text-decoration-none text-color-100 fw-medium">
                        <i class="las la-times-circle"></i> Clear Filter
                    </a>
                </div>
                @endif
            </div>
        </div>
    </section>

    <section id="table-idol">
        <div class="row mb-5">
            <div class="col">
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="fs-14 fw-semibold">
                                    <th scope="col">#</th>
                                    <th scope="col">Picture</th>
                                    <th scope="col">Stage Name</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Birth Name</th>
                                    <th scope="col">Born</th>
                                    <th>
                                        <i class="las la-ellipsis-v" id="idolMenu" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($idols as $idol)
                                    <tr class="fs-12">
                                        <td class="align-middle">{{ $idols->firstItem() + $loop->index }}</td>
                                        <td class="align-middle">
                                            @if ($idol->artist->artist_picture)
                                                <img src="{{ asset('storage/' . $idol->artist->artist_picture) }}"
                                                    alt="{{ $idol->stage_name }} Picture" class="img-fluid img-avatar">
                                            @else
                                                <img src="{{ asset('img/unknown_artist.jpg') }}"
                                                    alt="{{ $idol->stage_name }} Picture" class="img-fluid img-avatar">
                                            @endif
                                        </td>
                                        <td class="align-middle text-color-100">
                                            {{ $idol->stage_name }}
                                        </td>
                                        <td class="align-middle">{{ $idol->artist->artist_name }}</td>
                                        <td class="align-middle">{{ $idol->birth_name }}</td>
                                        <td class="align-middle">
                                            {{ \Carbon\Carbon::parse($idol->artist->birthdate)->isoFormat('LL') }}
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
                                                            href="{{ route('idols.show', $idol->id) }}"><i
                                                                class="las la-external-link-alt"></i> Detail</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('idols.edit', $idol->id) }}"
                                                            class="dropdown-item" type="button"><i class="las la-edit"></i>
                                                            Update</a>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item button-delete" type="button"
                                                            data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                                            data-id="{{ $idol->id }}"
                                                            data-name="{{ $idol->stage_name }}"><i
                                                                class="las la-trash-alt"
                                                                id="buttonDelete{{ $idol->id }}"></i>
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
                                            <p class="fs-14 fw-medium mt-1 mb-0">No Idol Found!</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination-container mt-3">
                        {{ $idols->links() }}
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
                        <h6 class="fw-semibold m-bottom-5">Delete Idol</h6>
                        <p class="fs-14">Are you sure you want to delete this idol?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-border" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('idols.destroy', $idol->id ?? '') }}" method="post" id="deleteForm">
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
                    "/dashboard/idols/" + this
                    .attributes[4].value;

            }, false);
        }
    </script>
@endsection
