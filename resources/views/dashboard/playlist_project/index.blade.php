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
                        <h1 class="fw-bold">Playlist Project</h1>
                    </div>

                    <div>
                        <a class="btn btn-primary-color" href="{{ route('playlist-project.create') }}">
                            <i class="las la-plus fs-18 m-right-5"></i>
                            Add Playlist Project
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="table-playlist-project">
        <div class="row mb-5">
            <div class="col">
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="fs-14 fw-semibold">
                                    <th scope="col">#</th>
                                    <th scope="col">Order</th>
                                    <th scope="col">Playlist</th>
                                    <th scope="col">Project</th>
                                    <th scope="col">Main Video</th>
                                    <th>
                                        <i class="las la-ellipsis-v" id="albumMenu" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($playlistProject as $playlist)
                                    @foreach ($playlist->projects as $item)
                                        <tr class="fs-12">
                                            <td class="align-middle">{{ $loop->iteration }}</td>
                                            </td>
                                            <td class="align-middle text-color-100">
                                                {{ $item->pivot->order }}
                                            </td>
                                            <td class="align-middle text-color-100">
                                                {{ $playlist->name }}
                                            </td>
                                            <td class="align-middle text-color-100">
                                                {{ $item->title }}
                                            </td>
                                            <td class="align-middle">{{ $item->pivot->main_video }}</td>
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
                                                                data-id="{{ $playlist->id }}"
                                                                data-project-id="{{ $item->id }}"><i
                                                                    class="las la-trash-alt"
                                                                    id="buttonDelete{{ $playlist->id }}"></i>
                                                                Delete</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-color-100">
                                            <i class="las la-photo-video fs-48"></i>
                                            <p class="fs-14 fw-medium mt-1 mb-0">No Playlist Project Found!</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination-container mt-3">
                        {{-- {{ $playlistProject->links() }} --}}
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
                        <i class="las la-trash-alt fs-24 text-color-ad rounded-circle p-2 bg-alert-10 m-bottom-15"></i>
                        <h6 class="fw-semibold m-bottom-5">Delete Playlist Project</h6>
                        <p class="fs-14">Are you sure you want to delete this?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-border" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('playlist-project.destroy', $playlist->id ?? '') }}" method="post" id="deleteForm">
                        @method('delete')
                        @csrf
                        <input type="hidden" name="project_id" id="project_id">
                        <button type="submit" class="btn btn-alert-color">Yes, Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var buttonDelete = document.querySelectorAll('.button-delete');
        var modalTitle = document.querySelector('.modal-body h6')
        var projectIdInput = document.querySelector('#project_id')

        console.log(buttonDelete);

        for (var i = 0; i < buttonDelete.length; i++) {

            var buttons = buttonDelete[i];
            buttonDelete[i].addEventListener('click', function() {
                modalTitle.textContent = "Delete Relation";
                projectIdInput.value = this.attributes[5].value

                document.querySelector("#deleteForm").attributes[0].textContent =
                    "/dashboard/playlist-project/" + this
                    .attributes[4].value;
            }, false);
        }
    </script>
@endsection
