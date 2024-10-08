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
                    <div class="toast-body bg-success-10 fs-14 font-inter text-color-100 rounded-bottom-8">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if (session()->has('warning'))
    <div class="container-fluid">
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast-container top-0 end-0 p-3">
                <div class="toast show rounded-10" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-warning-10 text-color-100 rounded-top-8">
                        <strong class="me-auto"><i class="las la-check-circle text-warning fs-18"></i> Kpop
                            Soulmate</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body bg-warning-10 fs-14 font-inter text-color-100 rounded-bottom-8">
                        {{ session('warning') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@section('content')
    <section id="header-analytics">
        <div class="row m-bottom-30">
            <div class="col">
                <div class="d-flex justify-content-between flex-wrap">
                    <div>
                        <h1 class="fw-bold">Song Genre</h1>
                    </div>

                    <div>
                        <a class="btn btn-primary-color" href="{{ route('song-genre.create') }}">
                            <i class="las la-plus fs-18 m-right-5"></i>
                            Add Song Genre
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="songGenreTable">
        <div class="row mb-5">
            <div class="col">
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="fs-14 fw-semibold">
                                    <th scope="col">#</th>
                                    <th scope="col">Song</th>
                                    <th scope="col">Album</th>
                                    <th scope="col">Genre</th>
                                    <th>
                                        <i class="las la-ellipsis-v" id="songGenreMenu" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($songGenre as $song)
                                    @foreach ($song->genres as $item)
                                        <tr class="fs-12">
                                            <td class="align-middle">{{ $loop->iteration }}</td>
                                            </td>
                                            <td class="align-middle text-color-100">
                                                {{ $song->title }}
                                            </td>
                                            <td class="align-middle text-color-100">
                                                {{ $song->album->name }}
                                            </td>
                                            <td class="align-middle text-color-100">
                                                {{ $item->name }}
                                            </td>
                                            <td class="align-middle">
                                                <div class="btn-group dropstart">
                                                    <button class="btn p-0" type="button" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="las la-ellipsis-v"> </i>
                                                    </button>
                                                    <ul class="dropdown-menu rounded-10 fs-14">
                                                        <li>
                                                            <button class="dropdown-item button-delete" type="button"
                                                                data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                                                data-id="{{ $song->id }}"
                                                                data-genre-id="{{ $item->id }}"><i
                                                                    class="las la-trash-alt"
                                                                    id="buttonDelete{{ $song->id }}"></i>
                                                                Delete</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-color-100">
                                            <i class="las la-music fs-48"></i>
                                            <p class="fs-14 fw-medium mt-1 mb-0">No Song Genre Found!</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination-container mt-3">
                        {{-- {{ $songGenre->links() }} --}}
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
                        <h6 class="fw-semibold m-bottom-5">Delete Song Genre</h6>
                        <p class="fs-14">Are you sure you want to delete this?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-border" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('song-genre.destroy', $song->id ?? '') }}" method="post" id="deleteForm">
                        @method('delete')
                        @csrf
                        <input type="hidden" name="genre_id" id="genre_id">
                        <button type="submit" class="btn btn-alert-color">Yes, Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var buttonDelete = document.querySelectorAll('.button-delete');
        var modalTitle = document.querySelector('.modal-body h6')
        var genreIdInput = document.querySelector('#genre_id')


        for (var i = 0; i < buttonDelete.length; i++) {

            var buttons = buttonDelete[i];
            buttonDelete[i].addEventListener('click', function() {
                modalTitle.textContent = "Delete Relation";
                genreIdInput.value = this.attributes[5].value

                document.querySelector("#deleteForm").attributes[0].textContent =
                    "/dashboard/song-genre/" + this
                    .attributes[4].value;
            }, false);
        }
    </script>
@endsection
