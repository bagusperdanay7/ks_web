@extends('dashboard.layouts.main')
@if (session()->has('success'))
    <div class="container-fluid">
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
    </div>
@endif

@section('content')
    <section id="header-analytics">
        <div class="row m-bottom-30">
            <div class="col">
                <div class="d-flex justify-content-between">
                    <div>
                        <h1 class="fw-bold">AI Models</h1>
                    </div>

                    <div>
                        <a class="btn btn-primary-color" href="/dashboard/ai-models/create">
                            <i class="las la-plus fs-18 m-right-5"></i>
                            Add AI Model
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="table-ai-models">
        <div class="row mb-5">
            <div class="col">
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="fs-14 fw-semibold">
                                    <th scope="col">#</th>
                                    <th scope="col">Model Cover</th>
                                    <th scope="col">Model Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Status</th>
                                    <th>
                                        <i class="las la-ellipsis-v" id="aiModelsMenu" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($aiModels as $aiModel)
                                    <tr class="fs-12">
                                        <td class="align-middle">{{ $aiModels->firstItem() + $loop->index }}</td>
                                        <td class="align-middle">
                                            @if ($aiModel->cover_model)
                                                <img src="{{ asset('storage/' . $aiModel->cover_model) }}"
                                                    alt="{{ $aiModel->model_name }} Picture" class="img-fluid img-avatar">
                                            @else
                                                <img src="{{ asset('img/unknown_artist.jpg') }}"
                                                    alt="{{ $aiModel->model_name }} Picture" class="img-fluid img-avatar">
                                            @endif
                                        </td>
                                        <td class="align-middle">{{ $aiModel->model_name }}</td>
                                        <td class="align-middle">
                                            <span @class([
                                                'btn',
                                                'btn-completed' => $aiModel->status === 'Completed',
                                                'btn-onprocess' => $aiModel->status === 'On Process',
                                                'btn-pending' => $aiModel->status === 'Pending',
                                                'btn-rejected' => $aiModel->status === 'Rejected',
                                            ])>{{ $aiModel->status }}</span>
                                        </td>
                                        <td class="align-middle">{{ $aiModel->description }}</td>
                                        <td class="align-middle">
                                            <div class="btn-group dropstart">
                                                <button class="btn p-0" type="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="las la-ellipsis-v"> </i>
                                                </button>
                                                <ul class="dropdown-menu fs-14">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="/dashboard/ai-models/{{ $aiModel->id }}"><i
                                                                class="las la-external-link-alt"></i> Detail</a>
                                                    </li>
                                                    <li>
                                                        <a href="/dashboard/ai-models/{{ $aiModel->id }}/edit"
                                                            class="dropdown-item" type="button"><i class="las la-edit"></i>
                                                            Update</a>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item button-delete" type="button"
                                                            data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                                            data-id="{{ $aiModel->id }}"
                                                            data-title="{{ $aiModel->model_name }}"><i
                                                                class="las la-trash-alt"
                                                                id="buttonDelete{{ $aiModel->id }}"></i>
                                                            Delete</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-color-100">
                                            <i class="las la-user-slash fs-48"></i>
                                            <p class="fs-14 fw-medium mt-1 mb-0">No Model Found!</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $aiModels->links() }}
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
                        <h6 class="fw-semibold m-bottom-5">Delete Model</h6>
                        <p class="fs-14">Are you sure you want to delete this Model?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-border" data-bs-dismiss="modal">Cancel</button>
                    <form action="/dashboard/ai-models/" method="post" id="deleteForm">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-alert-color">Yes, Delete Model</button>
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
                    "/dashboard/ai-models/" + this
                    .attributes[4].value;

            }, false);
        }
    </script>
@endsection
