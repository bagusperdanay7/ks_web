@extends('layouts.main')
@if (session()->has('success'))
    <div class="container">
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast-container top-0 end-0 p-0" style="margin-top: 80px">
                <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-success-10 text-color-100">
                        <strong class="me-auto"><i class="las la-check-circle text-color-hs fs-18"></i> Kpop
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

@section('content')
    <section id="request-list-header" class="mb-30">
        <div class="row">
            <div class="d-flex justify-content-between flex-column flex-md-row">
                <h2 class="order-1 fw-bold text-color-100 mb-md-10">Request List</h2>
                @if ($projectCompletedProgress < 80)
                    <a class="btn btn-outline-main align-self-center fw-semibold fs-18 col-12 col-md-auto dis order-3"
                        aria-disabled="true" data-bs-toggle="tooltip" data-bs-placement="bottom"
                        data-bs-title="Sorry Couldn't Fulfill Requests Until 80% Completed">
                        <i class="las la-plus"></i> Make A
                        Request</a>
                @else
                    <a href="{{ route('request-form') }}"
                        class="btn btn-outline-main align-self-center fw-semibold fs-18 col-12 col-md-auto order-3"><i
                            class="las la-edit"></i> Make A
                        Request</a>
                @endif
                <p class="mb-15 text-color-100 fs-18 d-md-none order-2">Request list consists of all of your requests
                    from
                    Google
                    forms and
                    YouTube
                    comments.
                </p>
            </div>
            <p class="mt-10 mb-0 text-color-100 fs-18 d-none d-md-block">Request list consists of all of your requests
                from Google
                forms
                and YouTube
                comments.
            </p>
        </div>
    </section>

    <section id="request-list-cards" class="mb-30">
        <div class="row">
            <div class="col-lg-3 col-12 col-sm-6 mb-lg-15">
                <div class="card-analytics">
                    <div class="d-flex flex-row justify-content-between">
                        <div class="card-info">
                            <div class="card-head">
                                <p class="fs-18">REQUESTS</p>
                                <p class="fs-14 fw-medium">Number of Requests</p>
                            </div>
                            <div class="card-body">
                                <h2>{{ $projectNumber }}</h2>
                                <p>On Google Form and Youtube</p>
                            </div>
                        </div>
                        <div class="card-icon align-self-center">
                            <i class="las la-clipboard-list"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-12 col-sm-6 mb-lg-15">
                <div class="card-analytics">
                    <div class="d-flex flex-row justify-content-between">
                        <div class="card-info">
                            <div class="card-head">
                                <p class="fs-18">VIDEO</p>
                                <p class="fs-14 fw-medium">Number of Videos</p>
                            </div>
                            <div class="card-body">
                                <h2>{{ $totalVideo }}</h2>
                                <p>Uploaded On Youtube</p>
                            </div>
                        </div>
                        <div class="card-icon align-self-center">
                            <i class="lab la-youtube"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-12 col-sm-6 mb-lg-15">
                <div class="card-analytics">
                    <div class="d-flex flex-row justify-content-between">
                        <div class="card-info">
                            <div class="card-head">
                                <p class="fs-18">REQUESTS COMPLETED</p>
                                <p class="fs-14 fw-medium">Number of Completed</p>
                            </div>
                            <div class="card-body mb5">
                                <h2>{{ $projectCompletedNumber }} / {{ $projectNumber }}</h2>
                                <p>Progress </p>
                            </div>
                        </div>
                        <div class="card-icon align-self-center">
                            <i class="las la-clipboard-check"></i>
                        </div>
                    </div>
                    <div class="progress bg-main-20 rounded-pill">
                        <div class="progress-bar bg-main rounded-pill" role="progressbar"
                            style="width: {{ $projectCompletedProgress }}%;" aria-valuemin="0" aria-valuemax="100">
                            {{ $projectCompletedProgress }}%
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-12 col-sm-6">
                <div class="card-analytics">
                    <div class="d-flex flex-row justify-content-between">
                        <div class="card-info">
                            <div class="card-head">
                                <p class="fs-18">REQUESTS REJECTED</p>
                                <p class="fs-14 fw-medium">Number of Rejected</p>
                            </div>
                            <div class="card-body">
                                <h2>{{ $projectRejectedNumber }}</h2>
                                <p>From {{ $projectNumber }} requests</p>
                            </div>
                        </div>
                        <div class="card-icon align-self-center">
                            <i class="las la-comment-slash"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- TODO: Bikin filter sama search aja (ganti tab) --}}
    <section id="table-request-list">
        <div class="row">
            <div class="col">
                <div class="req-list-section">
                    <ul class="nav nav-underline mb-4 text-responsive" id="underline-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="underline-all-req-tab" data-bs-toggle="tab"
                                data-bs-target="#underline-all-req" type="button" role="tab"
                                aria-controls="underline-all-req" aria-selected="true">All</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="underline-completed-tab" data-bs-toggle="tab"
                                data-bs-target="#underline-completed" type="button" role="tab"
                                aria-controls="underline-completed" aria-selected="false">Completed</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="underline-onprocess-tab" data-bs-toggle="tab"
                                data-bs-target="#underline-onprocess" type="button" role="tab"
                                aria-controls="underline-onprocess" aria-selected="false">On Process</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="underline-pending-tab" data-bs-toggle="tab"
                                data-bs-target="#underline-pending" type="button" role="tab"
                                aria-controls="underline-pending" aria-selected="false">Pending</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="underline-rejected-tab" data-bs-toggle="tab"
                                data-bs-target="#underline-rejected" type="button" role="tab"
                                aria-controls="underline-rejected" aria-selected="false">Rejected</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="underline-tabContent">
                        <div class="tab-pane fade show active" id="underline-all-req" role="tabpanel"
                            aria-labelledby="underline-all-req-tab" tabindex="0">
                            <div class="d-flex justify-content-between">
                                <h3 class="mb-3 text-color-100">All Request List</h3>
                            </div>
                            <div class="table-responsive d-md-block d-none">
                                <table class="table table-hover req-list-table display" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>Project Title</th>
                                            <th>Category</th>
                                            <th>Date</th>
                                            <th>Project Type</th>
                                            <th>Requester</th>
                                            <th>Status</th>
                                            <th>Votes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($projects as $project)
                                            <tr>
                                                <td class="align-middle text-color-100">{{ $project->project_title }}</td>
                                                <td @class([
                                                    'align-middle',
                                                    'fw-medium',
                                                    'text-color-ad' =>
                                                        $project->category->category_name === 'Album Distribution',
                                                    'text-color-ae' => $project->category->category_name === 'Album Evolution',
                                                    'text-color-cd' =>
                                                        $project->category->category_name === 'Center Distribution',
                                                    'text-color-hs' => $project->category->category_name === 'How Should',
                                                    'text-color-hw' => $project->category->category_name === 'How Would',
                                                    'text-color-ld' =>
                                                        $project->category->category_name === 'Line Distribution',
                                                    'text-color-le' => $project->category->category_name === 'Line Evolution',
                                                    'text-color-rb' => $project->category->category_name === 'Ranking Battle',
                                                ])>{{ $project->category->category_name }}
                                                </td>
                                                <td class="align-middle text-color-100"><i class="lar la-calendar"></i>
                                                    @if ($project->date)
                                                        {{ \Carbon\Carbon::parse($project->date)->format('d F Y, G:i T') }}
                                                    @else
                                                        Coming Soon
                                                    @endif
                                                </td>
                                                <td class="align-middle text-color-100">{{ $project->type->type_name }}
                                                </td>
                                                <td class="align-middle text-color-100">{{ $project->requester }}</td>
                                                <td class="align-middle">
                                                    <span @class([
                                                        'btn',
                                                        'btn-complete' => $project->status == 'Completed',
                                                        'btn-onprocess' => $project->status == 'On Process',
                                                        'btn-pending' => $project->status == 'Pending',
                                                        'btn-rejected' => $project->status == 'Rejected',
                                                    ])>{{ $project->status }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-color-100">{{ $project->votes }}</td>
                                                <td class="align-middle"><a href="/projects/{{ $project->id }}"
                                                        class="text-decoration-none text-color-secondary"><i
                                                            class="las la-external-link-alt" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            data-bs-title="Show Detail Project"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-color-100">
                                                    <svg width="48" height="48" viewBox="0 0 84 84"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                                            fill="#EA8887" />
                                                        <path
                                                            d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                                            fill="#787878" />
                                                    </svg>
                                                    <p class="fs-14 fw-medium mt-2">No Data found!</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="pagination-container">
                                    {{ $projects->onEachSide(0)->links() }}
                                </div>
                            </div>
                            <div class="table-mobile mb-30">
                                @forelse ($projects as $project)
                                    <div class="row {{ $loop->last ? '' : 'mb-3' }}">
                                        <div class="col">
                                            <div class="table-content-mobile">
                                                <div class="d-flex justify-content-between align-items-start mb-10">
                                                    <div class="fs-12 fw-medium text-color-80"><i
                                                            class="lar la-calendar"></i>
                                                        @if ($project->date)
                                                            {{ \Carbon\Carbon::parse($project->date)->format('d F Y, G:i T') }}
                                                        @else
                                                            Coming Soon
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <a href="/projects/{{ $project->id }}"
                                                            class="text-decoration-none text-color-secondary">
                                                            <i class="las la-external-link-alt fs-18"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-title="Show Detail Project"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="mb5">
                                                    <span @class([
                                                        'btn',
                                                        'btn-complete' => $project->status === 'Completed',
                                                        'btn-onprocess' => $project->status === 'On Process',
                                                        'btn-pending' => $project->status === 'Pending',
                                                        'btn-rejected' => $project->status === 'Rejected',
                                                    ])> {{ $project->status }}</span>
                                                </div>
                                                <div class="fs-12 mb5">
                                                    <p class="fs-12 m-0 fw-semibold text-color-100">
                                                        {{ $project->project_title }}
                                                    </p>
                                                </div>
                                                <div class="fs-12 fw-medium mb5">
                                                    <span @class([
                                                        'text-color-ld' =>
                                                            $project->category->category_name === 'Line Distribution',
                                                        'text-color-le' => $project->category->category_name === 'Line Evolution',
                                                        'text-color-ad' =>
                                                            $project->category->category_name === 'Album Distribution',
                                                        'text-color-ae' => $project->category->category_name === 'Album Evolution',
                                                        'text-color-rb' => $project->category->category_name === 'Ranking Battle',
                                                        'text-color-hs' => $project->category->category_name === 'How Should',
                                                        'text-color-hw' => $project->category->category_name === 'How Would',
                                                        'text-color-cd' =>
                                                            $project->category->category_name === 'Center Distribution',
                                                    ])>
                                                        {{ $project->category->category_name }}</span> •
                                                    <span class="text-color-100">{{ $project->type->type_name }}</span>
                                                </div>
                                                <div class="text-color-100 fs-12 fw-medium">
                                                    <i class="las la-user-alt"></i> {{ $project->requester }} |
                                                    {{ $project->votes }}
                                                    Votes
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
                                        <p class="fs-14 fw-medium mt-1 mb-0"></p>No Data found!
                                    </div>
                                @endforelse
                                <div class="pagination-container">
                                    {{ $projects->onEachSide(0)->links() }}
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="underline-completed" role="tabpanel"
                            aria-labelledby="underline-completed-tab" tabindex="0">
                            <div class="d-flex justify-content-between">
                                <h3 class="mb-3 text-color-100">Completed Request</h3>
                            </div>
                            <div class="table-responsive d-md-block d-none">
                                <table class="table table-hover req-list-table display" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>Project Title</th>
                                            <th>Category</th>
                                            <th>Date</th>
                                            <th>Project Type</th>
                                            <th>Requester</th>
                                            <th>Status</th>
                                            <th>Votes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($completedProjects as $completedPro)
                                            <tr>
                                                <td class="align-middle">{{ $completedPro->project_title }}</td>
                                                <td @class([
                                                    'align-middle',
                                                    'fw-medium',
                                                    'text-color-ad' =>
                                                        $completedPro->category->category_name === 'Album Distribution',
                                                    'text-color-ae' =>
                                                        $completedPro->category->category_name === 'Album Evolution',
                                                    'text-color-cd' =>
                                                        $completedPro->category->category_name === 'Center Distribution',
                                                    'text-color-hs' => $completedPro->category->category_name === 'How Should',
                                                    'text-color-hw' => $completedPro->category->category_name === 'How Would',
                                                    'text-color-ld' =>
                                                        $completedPro->category->category_name === 'Line Distribution',
                                                    'text-color-le' =>
                                                        $completedPro->category->category_name === 'Line Evolution',
                                                    'text-color-rb' =>
                                                        $completedPro->category->category_name === 'Ranking Battle',
                                                ])>
                                                    {{ $completedPro->category->category_name }}
                                                </td>
                                                <td class="align-middle"><i class="lar la-calendar"></i>
                                                    @if ($completedPro->date)
                                                        {{ \Carbon\Carbon::parse($completedPro->date)->format('d F Y, G:i T') }}
                                                    @else
                                                        Coming Soon
                                                    @endif
                                                </td>
                                                <td class="align-middle">{{ $completedPro->type->type_name }}</td>
                                                <td class="align-middle">{{ $completedPro->requester }}</td>
                                                <td class="align-middle">
                                                    <span @class([
                                                        'btn',
                                                        'btn-complete' => $completedPro->status == 'Completed',
                                                        'btn-onprocess' => $completedPro->status == 'On Process',
                                                        'btn-pending' => $completedPro->status == 'Pending',
                                                        'btn-rejected' => $completedPro->status == 'Rejected',
                                                    ])>{{ $completedPro->status }}
                                                    </span>
                                                </td>
                                                <td class="align-middle">{{ $completedPro->votes }}</td>
                                                <td class="align-middle">
                                                    <a href="/projects/{{ $completedPro->id }}"
                                                        class="text-decoration-none text-color-secondary"><i
                                                            class="las la-external-link-alt" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            data-bs-title="Show Detail Project"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-color-100">
                                                    <svg width="48" height="48" viewBox="0 0 84 84"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                                            fill="#EA8887" />
                                                        <path
                                                            d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                                            fill="#787878" />
                                                    </svg>
                                                    <p class="fs-14 fw-medium mt-2">No Data found!</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="pagination-container">
                                    {{ $completedProjects->onEachSide(0)->links() }}
                                </div>
                            </div>
                            <div class="table-mobile mb-30">
                                @forelse ($completedProjects as $completedPro)
                                    <div class="row {{ $loop->last ? '' : 'mb-3' }}">
                                        <div class="col">
                                            <div class="table-content-mobile">
                                                <div class="d-flex justify-content-between align-items-start mb-10">
                                                    <div class="fs-12 fw-medium text-color-80"><i
                                                            class="lar la-calendar"></i>
                                                        @if ($completedPro->date)
                                                            {{ \Carbon\Carbon::parse($completedPro->date)->format('d F Y, G:i T') }}
                                                        @else
                                                            Coming Soon
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <a href="/projects/{{ $completedPro->id }}"
                                                            class="text-decoration-none text-color-secondary">
                                                            <i class="las la-external-link-alt fs-18"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-title="Show Detail Project"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="mb5">
                                                    <span @class([
                                                        'btn',
                                                        'btn-complete' => $completedPro->status === 'Completed',
                                                        'btn-onprocess' => $completedPro->status === 'On Process',
                                                        'btn-pending' => $completedPro->status === 'Pending',
                                                        'btn-rejected' => $completedPro->status === 'Rejected',
                                                    ])> {{ $completedPro->status }}</span>
                                                </div>
                                                <div class="fs-12 mb5">
                                                    <p class="fs-12 m-0 fw-semibold text-color-100">
                                                        {{ $completedPro->project_title }}
                                                    </p>
                                                </div>
                                                <div class="fs-12 fw-medium mb5">
                                                    <span @class([
                                                        'text-color-ld' =>
                                                            $completedPro->category->category_name === 'Line Distribution',
                                                        'text-color-le' =>
                                                            $completedPro->category->category_name === 'Line Evolution',
                                                        'text-color-ad' =>
                                                            $completedPro->category->category_name === 'Album Distribution',
                                                        'text-color-ae' =>
                                                            $completedPro->category->category_name === 'Album Evolution',
                                                        'text-color-rb' =>
                                                            $completedPro->category->category_name === 'Ranking Battle',
                                                        'text-color-hs' => $completedPro->category->category_name === 'How Should',
                                                        'text-color-hw' => $completedPro->category->category_name === 'How Would',
                                                        'text-color-cd' =>
                                                            $completedPro->category->category_name === 'Center Distribution',
                                                    ])>
                                                        {{ $completedPro->category->category_name }}</span> •
                                                    <span
                                                        class="text-color-100">{{ $completedPro->type->type_name }}</span>
                                                </div>
                                                <div class="text-color-100 fs-12 fw-medium">
                                                    <i class="las la-user-alt"></i> {{ $completedPro->requester }} |
                                                    {{ $completedPro->votes }}
                                                    Votes
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
                                        <p class="fs-14 fw-medium mt-1 mb-0"></p>No Data found!
                                    </div>
                                @endforelse
                                <div class="pagination-container">
                                    {{ $completedProjects->onEachSide(0)->links() }}
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="underline-onprocess" role="tabpanel"
                            aria-labelledby="underline-onprocess-tab" tabindex="0">
                            <div class="d-flex justify-content-between">
                                <h3 class="mb-3 text-color-100">On Process Request</h3>
                            </div>
                            <div class="table-responsive d-md-block d-none">
                                <table class="table table-hover req-list-table display">
                                    <thead>
                                        <tr>
                                            <th>Project Title</th>
                                            <th>Category</th>
                                            <th>Date</th>
                                            <th>Project Type</th>
                                            <th>Requester</th>
                                            <th>Status</th>
                                            <th>Votes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($onProcessProjects as $onProcessPro)
                                            <tr>
                                                <td class="align-middle">{{ $onProcessPro->project_title }}</td>
                                                <td @class([
                                                    'align-middle',
                                                    'fw-medium',
                                                    'text-color-ad' =>
                                                        $onProcessPro->category->category_name === 'Album Distribution',
                                                    'text-color-ae' =>
                                                        $onProcessPro->category->category_name === 'Album Evolution',
                                                    'text-color-cd' =>
                                                        $onProcessPro->category->category_name === 'Center Distribution',
                                                    'text-color-hs' => $onProcessPro->category->category_name === 'How Should',
                                                    'text-color-hw' => $onProcessPro->category->category_name === 'How Would',
                                                    'text-color-ld' =>
                                                        $onProcessPro->category->category_name === 'Line Distribution',
                                                    'text-color-le' =>
                                                        $onProcessPro->category->category_name === 'Line Evolution',
                                                    'text-color-rb' =>
                                                        $onProcessPro->category->category_name === 'Ranking Battle',
                                                ])>
                                                    {{ $onProcessPro->category->category_name }}
                                                </td>
                                                <td class="align-middle"><i class="lar la-calendar"></i>
                                                    @if ($onProcessPro->date)
                                                        {{ \Carbon\Carbon::parse($onProcessPro->date)->format('d F Y, G:i T') }}
                                                    @else
                                                        Coming Soon
                                                    @endif
                                                </td>
                                                <td class="align-middle">{{ $onProcessPro->type->type_name }}</td>
                                                <td class="align-middle">{{ $onProcessPro->requester }}</td>
                                                <td class="align-middle">
                                                    <span @class([
                                                        'btn',
                                                        'btn-complete' => $onProcessPro->status == 'Completed',
                                                        'btn-onprocess' => $onProcessPro->status == 'On Process',
                                                        'btn-pending' => $onProcessPro->status == 'Pending',
                                                        'btn-rejected' => $onProcessPro->status == 'Rejected',
                                                    ])>{{ $onProcessPro->status }}
                                                    </span>
                                                </td>
                                                <td class="align-middle">{{ $onProcessPro->votes }}</td>
                                                <td class="align-middle"><a href="/projects/{{ $onProcessPro->id }}"
                                                        class="text-decoration-none text-color-secondary"><i
                                                            class="las la-external-link-alt" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            data-bs-title="Show Detail Project"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-color-100">
                                                    <svg width="48" height="48" viewBox="0 0 84 84"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                                            fill="#EA8887" />
                                                        <path
                                                            d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                                            fill="#787878" />
                                                    </svg>
                                                    <p class="fs-14 fw-medium mt-2">No Data found!</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="pagination-container">
                                    {{ $onProcessProjects->onEachSide(0)->links() }}
                                </div>
                            </div>
                            <div class="table-mobile mb-30">
                                @forelse ($onProcessProjects as $onProcessPro)
                                    <div class="row {{ $loop->last ? '' : 'mb-3' }}">
                                        <div class="col">
                                            <div class="table-content-mobile">
                                                <div class="d-flex justify-content-between align-items-start mb-10">
                                                    <div class="fs-12 fw-medium text-color-80"><i
                                                            class="lar la-calendar"></i>
                                                        @if ($onProcessPro->date)
                                                            {{ \Carbon\Carbon::parse($onProcessPro->date)->format('d F Y, G:i T') }}
                                                        @else
                                                            Coming Soon
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <a href="/projects/{{ $onProcessPro->id }}"
                                                            class="text-decoration-none text-color-secondary">
                                                            <i class="las la-external-link-alt fs-18"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-title="Show Detail Project"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="mb5">
                                                    <span @class([
                                                        'btn',
                                                        'btn-complete' => $onProcessPro->status === 'Completed',
                                                        'btn-onprocess' => $onProcessPro->status === 'On Process',
                                                        'btn-pending' => $onProcessPro->status === 'Pending',
                                                        'btn-rejected' => $onProcessPro->status === 'Rejected',
                                                    ])> {{ $onProcessPro->status }}</span>
                                                </div>
                                                <div class="fs-12 mb5">
                                                    <p class="fs-12 m-0 fw-semibold text-color-100">
                                                        {{ $onProcessPro->project_title }}
                                                    </p>
                                                </div>
                                                <div class="fs-12 fw-medium mb5">
                                                    <span @class([
                                                        'text-color-ld' =>
                                                            $onProcessPro->category->category_name === 'Line Distribution',
                                                        'text-color-le' =>
                                                            $onProcessPro->category->category_name === 'Line Evolution',
                                                        'text-color-ad' =>
                                                            $onProcessPro->category->category_name === 'Album Distribution',
                                                        'text-color-ae' =>
                                                            $onProcessPro->category->category_name === 'Album Evolution',
                                                        'text-color-rb' =>
                                                            $onProcessPro->category->category_name === 'Ranking Battle',
                                                        'text-color-hs' => $onProcessPro->category->category_name === 'How Should',
                                                        'text-color-hw' => $onProcessPro->category->category_name === 'How Would',
                                                        'text-color-cd' =>
                                                            $onProcessPro->category->category_name === 'Center Distribution',
                                                    ])>
                                                        {{ $onProcessPro->category->category_name }}</span> •
                                                    <span
                                                        class="text-color-100">{{ $onProcessPro->type->type_name }}</span>
                                                </div>
                                                <div class="text-color-100 fs-12 fw-medium">
                                                    <i class="las la-user-alt"></i> {{ $onProcessPro->requester }} |
                                                    {{ $onProcessPro->votes }}
                                                    Votes
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
                                        <p class="fs-14 fw-medium mt-1 mb-0"></p>No Data found!
                                    </div>
                                @endforelse
                                <div class="pagination-container">
                                    {{ $onProcessProjects->onEachSide(0)->links() }}
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="underline-pending" role="tabpanel"
                            aria-labelledby="underline-pending-tab" tabindex="0">
                            <div class="d-flex justify-content-between">
                                <h3 class="mb-3 text-color-100">Pending Request</h3>
                            </div>
                            <div class="table-responsive d-md-block d-none">
                                <table class="table table-hover req-list-table display" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>Project Title</th>
                                            <th>Category</th>
                                            <th>Date</th>
                                            <th>Project Type</th>
                                            <th>Requester</th>
                                            <th>Status</th>
                                            <th>Votes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pendingProjects as $pendingPro)
                                            <tr>
                                                <td class="align-middle">{{ $pendingPro->project_title }}</td>
                                                <td @class([
                                                    'align-middle',
                                                    'fw-medium',
                                                    'text-color-ad' =>
                                                        $pendingPro->category->category_name === 'Album Distribution',
                                                    'text-color-ae' =>
                                                        $pendingPro->category->category_name === 'Album Evolution',
                                                    'text-color-cd' =>
                                                        $pendingPro->category->category_name === 'Center Distribution',
                                                    'text-color-hs' => $pendingPro->category->category_name === 'How Should',
                                                    'text-color-hw' => $pendingPro->category->category_name === 'How Would',
                                                    'text-color-ld' =>
                                                        $pendingPro->category->category_name === 'Line Distribution',
                                                    'text-color-le' =>
                                                        $pendingPro->category->category_name === 'Line Evolution',
                                                    'text-color-rb' =>
                                                        $pendingPro->category->category_name === 'Ranking Battle',
                                                ])>
                                                    {{ $pendingPro->category->category_name }}
                                                </td>
                                                <td class="align-middle"><i class="lar la-calendar"></i>
                                                    @if ($pendingPro->date)
                                                        {{ \Carbon\Carbon::parse($pendingPro->date)->format('d F Y, G:i T') }}
                                                    @else
                                                        Coming Soon
                                                    @endif
                                                </td>
                                                <td class="align-middle">{{ $pendingPro->type->type_name }}</td>
                                                <td class="align-middle">{{ $pendingPro->requester }}</td>
                                                <td class="align-middle">
                                                    <span @class([
                                                        'btn',
                                                        'btn-complete' => $pendingPro->status == 'Completed',
                                                        'btn-onprocess' => $pendingPro->status == 'On Process',
                                                        'btn-pending' => $pendingPro->status == 'Pending',
                                                        'btn-rejected' => $pendingPro->status == 'Rejected',
                                                    ])>{{ $pendingPro->status }}
                                                    </span>
                                                </td>
                                                <td class="align-middle">{{ $pendingPro->votes }}</td>
                                                <td class="align-middle"><a href="/projects/{{ $pendingPro->id }}"
                                                        class="text-decoration-none text-color-secondary"><i
                                                            class="las la-external-link-alt" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            data-bs-title="Show Detail Project"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-color-100">
                                                    <svg width="48" height="48" viewBox="0 0 84 84"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                                            fill="#EA8887" />
                                                        <path
                                                            d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                                            fill="#787878" />
                                                    </svg>
                                                    <p class="fs-14 fw-medium mt-2">No Data found!</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="pagination-container">
                                    {{ $pendingProjects->onEachSide(0)->links() }}
                                </div>
                            </div>
                            <div class="table-mobile mb-30">
                                @forelse ($pendingProjects as $pendingPro)
                                    <div class="row {{ $loop->last ? '' : 'mb-3' }}">
                                        <div class="col">
                                            <div class="table-content-mobile">
                                                <div class="d-flex justify-content-between align-items-start mb-10">
                                                    <div class="fs-12 fw-medium text-color-80"><i
                                                            class="lar la-calendar"></i>
                                                        @if ($pendingPro->date)
                                                            {{ \Carbon\Carbon::parse($pendingPro->date)->format('d F Y, G:i T') }}
                                                        @else
                                                            Coming Soon
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <a href="/projects/{{ $pendingPro->id }}"
                                                            class="text-decoration-none text-color-secondary">
                                                            <i class="las la-external-link-alt fs-18"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-title="Show Detail Project"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="mb5">
                                                    <span @class([
                                                        'btn',
                                                        'btn-complete' => $pendingPro->status === 'Completed',
                                                        'btn-onprocess' => $pendingPro->status === 'On Process',
                                                        'btn-pending' => $pendingPro->status === 'Pending',
                                                        'btn-rejected' => $pendingPro->status === 'Rejected',
                                                    ])> {{ $pendingPro->status }}</span>
                                                </div>
                                                <div class="fs-12 mb5">
                                                    <p class="fs-12 m-0 fw-semibold text-color-100">
                                                        {{ $pendingPro->project_title }}
                                                    </p>
                                                </div>
                                                <div class="fs-12 fw-medium mb5">
                                                    <span @class([
                                                        'text-color-ld' =>
                                                            $pendingPro->category->category_name === 'Line Distribution',
                                                        'text-color-le' =>
                                                            $pendingPro->category->category_name === 'Line Evolution',
                                                        'text-color-ad' =>
                                                            $pendingPro->category->category_name === 'Album Distribution',
                                                        'text-color-ae' =>
                                                            $pendingPro->category->category_name === 'Album Evolution',
                                                        'text-color-rb' =>
                                                            $pendingPro->category->category_name === 'Ranking Battle',
                                                        'text-color-hs' => $pendingPro->category->category_name === 'How Should',
                                                        'text-color-hw' => $pendingPro->category->category_name === 'How Would',
                                                        'text-color-cd' =>
                                                            $pendingPro->category->category_name === 'Center Distribution',
                                                    ])>
                                                        {{ $pendingPro->category->category_name }}</span> •
                                                    <span class="text-color-100">{{ $pendingPro->type->type_name }}</span>
                                                </div>
                                                <div class="text-color-100 fs-12 fw-medium">
                                                    <i class="las la-user-alt"></i> {{ $pendingPro->requester }} |
                                                    {{ $pendingPro->votes }}
                                                    Votes
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
                                        <p class="fs-14 fw-medium mt-1 mb-0"></p>No Data found!
                                    </div>
                                @endforelse
                                <div class="pagination-container">
                                    {{ $pendingProjects->onEachSide(0)->links() }}
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="underline-rejected" role="tabpanel"
                            aria-labelledby="underline-rejected-tab" tabindex="0">
                            <h3 class="mb-2 text-color-100">Rejected Request</h3>
                            <p class="mb-3">The reason I rejected this, due some reasons.</p>
                            <div class="table-responsive d-md-block d-none">
                                <table class="table table-hover req-list-table display" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>Project Title</th>
                                            <th>Category</th>
                                            <th>Date</th>
                                            <th>Project Type</th>
                                            <th>Requester</th>
                                            <th>Status</th>
                                            <th>Votes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($rejectedProjects as $rejectedPro)
                                            <tr>
                                                <td class="align-middle">{{ $rejectedPro->project_title }}</td>
                                                <td @class([
                                                    'align-middle',
                                                    'fw-medium',
                                                    'text-color-ad' =>
                                                        $rejectedPro->category->category_name === 'Album Distribution',
                                                    'text-color-ae' =>
                                                        $rejectedPro->category->category_name === 'Album Evolution',
                                                    'text-color-cd' =>
                                                        $rejectedPro->category->category_name === 'Center Distribution',
                                                    'text-color-hs' => $rejectedPro->category->category_name === 'How Should',
                                                    'text-color-hw' => $rejectedPro->category->category_name === 'How Would',
                                                    'text-color-ld' =>
                                                        $rejectedPro->category->category_name === 'Line Distribution',
                                                    'text-color-le' =>
                                                        $rejectedPro->category->category_name === 'Line Evolution',
                                                    'text-color-rb' =>
                                                        $rejectedPro->category->category_name === 'Ranking Battle',
                                                ])>
                                                    {{ $rejectedPro->category->category_name }}
                                                </td>
                                                <td class="align-middle"><i class="lar la-calendar"></i>
                                                    @if ($rejectedPro->date)
                                                        {{ \Carbon\Carbon::parse($rejectedPro->date)->format('j F Y, G:i T') }}
                                                    @else
                                                        Coming Soon
                                                    @endif
                                                </td>
                                                <td class="align-middle">{{ $rejectedPro->type->type_name }}</td>
                                                <td class="align-middle">{{ $rejectedPro->requester }}</td>
                                                <td class="align-middle">
                                                    <span @class([
                                                        'btn',
                                                        'btn-complete' => $rejectedPro->status == 'Completed',
                                                        'btn-onprocess' => $rejectedPro->status == 'On Process',
                                                        'btn-pending' => $rejectedPro->status == 'Pending',
                                                        'btn-rejected' => $rejectedPro->status == 'Rejected',
                                                    ])>{{ $rejectedPro->status }}
                                                    </span>
                                                </td>
                                                <td class="align-middle">{{ $rejectedPro->votes }}</td>
                                                <td class="align-middle"><a href="/projects/{{ $rejectedPro->id }}"
                                                        class="text-decoration-none text-color-secondary"><i
                                                            class="las la-external-link-alt" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            data-bs-title="Show Detail Project"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-color-100">
                                                    <svg width="48" height="48" viewBox="0 0 84 84"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                                            fill="#EA8887" />
                                                        <path
                                                            d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                                            fill="#787878" />
                                                    </svg>
                                                    <p class="fs-14 fw-medium mt-2">No Data found!</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="pagination-container">
                                    {{ $rejectedProjects->onEachSide(0)->links() }}
                                </div>
                            </div>
                            <div class="table-mobile mb-30">
                                @forelse ($rejectedProjects as $rejectedPro)
                                    <div class="row {{ $loop->last ? '' : 'mb-3' }}">
                                        <div class="col">
                                            <div class="table-content-mobile">
                                                <div class="d-flex justify-content-between align-items-start mb-10">
                                                    <div class="fs-12 fw-medium text-color-80"><i
                                                            class="lar la-calendar"></i>
                                                        @if ($rejectedPro->date)
                                                            {{ \Carbon\Carbon::parse($rejectedPro->date)->format('j F Y, G:i T') }}
                                                        @else
                                                            Coming Soon
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <a href="/projects/{{ $rejectedPro->id }}"
                                                            class="text-decoration-none text-color-secondary">
                                                            <i class="las la-external-link-alt fs-18"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-title="Show Detail Project"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="mb5">
                                                    <span @class([
                                                        'btn',
                                                        'btn-complete' => $rejectedPro->status === 'Completed',
                                                        'btn-onprocess' => $rejectedPro->status === 'On Process',
                                                        'btn-pending' => $rejectedPro->status === 'Pending',
                                                        'btn-rejected' => $rejectedPro->status === 'Rejected',
                                                    ])> {{ $rejectedPro->status }}</span>
                                                </div>
                                                <div class="fs-12 mb5">
                                                    <p class="fs-12 m-0 fw-semibold text-color-100">
                                                        {{ $rejectedPro->project_title }}
                                                    </p>
                                                </div>
                                                <div class="fs-12 fw-medium mb5">
                                                    <span @class([
                                                        'text-color-ld' =>
                                                            $rejectedPro->category->category_name === 'Line Distribution',
                                                        'text-color-le' =>
                                                            $rejectedPro->category->category_name === 'Line Evolution',
                                                        'text-color-ad' =>
                                                            $rejectedPro->category->category_name === 'Album Distribution',
                                                        'text-color-ae' =>
                                                            $rejectedPro->category->category_name === 'Album Evolution',
                                                        'text-color-rb' =>
                                                            $rejectedPro->category->category_name === 'Ranking Battle',
                                                        'text-color-hs' => $rejectedPro->category->category_name === 'How Should',
                                                        'text-color-hw' => $rejectedPro->category->category_name === 'How Would',
                                                        'text-color-cd' =>
                                                            $rejectedPro->category->category_name === 'Center Distribution',
                                                    ])>
                                                        {{ $rejectedPro->category->category_name }}</span> •
                                                    <span
                                                        class="text-color-100">{{ $rejectedPro->type->type_name }}</span>
                                                </div>
                                                <div class="text-color-100 fs-12 fw-medium">
                                                    <i class="las la-user-alt"></i> {{ $rejectedPro->requester }} |
                                                    {{ $rejectedPro->votes }}
                                                    Votes
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
                                        <p class="fs-14 fw-medium mt-1 mb-0"></p>No Data found!
                                    </div>
                                @endforelse
                                <div class="pagination-container">
                                    {{ $rejectedProjects->onEachSide(0)->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
