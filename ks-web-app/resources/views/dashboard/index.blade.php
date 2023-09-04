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
    {{-- TODO: Ubah Beberapa Teks menjadi inter --}}
    <section id="header-analytics">
        <div class="row m-bottom-30">
            <div class="col">
                <div class="d-flex justify-content-between">
                    <div>
                        <h1 class="fw-bold">Analytics Dashboard</h1>
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
            <div class="col">
                <div class="card-analytics">
                    <div class="d-flex flex-row justify-content-between">
                        <div class="card-info">
                            <div class="card-head">
                                <p class="title-card mx-0 m-bottom-5">Requests</p>
                                <p class="number-title-card mx-0 m-bottom-5">Number of Requests</p>
                            </div>
                            <h2 class="m-bottom-5 fw-bold">222</h2>
                            <p class="description-card">On Google Form and Youtube</p>
                        </div>
                        <div class="card-icon align-self-center">
                            <i class="las la-clipboard-list"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card-analytics">
                    <div class="d-flex flex-row justify-content-between">
                        <div class="card-info">
                            <div class="card-head">
                                <p class="title-card mx-0 m-bottom-5">Video</p>
                                <p class="number-title-card mx-0 m-bottom-5">Number of Videos</p>
                            </div>
                            <h2 class="m-bottom-5 fw-bolder">222</h2>
                            <p class="description-card">Uploaded On Youtube</p>
                        </div>
                        <div class="card-icon align-self-center">
                            <i class="lab la-youtube"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card-analytics">
                    <div class="d-flex flex-row justify-content-between">
                        <div class="card-info">
                            <div class="card-head">
                                <p class="title-card mx-0 m-bottom-5">Requests Completed</p>
                                <p class="number-title-card mx-0 m-bottom-5">Number of Requests</p>
                            </div>
                            <h2 class="m-bottom-5 fw-bolder">5 / 222</h2>
                            <p class="description-card m-bottom-5">Progress </p>
                        </div>
                        <div class="card-icon align-self-center">
                            <i class="las la-clipboard-check"></i>
                        </div>
                    </div>
                    <div class="progress bg-main-20" role="progressbar" aria-label="bar completed" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-main rounded-pill" style="width: 25%">25%</div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card-analytics">
                    <div class="d-flex flex-row justify-content-between">
                        <div class="card-info">
                            <div class="card-head">
                                <p class="title-card mx-0 m-bottom-5">Requests Rejected</p>
                                <p class="number-title-card mx-0 m-bottom-5">Number of Rejected</p>
                            </div>
                            <h2 class="m-bottom-5 fw-bolder">222</h2>
                            <p class="description-card">From 20 Requests</p>
                        </div>
                        <div class="card-icon align-self-center btn">
                            <i class="las la-comment-slash"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="category-statistics">
        <div class="row mb-5">
            <div class="col">
                <div class="analytics-card">
                    <div class="analytics-head">
                        <h4 class="fw-semibold m-bottom-10">Overall Project Type</h4>
                        <div class="">
                            <canvas id="projectTypeChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="analytics-card">
                    <div class="analytics-head">
                        <h4 class="fw-semibold m-bottom-10">All Category</h4>
                        <div class="">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="progress-type-schedule">
        <div class="row mb-5">
            <div class="col-7">
                <div class="analytics-card">
                    <div class="analytics-head">
                        <h4 class="fw-semibold m-bottom-10">Progress Project Type</h4>
                    </div>
                    <div class="analytics-body mb-3">
                        <div class="d-flex justify-content-between">
                            <p class="m-bottom-5 fw-medium">Huge Project Vol.#01</p>
                            <span class="fw-medium">25 %</span>
                        </div>
                        <div class="progress bg-hugepro-vol1-10" role="progressbar" aria-label="progressbar type"
                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 10px;">
                            <div class="progress-bar bg-hugepro-vol1 rounded-pill" style="width: 25%;"></div>
                        </div>
                    </div>
                    <div class="analytics-body mb-3">
                        <div class="d-flex justify-content-between">
                            <p class="m-bottom-5 fw-medium">Youtube Comment</p>
                            <span class="fw-medium">25 %</span>
                        </div>
                        <div class="progress bg-you-com-10" role="progressbar" aria-label="progressbar type"
                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 10px;">
                            <div class="progress-bar rounded-pill bg-you-com" style="width: 25%;"></div>
                        </div>
                    </div>
                    <div class="analytics-body">
                        <div class="d-flex justify-content-between">
                            <p class="m-bottom-5 fw-medium">Non-Project</p>
                            <span class="fw-medium">25 %</span>
                        </div>
                        <div class="progress bg-non-pro-10" role="progressbar" aria-label="progressbar type"
                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 10px;">
                            <div class="progress-bar rounded-pill bg-non-pro" style="width: 25%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="analytics-card">
                    <div class="analytics-head">
                        <h4 class="fw-semibold m-bottom-10">Upcoming Schedule</h4>
                    </div>
                    @foreach ($upcomings as $upcoming)
                        @if ($loop->last)
                            <div class="upcoming-schedule-card mb-0">
                            @else
                                <div class="upcoming-schedule-card mb-4">
                        @endif
                        <div class="d-flex flex-column">
                            <div class="mb-2">
                                <i class="lar la-calendar"></i>
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $upcoming->date)->format('d F Y') }}
                                ({{ \Carbon\Carbon::createFromTimeStamp(strtotime($upcoming->date))->diffForHumans() }})
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
                                <div class="progress-bar bg-main rounded-pill" style="width: {{ $upcoming->progress }}%;">
                                </div>
                            </div>
                        </div>
                </div>
                @endforeach
            </div>
        </div>
        </div>
    </section>

    <section id="project-list">
        <div class="row mb-5">
            <div class="col">
                <div class="analytics-card">
                    <div class="analytics-head">
                        <h4 class="fw-semibold m-bottom-10">Reviewed Request List</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Project Title</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Requester</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requestList as $list)
                                    <tr>
                                        <td class="align-middle">{{ $list->project_title }}</td>
                                        <td class="align-middle">{{ $list->category->category_name }}</td>
                                        <td class="align-middle">{{ $list->type->type_name }}</td>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center link-details">
                        <a href="/dashboard/projects"
                            class="text-decoration-none text-center fs-14 fw-medium text-color-100">Show
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
        const ctx = document.getElementById('categoryChart');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: 'Category Chart',
                    data: [12, 19, 3, 5, 2, 3],
                    hoverOffset: 4
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Chart Projects Total

        const ctxType = document.getElementById('projectTypeChart');

        new Chart(ctxType, {
            type: 'bar',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei'],
                datasets: [{
                    label: 'Project Type Chart',
                    data: [65, 59, 80, 81, 56],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // new Chart(ctxType, {
        //     type: 'bar',
        //     data: {
        //         labels: Utils.months({
        //             count: 5
        //         }),
        //         datasets: [{
        //             label: 'Project Type Chart',
        //             data: [65, 59, 80, 81, 56],
        //             backgroundColor: [
        //                 'rgba(255, 99, 132, 0.2)',
        //                 'rgba(255, 159, 64, 0.2)',
        //                 'rgba(255, 205, 86, 0.2)',
        //                 'rgba(75, 192, 192, 0.2)',
        //                 'rgba(54, 162, 235, 0.2)',
        //             ],
        //             borderColor: [
        //                 'rgb(255, 99, 132)',
        //                 'rgb(255, 159, 64)',
        //                 'rgb(255, 205, 86)',
        //                 'rgb(75, 192, 192)',
        //                 'rgb(54, 162, 235)',
        //             ],
        //             borderWidth: 1
        //         }]
        //     },
        //     options: {
        //         scales: {
        //             y: {
        //                 beginAtZero: true
        //             }
        //         }
        //     },
        // });
    </script>
@endsection
