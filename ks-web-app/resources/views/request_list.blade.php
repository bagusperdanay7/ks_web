@extends('layouts.main')
@if (session()->has('requestSuccess'))
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
                        {{ session('requestSuccess') }}
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
                                <h2>{{ $projectCompletedNumber }} / {{ $numberRequestWithOutRejected }}</h2>
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

    <section id="table-request-list">
        <div class="row">
            <div class="col">
                <div class="req-list-section">
                    <form action="/request-list" name="request-list-filter" method="GET" class="mb-4">
                        <div class="filter-group">
                            <div class="row justify-content-between">
                                <div class="col-12 mb-4 mb-sm-3 mb-xl-0 col-xl-auto">
                                    <div class="row">
                                        <div class="col-12 col-sm-6 col-lg col-xl-auto mb-3 mb-lg-0">
                                            <label for="category"
                                                class="form-label fs-14 fw-medium text-color-100 mb5 d-xl-none mb-xl-0">Category</label>
                                            <select class="form-select filter-select" aria-label="Select Category"
                                                name="category" onchange="if(this.value != '') { this.form.submit(); }"
                                                id="category">
                                                <option value="">Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->slug }}"
                                                        {{ request('category') == $category->slug ? ' selected' : ' ' }}>
                                                        {{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg col-xl-auto mb-3 mb-lg-0">
                                            @php
                                                $statusProjects = ['Completed', 'On Process', 'Pending', 'Rejected'];
                                            @endphp
                                            <label for="status"
                                                class="form-label fs-14 fw-medium text-color-100 mb5 d-xl-none mb-xl-0">Status</label>
                                            <select class="form-select filter-select" aria-label="Select Status"
                                                name="status" id="status"
                                                onchange="if(this.value != '') { this.form.submit(); }">
                                                <option value="">Status</option>
                                                @foreach ($statusProjects as $status)
                                                    <option value="{{ $status }}"
                                                        {{ request('status') == $status ? ' selected' : ' ' }}>
                                                        {{ $status }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg col-xl-auto mb-3 mb-sm-2 mb-lg-0">
                                            <label for="type"
                                                class="form-label fs-14 fw-medium text-color-100 mb5 d-xl-none mb-xl-0">Type</label>
                                            <select class="form-select filter-select" aria-label="Select Type"
                                                name="type" id="type"
                                                onchange="if(this.value != '') { this.form.submit(); }">
                                                <option value="">Type</option>
                                                @foreach ($types as $type)
                                                    <option value="{{ $type->slug }}"
                                                        {{ request('type') == $type->slug ? ' selected' : ' ' }}>
                                                        {{ $type->type_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg col-xl-auto">
                                            <label for="sort"
                                                class="form-label fs-14 fw-medium text-color-100 mb5 d-xl-none mb-xl-0">Sort</label>
                                            <select class="form-select filter-select" aria-label="Select Sort"
                                                name="sort" id="sort"
                                                onchange="if(this.value != '') { this.form.submit(); }">
                                                <option value="">Sort By</option>
                                                <optgroup label="Title">
                                                    <option value="title_asc"
                                                        {{ request('sort') == 'title_asc' ? ' selected' : '' }}>
                                                        Ascending</option>
                                                </optgroup>
                                                <optgroup label="Date">
                                                    <option value="latest"
                                                        {{ request('sort') == 'latest' ? ' selected' : '' }}>
                                                        Latest
                                                    </option>
                                                    <option value="oldest"
                                                        {{ request('sort') == 'oldest' ? ' selected' : '' }}>
                                                        Oldest
                                                    </option>
                                                </optgroup>
                                                <optgroup label="Votes">
                                                    <option value="most"
                                                        {{ request('sort') == 'most' ? ' selected' : '' }}>
                                                        Most
                                                    </option>
                                                    <option value="least"
                                                        {{ request('sort') == 'least' ? ' selected' : '' }}>
                                                        Least
                                                    </option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-3">
                                    <div class="input-group">
                                        <span class="input-group-text bg-second"><i class='bx bx-search fs-18'></i></span>
                                        <input type="search" class="form-control filter-search border-left-0"
                                            list="datalistOptions" id="projectTitleList"
                                            placeholder="Search Project Title" name="search" autocomplete="off"
                                            aria-label="Search Filter by Project Title" value="{{ request('search') }}">
                                    </div>
                                    <datalist id="datalistOptions">
                                        @foreach ($allProjectTitle as $projectTitleItem)
                                            <option value="{{ $projectTitleItem->project_title }}">
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>
                            @if (request('category') || request('sort') || request('status') || request('search') || request('type') )
                                <div class="row mt-2">
                                    <div class="filter-clear text-end">
                                        <a href="{{ route('request-list') }}"
                                            class="fs-14 font-inter text-decoration-none text-color-100 fw-medium">
                                            <i class="las la-times-circle"></i> Clear Filter
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </form>

                    <div class="table-responsive d-md-block d-none">
                        <table class="table table-hover req-list-table display" id="request-list-table">
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
                                        <td class="align-middle"><a href="/projects/{{ $project->project_id }}"
                                                class="text-decoration-none text-color-primary"><i
                                                    class="las la-external-link-alt" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Show Detail Project"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-color-100">
                                            <svg width="48" height="48" viewBox="0 0 84 84" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
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
                                            <div class="fs-12 fw-medium text-color-80"><i class="lar la-calendar"></i>
                                                @if ($project->date)
                                                    {{ \Carbon\Carbon::parse($project->date)->format('d F Y, G:i T') }}
                                                @else
                                                    Coming Soon
                                                @endif
                                            </div>
                                            <div>
                                                <a href="/projects/{{ $project->project_id }}"
                                                    class="text-decoration-none text-color-primary">
                                                    <i class="las la-external-link-alt fs-18" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-title="Show Detail Project"></i>
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
                        <div class="pagination-container mt-3">
                            {{ $projects->onEachSide(0)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
