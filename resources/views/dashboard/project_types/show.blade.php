@extends('dashboard.layouts.main')

@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb fs-sm-12">
            <li class="breadcrumb-item"><a class="text-decoration-none text-color-100"
                    href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none text-color-100" href="{{ route('project-types.index') }}">Project
                    Type</a>
            </li>
            <li class="breadcrumb-item text-decoration-none text-color-100 fw-medium" aria-current="page">
                {{ $type->type_name }}</li>
        </ol>
    </nav>

    <section id="type-single-dashboard">
        <div class="row m-bottom-25">
            <div class="col">
                <div class="d-flex justify-content-between flex-sm-row flex-column">
                    <div class="title-heading">
                        <h2 class="fw-bold text-color-100">{{ $type->type_name }}</h2>
                    </div>

                    <div class="button-group">
                        <a href="{{ route('project-types.edit', $type->slug) }}" class="btn btn-light-border">
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

        <div class="row m-bottom-25">
            <div class="col-12 col-md">
                <div class="bg-white p-25 rounded-10">
                    <div class="row m-bottom-15">
                        <div class="col-6 col-sm">
                            <p class="m-bottom-10 text-color-100 fw-medium fs-14">Type Name</p>
                            <p class="m-0 text-color-100 fs-14">{{ $type->type_name }}</p>
                        </div>
                        <div class="col-6 col-sm">
                            <p class="m-bottom-10 text-color-100 fw-medium fs-14">Slug</p>
                            <p class="m-0 text-color-100 fs-14">{{ $type->slug }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p class="m-bottom-10 text-color-100 fw-medium fs-14">About</p>
                            <p class="m-0 text-color-100 fs-14">{{ $type->about }}</p>
                        </div>
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
                        <h6 class="fw-semibold m-bottom-5">Delete {{ $type->type_name }}</h6>
                        <p class="fs-14">Are you sure you want to delete this type?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-border" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('project-types.destroy', $type->slug) }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-alert-color">Yes, Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
