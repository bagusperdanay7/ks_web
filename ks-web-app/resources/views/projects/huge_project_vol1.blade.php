@extends('layouts.main')

@section('container')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb" class="space-navbar">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/projects">Projects</a></li>
            <li class="breadcrumb-item breadcumb-active" aria-current="page">Huge Project Vol.#01</li>
        </ol>
    </nav>

    <div class="row huge-pro-hero">
        <div class="col-sm-12 mb-3 col-md-6">
            <h2 class="mb-3">Huge Project Vol.#01</h2>
            <p class="huge-pro-text">Huge Project Vol.#01 is a project based on Google Forms requests, where the
                content
                will
                be the line evolution of
                the female group of your choice</p>
            <a href="#huge-project-vol1" class="btn btn-huge-project-vol1">View Details</a>
        </div>

        <div class="col-sm-12 col-md-6">
            <img src="{{ asset('img/huge-pro-hero.png') }}" alt="" class="float-end" width="100%">
        </div>
    </div>

    <div class="row" id="huge-project-vol1">
        <div class="col">
            <div class="project-section">
                <div class="d-flex justify-content-between">
                    <h3>Huge Project Vol.#01</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover projects-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Project Name</th>
                                <th>Category</th>
                                <th>Requester</th>
                                <th>Status</th>
                                <th>Votes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($huge_projects as $huge_proj)
                                <tr>
                                    <td class="align-middle"><i class="lar la-calendar"></i>
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $huge_proj->project_date)->format('d F Y') }}
                                    </td>
                                    <td class="align-middle">{{ $huge_proj->project_title }}</td>
                                    <td class="align-middle">{{ $huge_proj->content_category->name }}</td>
                                    <td class="align-middle">{{ $huge_proj->project_requester }}</td>
                                    @if ($huge_proj->project_status == 'Completed')
                                        <td class="align-middle">
                                            <span class="btn btn-complete">
                                                {{ $huge_proj->project_status }}
                                            </span>
                                        </td>
                                    @elseif ($huge_proj->project_status == 'On Process')
                                        <td class="align-middle">
                                            <span class="btn btn-onprocess">
                                                {{ $huge_proj->project_status }}
                                            </span>
                                        </td>
                                    @elseif ($huge_proj->project_status == 'Pending')
                                        <td class="align-middle">
                                            <span class="btn btn-pending">
                                                {{ $huge_proj->project_status }}
                                            </span>
                                        </td>
                                    @elseif ($huge_proj->project_status == 'Rejected')
                                        <td class="align-middle">
                                            <span class="btn btn-rejected">
                                                {{ $huge_proj->project_status }}
                                            </span>
                                        </td>
                                    @else
                                        <td class="align-middle">
                                            <span class="btn btn-onprocess">
                                                {{ $huge_proj->project_status }}
                                            </span>
                                        </td>
                                    @endif
                                    <td class="align-middle">{{ $huge_proj->votes }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center no-data-val">
                                        <i class="las la-ban"></i> No Project Found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
