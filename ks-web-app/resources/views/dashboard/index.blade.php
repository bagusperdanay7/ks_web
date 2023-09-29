@extends('dashboard.layouts.main')
{{-- TODO: Tambahkan Confirm apakah ingin keluar atau tidak? --}}
{{-- @if (session()->has('success'))
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container top-0 end-0 p-3">
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-success-10 ">
                    <strong class="me-auto"><i class="las la-check-circle text-success-100 fs-18"></i> Kpop
                        Soulmate</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body bg-success-10 inter-regular-14 ">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    </div>
@endif --}}

@section('content')
    <section id="header-analytics">
        <div class="row m-bottom-30">
            <div class="col">
                <div class="d-flex justify-content-between flex-column flex-sm-row">
                    <div>
                        <h1 class="fw-bold text-color-100">Analytics Dashboard</h1>
                    </div>

                    <div>
                        <button class="btn
                            btn-primary-color">
                            <i class="las la-download fs-18 m-right-5"></i>
                            Back Up
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="card-analytics">
        <div class="row mb-5">
            <div class="col col-sm-6 col-xl-3 m-bottom-15">
                <div class="card-analytics">
                    <div class="d-flex flex-row justify-content-between">
                        <div class="card-info">
                            <div class="card-head">
                                <p class="title-card mx-0 m-bottom-5">Requests</p>
                                <p class="number-title-card mx-0 m-bottom-5">Number of Requests</p>
                            </div>
                            <h2 class="m-bottom-5 fw-bold">{{ $requests }}</h2>
                            <p class="text-color-80 fs-14">On Google Form and Youtube</p>
                        </div>
                        <div class="card-icon align-self-center">
                            <i class="las la-clipboard-list"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col col-sm-6 col-xl-3 m-bottom-15">
                <div class="card-analytics">
                    <div class="d-flex flex-row justify-content-between">
                        <div class="card-info">
                            <div class="card-head">
                                <p class="title-card mx-0 m-bottom-5">Video</p>
                                <p class="number-title-card mx-0 m-bottom-5">Number of Videos</p>
                            </div>
                            <h2 class="m-bottom-5 fw-bolder">{{ $totalVideo }}</h2>
                            <p class="text-color-80 fs-14">Uploaded On Youtube</p>
                        </div>
                        <div class="card-icon align-self-center">
                            <i class="lab la-youtube"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col col-sm-6 col-xl-3 m-bottom-15">
                <div class="card-analytics">
                    <div class="d-flex flex-row justify-content-between">
                        <div class="card-info">
                            <div class="card-head">
                                <p class="title-card mx-0 m-bottom-5">Requests Completed</p>
                                <p class="number-title-card mx-0 m-bottom-5">Number of Completed</p>
                            </div>
                            <h2 class="m-bottom-5 fw-bolder">{{ $completedRequests }} / {{ $requests }}</h2>
                            <p class="text-color-80 fs-14 m-bottom-5">Progress </p>
                        </div>
                        <div class="card-icon align-self-center">
                            <i class="las la-clipboard-check"></i>
                        </div>
                    </div>
                    <div class="progress bg-main-20" role="progressbar" aria-label="bar completed"
                        aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-main rounded-pill" style="width: {{ $progress }}%">
                            {{ $progress }}%</div>
                    </div>
                </div>
            </div>

            <div class="col col-sm-6 col-xl-3">
                <div class="card-analytics">
                    <div class="d-flex flex-row justify-content-between">
                        <div class="card-info">
                            <div class="card-head">
                                <p class="title-card mx-0 m-bottom-5">Requests Rejected</p>
                                <p class="number-title-card mx-0 m-bottom-5">Number of Rejected</p>
                            </div>
                            <h2 class="m-bottom-5 fw-bolder">{{ $rejectedRequests }}</h2>
                            <p class="text-color-80 fs-14 mb-0">From {{ $requests }} Requests</p>
                        </div>
                        <div class="card-icon align-self-center">
                            <i class="las la-comment-slash"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="category-statistics">
        <div class="row mb-5">
            <div class="col-lg-7 col-12 m-bottom-30">
                <div class="analytics-card border">
                    <div class="analytics-head">
                        <h4 class="fw-semibold m-bottom-10 text-color-100">Overall Project Type</h4>
                        <div class="chart-container">
                            <canvas id="projectTypeChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="analytics-card border">
                    <div class="analytics-head">
                        <h4 class="fw-semibold m-bottom-10 text-color-100">All Category</h4>
                        <div class="chart-container">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="progress-type-schedule">
        <div class="row mb-5">
            <div class="col-12 col-md-7 col-sm-6 m-bottom-30">
                <div class="analytics-card border text-color-100">
                    <div class="analytics-head">
                        <h4 class="fw-semibold m-bottom-10 text-color-100">Progress Project Type</h4>
                    </div>
                    @forelse ($typeProgress as $type)
                        @php
                            $typeCompletedTotal = $type->where('status', 'Completed')->count();
                            $typeTotal = $type->count();
                            
                            if ($typeCompletedTotal === 0) {
                                $progressType = 0;
                            } else {
                                $progressType = round(($typeCompletedTotal / $typeTotal) * 100);
                            }
                            
                        @endphp
                        <div class="analytics-body {{ $loop->last ? '' : 'm-bottom-15' }}">
                            <div class="d-flex justify-content-between">
                                <p class="m-bottom-5 fw-medium">{{ $type->first()->type_name }}</p>
                                <span class="fw-medium">{{ $progressType }}%
                                </span>
                            </div>
                            @if ($type->first()->type_name === 'Non-Project')
                                <div class="progress bg-non-pro-10" role="progressbar" aria-label="progressbar type"
                                    aria-valuenow="{{ $progressType }}" aria-valuemin="0" aria-valuemax="100"
                                    style="height: 10px;">
                                    <div class="progress-bar rounded-pill bg-non-pro" style="width: {{ $progressType }}%;">
                                    </div>
                                </div>
                            @elseif($type->first()->type_name === 'Huge Project Vol.#01')
                                <div class="progress bg-hugepro-vol1-10" role="progressbar" aria-label="progressbar type"
                                    aria-valuenow="{{ $progressType }}" aria-valuemin="0" aria-valuemax="100"
                                    style="height: 10px;">
                                    <div class="progress-bar bg-hugepro-vol1 rounded-pill"
                                        style="width: {{ $progressType }}%;"></div>
                                </div>
                            @elseif($type->first()->type_name === 'Nostalgic Vibes')
                                <div class="progress bg-nv-10" role="progressbar" aria-label="progressbar type"
                                    aria-valuenow="{{ $progressType }}" aria-valuemin="0" aria-valuemax="100"
                                    style="height: 10px;">
                                    <div class="progress-bar rounded-pill bg-nv" style="width: {{ $progressType }}%;">
                                    </div>
                                </div>
                            @elseif($type->first()->type_name === 'Youtube Comment')
                                <div class="progress bg-you-com-10" role="progressbar" aria-label="progressbar type"
                                    aria-valuenow="{{ $progressType }}" aria-valuemin="0" aria-valuemax="100"
                                    style="height: 10px;">
                                    <div class="progress-bar rounded-pill bg-you-com"
                                        style="width: {{ $progressType }}%;">
                                    </div>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="text-center text-color-100">
                            <i class="las la-ban fs-36"></i>
                            <p class="fs-14 fw-medium mt-1 mb-0"></p>No Progress of Project Type!
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="col-12 col-md-5 col-sm-6">
                <div class="analytics-card border text-color-100">
                    <div class="analytics-head">
                        <h4 class="fw-semibold m-bottom-10 text-color-100">Upcoming Schedule</h4>
                    </div>
                    @forelse ($upcomings as $upcoming)
                        <div class="upcoming-schedule-card {{ $loop->last ? 'mb-0' : 'mb-4' }}">
                            <div class="d-flex flex-column">
                                <div class="mb-2">
                                    <i class="lar la-calendar"></i>
                                    {{ \Carbon\Carbon::parse($upcoming->date)->format('d F Y, G:i T') }}
                                    ({{ \Carbon\Carbon::parse($upcoming->date)->diffForHumans() }})
                                </div>
                                <div class="m-bottom-5">
                                    <h6 class="fw-semibold m-0">{{ $upcoming->project_title }}
                                        ({{ $upcoming->category->category_name }})
                                    </h6>
                                </div>
                                <div class="m-bottom-5">
                                    <i class="las la-user-alt"></i> {{ $upcoming->requester }} |
                                    {{ $upcoming->type->type_name }}
                                </div>
                                <div class="d-flex justify-content-between fw-medium">
                                    <p class="m-0 m-bottom-5">Progress</p>
                                    <p class="m-0 ">{{ $upcoming->progress }} %</p>
                                </div>
                                <div class="progress bg-main-20" role="progressbar" aria-label="progress project"
                                    aria-valuenow="{{ $upcoming->progress }}" aria-valuemin="0" aria-valuemax="100"
                                    style="height: 10px">
                                    <div class="progress-bar bg-main rounded-pill"
                                        style="width: {{ $upcoming->progress }}%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col text-center text-color-100">
                            <svg width="48" height="48" viewBox="0 0 84 84" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                    fill="#EA8887" />
                                <path
                                    d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                    fill="#787878" />
                            </svg>
                            <p class="fs-14 fw-medium mt-1 mb-0"></p>No Upcoming Project!
                        </div>
                    @endforelse
                </div>
            </div>
    </section>

    <section id="project-list">
        <div class="row mb-5">
            <div class="col">
                <div class="analytics-card border">
                    <div class="analytics-head">
                        <h4 class="fw-semibold m-bottom-10 text-color-100">Reviewed Request List</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="text-color-100">
                                    <th scope="col">Project Title</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Requester</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($requestList as $list)
                                    <tr>
                                        <td class="align-middle">{{ $list->project_title }}</td>
                                        <td class="align-middle">{{ $list->category->category_name }}</td>
                                        <td class="align-middle">{{ $list->type?->type_name }}</td>
                                        <td class="align-middle">{{ $list->date }}</td>
                                        <td class="align-middle">{{ $list->requester }}</td>
                                        <td class="align-middle">
                                            <span class="btn btn-pending">{{ $list->status }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="/dashboard/projects/{{ $list->id }}" class="dropdown-item"><i
                                                    class="las la-external-link-alt fs-14"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-color-100">
                                            <svg width="48" height="48" viewBox="0 0 84 84" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                                    fill="#EA8887" />
                                                <path
                                                    d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                                    fill="#787878" />
                                            </svg>
                                            <p class="fs-14 fw-medium mt-1 mb-0">No Project Found!</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center link-details">
                        <a href="/dashboard/projects" class="text-decoration-none text-center fs-14 fw-medium">Show
                            All <i class="las la-arrow-right"> </i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Chart.js --}}
    <script>
        // Chart Category Doughnut
        // data from php

        var types = [
            @foreach ($types as $type)
                "{{ $type->type_name }}",
            @endforeach
        ];

        var typesTotal = [
            @foreach ($types as $type)
                "{{ $type->projects->count() }}",
            @endforeach
        ];

        var typesNumber = typesTotal.map(Number);

        let categories = [
            @foreach ($categories as $category)
                "{{ $category->category_name }}",
            @endforeach
        ];

        let categoriesTotal = [
            @foreach ($categories as $category)
                "{{ $category->projects->count() }}",
            @endforeach
        ];

        const ctx = document.getElementById('categoryChart');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: categories,
                datasets: [{
                    label: 'Category Chart',
                    data: categoriesTotal,
                    hoverOffset: 4
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                maintainAspectRatio: false,
            }
        });

        // Chart Projects Total

        const ctxType = document.getElementById('projectTypeChart');

        new Chart(ctxType, {
            type: 'bar',
            data: {
                labels: types,
                datasets: [{
                    label: 'Project Type Chart',
                    data: typesNumber,
                    backgroundColor: [
                        'rgba(0, 214, 239, 0.2)',
                        'rgba(103, 58, 183, 0.2)',
                        'rgba(3, 66, 131, 0.2)',
                        'rgba(255, 0, 0, 0.2)',
                    ],
                    borderColor: [
                        '#00d6ef',
                        '#673ab7',
                        '#034283',
                        '#ff0000',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                maintainAspectRatio: false,
            }
        });
    </script>
@endsection
