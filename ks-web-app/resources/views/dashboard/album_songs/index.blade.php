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

@section('content')
    <section id="header-analytics">
        <div class="row m-bottom-30">
            <div class="col">
                <div class="d-flex justify-content-between flex-wrap">
                    <div>
                        <h1 class="fw-bold">Album Songs</h1>
                    </div>

                    <div>
                        <a class="btn btn-primary-color" href="/dashboard/album-songs/create">
                            <i class="las la-plus fs-18 m-right-5"></i>
                            Add Album Songs
                        </a>
                    </div>
                </div>
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
                                    <th scope="col">Track Number</th>
                                    <th scope="col">Album</th>
                                    <th scope="col">Song</th>
                                    <th scope="col">Category</th>
                                    <th>
                                        <i class="las la-ellipsis-v" id="albumMenu" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @forelse ($albumSongs as $album)
                                    @foreach ($album->songs as $item)
                                        <tr class="fs-12">
                                            <td class="align-middle">{{ $no++ }}</td>
                                            </td>
                                            <td class="align-middle">{{ $item->pivot->track_number }}</td>
                                            <td class="align-middle text-color-100">
                                                {{ $album->album_name }}
                                            </td>
                                            <td class="align-middle text-color-100">
                                                {{ $item->title }}
                                            </td>
                                            <td class="align-middle text-color-100">
                                                {{ $item->pivot->category }}
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
                                                                href="/dashboard/album-songs/{{ $item->pivot->id }}"><i
                                                                    class="las la-external-link-alt"></i> Detail</a>
                                                        </li>
                                                        <li>
                                                            <a href="/dashboard/album-songs/{{ $item->pivot->id }}/edit"
                                                                class="dropdown-item" type="button"><i
                                                                    class="las la-edit"></i>
                                                                Update</a>
                                                        </li>
                                                        <li>
                                                            <button class="dropdown-item button-delete" type="button"
                                                                data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                                                data-id="{{ $item->pivot->id }}"
                                                                data-title="{{ $item->pivot->id }}"><i
                                                                    class="las la-trash-alt"
                                                                    id="buttonDelete{{ $item->pivot->id }}"></i>
                                                                Delete</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-color-100">
                                            <i class="las la-compact-disc fs-48"></i>
                                            <p class="fs-14 fw-medium mt-1 mb-0">No Album Found!</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
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
                        <h6 class="fw-semibold m-bottom-5">Delete Album Song</h6>
                        <p class="fs-14">Are you sure you want to delete this album song?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-border" data-bs-dismiss="modal">Cancel</button>
                    <form action="/dashboard/album-songs/" method="post" id="deleteForm">
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

                modalTitle.textContent = "Delete Relation Id " + this.attributes[5].value;

                document.querySelector("#deleteForm").attributes[0].textContent =
                    "/dashboard/album-songs/" + this
                    .attributes[4].value;
            }, false);
        }
    </script>
@endsection
