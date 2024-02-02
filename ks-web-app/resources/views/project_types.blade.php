@extends('layouts.main')

@section('content')
    <nav class="mb-15"
        style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb fs-sm-12">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('projects') }}">Projects</a></li>
            <li class="breadcrumb-item breadcumb-active" aria-current="page">
                {{ $projectType->type_name }}
            </li>
        </ol>
    </nav>
    <section id="banner-project">
        @if ($projectType->type_name === 'Non-Project')
            <div class="row">
                <div class="col">
                    <div class="non-project-hero">
                        <h2 class="mb-15">{{ $projectType->type_name }}</h2>
                        <p class="non-project-text mb-15">{{ $projectType->about }}</p>
                        <a href="#project-type-table-section" class="btn btn-non-project d-grid d-md-inline-block">View
                            Details</a>
                    </div>
                </div>
            </div>
        @elseif ($projectType->type_name === 'Huge Project Vol.#01')
            <div class="row huge-project-vol1-hero">
                <div class="col-12 mb-3 col-lg-6 align-self-center order-2 order-lg-1">
<<<<<<< HEAD
                    <h2 class="mb-3">{{ $projectType->type_name }}</h2>
                    <p class="huge-project-vol1-text">{{ $projectType->about }}</p>
=======
                    <h2 class="mb-3">Huge Project Vol.#01</h2>
                    <p class="huge-project-vol1-text">Huge Project Vol.#01 is a project based on Google Forms requests,
                        where the
                        content
                        will
                        be the line evolution of
                        the female group of your choice</p>
>>>>>>> f18853d370fd6012683fb0fcdcc189fe71f044e4
                    <a href="#project-type-table-section" class="btn btn-huge-project-vol1 d-grid d-lg-inline-block">View
                        Details</a>
                </div>
                <div class="col-12 col-lg-6 order-1 order-lg-2 mb-lg-15">
                    <img src="{{ asset('img/huge-pro-hero.png') }}" alt="Banner Huge Project" class="float-end"
                        width="100%">
                </div>
            </div>
        @elseif ($projectType->type_name === 'Nostalgic Vibes')
            <div class="row nv-project-hero align-items-center">
                <div class="col">
<<<<<<< HEAD
                    <h2 class="mb-3">{{ $projectType->type_name }}/h2>
                    <p class="nv-project-text">{{ $projectType->about }}</p>
=======
                    <h2 class="mb-3">Nostalgic Vibes</h2>
                    <p class="nv-project-text">Nostalgic Vibes is a project that is planned to be uploaded every weekend.
                        Where the
                        video contains the line distribution of old songs.</p>
>>>>>>> f18853d370fd6012683fb0fcdcc189fe71f044e4
                    <a href="#project-type-table-section" class="btn btn-nv-project d-grid d-lg-inline-block">View
                        Details</a>
                </div>
            </div>
        @elseif ($projectType->type_name === 'Youtube Comment')
            <div class="row youtube-project-hero">
                <div class="col-12 col-lg-6 order-2 order-lg-1">
<<<<<<< HEAD
                    <h2 class="mb-3">{{ $projectType->type_name }}</h2>
                    <p class="youtube-project-text">{{ $projectType->about }}</p>
=======
                    <h2 class="mb-3">Youtube Comments</h2>
                    <p class="youtube-project-text">This project is retrieved from youtube comments.</p>
>>>>>>> f18853d370fd6012683fb0fcdcc189fe71f044e4
                    <a href="#project-type-table-section" class="btn btn-youtube-project d-grid d-md-inline-block">View
                        Details</a>
                </div>
                <div class="col-12 col-lg-6 order-1 order-lg-2 mb-lg-15">
                    <img src="{{ asset('img/Untitled.png') }}" alt="Banner Image Youtube Comments Project" class="float-end"
                        width="100%">
                </div>
            </div>
        @endif
    </section>

    <section id="data-table-section">
        <div class="row" id="project-type-table-section">
            <div class="col">
                <div class="table-card d-md-block d-none">
                    <div
                        class="d-flex justify-content-between {{ request('status') || request('sort') ? 'mb-2' : 'mb-4' }}">
                        <h3 class="m-0 align-self-center">{{ $projectType->type_name }}</h3>
                        <div>
                            <form action="/projects-type/{{ $projectType->slug }}" name="type-form-filter">
                                <div class="filter-group">
                                    <div class="row">
                                        <div class="col-auto">
                                            @php
                                                $statusProjects = ['Completed', 'On Process', 'Pending', 'Rejected'];
                                            @endphp
                                            <select class="form-select filter-select" aria-label="Select Status"
                                                name="status" onchange="if(this.value != '') { this.form.submit(); }">
                                                <option value="">Status</option>
                                                @foreach ($statusProjects as $status)
                                                    <option value="{{ $status }}"
                                                        {{ request('status') == $status ? ' selected' : ' ' }}>
                                                        {{ $status }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-auto">
                                            <select class="form-select filter-select" aria-label="Select Sort"
                                                name="sort" onchange="if(this.value != '') { this.form.submit(); }">
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
                                                        {{ request('sort') == 'most' ? ' selected' : '' }}>Most
                                                    </option>
                                                    <option value="least"
                                                        {{ request('sort') == 'least' ? ' selected' : '' }}>
                                                        Least
                                                    </option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    @if (request('status') || request('sort'))
                                        <div class="row mt-2">
                                            <div class="filter-clear text-end">
                                                <a href="/projects-type/{{ $projectType->slug }}"
                                                    class="fs-14 font-inter text-decoration-none text-color-100 fw-medium">
                                                    <i class="las la-times-circle"></i> Clear Filter
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover projects-table">
                            <thead>
                                <tr>
                                    <th>Project Title</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                    <th>Requester</th>
                                    <th>Status</th>
                                    <th>Votes</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!request('sort') && !request('status'))
                                    @forelse ($projectTypes->projects as $pro)
                                        <tr>
                                            <td class="align-middle fw-medium text-color-100">{{ $pro->project_title }}
                                            </td>
                                            <td @class([
                                                'align-middle',
                                                'fw-medium',
                                                'text-color-ld' => $pro->category->category_name === 'Line Distribution',
                                                'text-color-le' => $pro->category->category_name === 'Line Evolution',
                                                'text-color-ad' => $pro->category->category_name === 'Album Distribution',
                                                'text-color-ae' => $pro->category->category_name === 'Album Evolution',
                                                'text-color-rb' => $pro->category->category_name === 'Ranking Battle',
                                                'text-color-hs' => $pro->category->category_name === 'How Should',
                                                'text-color-hw' => $pro->category->category_name === 'How Would',
                                                'text-color-cd' => $pro->category->category_name === 'Center Distribution',
                                            ])>
                                                {{ $pro->category->category_name }}
                                            </td>
                                            @if ($pro->date)
                                                <td class="align-middle text-color-100"><i class="lar la-calendar"></i>
                                                    {{ \Carbon\Carbon::parse($pro->date)->format('d F Y, G:i T') }}
                                                </td>
                                            @else
                                                <td class="align-middle text-color-100"><i class="lar la-calendar"></i>
                                                    Coming Soon
                                                </td>
                                            @endif

                                            <td class="align-middle text-color-100">{{ $pro->requester }}</td>
                                            <td class="align-middle">
                                                <span @class([
                                                    'btn',
                                                    'btn-complete' => $pro->status == 'Completed',
                                                    'btn-onprocess' => $pro->status == 'On Process',
                                                    'btn-pending' => $pro->status == 'Pending',
                                                    'btn-rejected' => $pro->status == 'Rejected',
                                                ]) class="btn btn-complete">
                                                    {{ $pro->status }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-color-100">{{ $pro->votes }}</td>
                                            <td class="align-middle">
                                                <a href="/projects/{{ $pro->id }}"
                                                    class="text-decoration-none text-color-secondary"
                                                    aria-label="Details about {{ $pro->project_title }}"><i
                                                        class="las la-external-link-alt" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-title="Show Detail Project"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center no-data-val">
                                                <i class="las la-ban"></i> No Project Found
                                            </td>
                                        </tr>
                                    @endforelse
                                @else
                                    @forelse ($projectTypes as $pro)
                                        <tr>
                                            <td class="align-middle fw-medium text-color-100">{{ $pro->project_title }}
                                            </td>
                                            <td @class([
                                                'align-middle',
                                                'fw-medium',
                                                'text-color-ld' => $pro->category->category_name === 'Line Distribution',
                                                'text-color-le' => $pro->category->category_name === 'Line Evolution',
                                                'text-color-ad' => $pro->category->category_name === 'Album Distribution',
                                                'text-color-ae' => $pro->category->category_name === 'Album Evolution',
                                                'text-color-rb' => $pro->category->category_name === 'Ranking Battle',
                                                'text-color-hs' => $pro->category->category_name === 'How Should',
                                                'text-color-hw' => $pro->category->category_name === 'How Would',
                                                'text-color-cd' => $pro->category->category_name === 'Center Distribution',
                                            ])>
                                                {{ $pro->category->category_name }}
                                            </td>
                                            @if ($pro->date)
                                                <td class="align-middle text-color-100"><i class="lar la-calendar"></i>
                                                    {{ \Carbon\Carbon::parse($pro->date)->format('d F Y, G:i T') }}
                                                </td>
                                            @else
                                                <td class="align-middle text-color-100"><i class="lar la-calendar"></i>
                                                    Coming Soon
                                                </td>
                                            @endif

                                            <td class="align-middle text-color-100">{{ $pro->requester }}</td>
                                            <td class="align-middle">
                                                <span @class([
                                                    'btn',
                                                    'btn-complete' => $pro->status == 'Completed',
                                                    'btn-onprocess' => $pro->status == 'On Process',
                                                    'btn-pending' => $pro->status == 'Pending',
                                                    'btn-rejected' => $pro->status == 'Rejected',
                                                ]) class="btn btn-complete">
                                                    {{ $pro->status }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-color-100">{{ $pro->votes }}</td>
                                            <td class="align-middle"><a href="/projects/{{ $pro->id }}"
                                                    class="text-decoration-none text-color-primary" aria-label="Details about {{ $pro->project_title }}"><i
                                                        class="las la-external-link-alt" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        data-bs-title="Show Detail Project"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center no-data-val">
                                                <i class="las la-ban"></i> No Project Found
                                            </td>
                                        </tr>
                                    @endforelse
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="table-mobile">
                    <div class="row">
                        <div class="col">
                            <h3 class="m-0 align-self-center text-color-100 fw-semibold">{{ $projectType->type_name }}
                            </h3>
                            <div class="mt-15 mb-4">
                                <form action="/projects-type/{{ $projectType->slug }}" name="type-form-filter-mobile">
                                    <div class="filter-group">
                                        <div class="row">
                                            <div class="col-6">
                                                <select class="form-select filter-select" aria-label="Select Status"
                                                    name="status"
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
                                            <div class="col-6">
                                                <select class="form-select filter-select" aria-label="Select Sort"
                                                    name="sort"
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
                                                            {{ request('sort') == 'most' ? ' selected' : '' }}>Most
                                                        </option>
                                                        <option value="least"
                                                            {{ request('sort') == 'least' ? ' selected' : '' }}>
                                                            Least
                                                        </option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        @if (request('status') || request('sort'))
                                            <div class="row mt-2">
                                                <div class="filter-clear text-end">
                                                    <a href="/projects-type/{{ $projectType->slug }}"
                                                        class="fs-14 font-inter text-decoration-none text-color-100 fw-medium">
                                                        <i class="las la-times-circle"></i> Clear Filter
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if (!request('sort') && !request('status'))
                        @forelse ($projectType->projects as $pro)
                            <div class="row {{ $loop->last ? '' : 'mb-3' }}">
                                <div class="col">
                                    <div class="table-content-mobile bg-second">
                                        <div class="d-flex justify-content-between align-items-start mb-10">
                                            @if ($pro->date)
                                                <div class="fs-14 fw-medium text-color-80"><i class="lar la-calendar"></i>
                                                    {{ \Carbon\Carbon::parse($pro->date)->format('j F Y, G:i T') }}
                                                </div>
                                            @else
                                                <div class="fs-14 fw-medium text-color-80"><i class="lar la-calendar"></i>
                                                    Coming Soon
                                                </div>
                                            @endif
                                            <div>
                                                <a href="/projects/{{ $pro->id }}"
                                                    class="text-decoration-none text-color-primary" aria-label="Details about {{ $pro->project_title }}">
                                                    <i class="las la-external-link-alt fs-18" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-title="Show Detail Project"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mb5">
                                            <span @class([
                                                'btn',
                                                'btn-complete' => $pro->status === 'Completed',
                                                'btn-onprocess' => $pro->status === 'On Process',
                                                'btn-pending' => $pro->status === 'Pending',
                                                'btn-rejected' => $pro->status === 'Rejected',
                                            ])> {{ $pro->status }}</span>
                                        </div>
                                        <div class="mb5">
                                            <p class="fs-14 m-0 fw-semibold text-color-100">
                                                {{ $pro->project_title }}
                                            </p>
                                        </div>
                                        <div class="fs-14 fw-medium mb5">
                                            <span @class([
                                                'text-color-ld' => $pro->category->category_name === 'Line Distribution',
                                                'text-color-le' => $pro->category->category_name === 'Line Evolution',
                                                'text-color-ad' => $pro->category->category_name === 'Album Distribution',
                                                'text-color-ae' => $pro->category->category_name === 'Album Evolution',
                                                'text-color-rb' => $pro->category->category_name === 'Ranking Battle',
                                                'text-color-hs' => $pro->category->category_name === 'How Should',
                                                'text-color-hw' => $pro->category->category_name === 'How Would',
                                                'text-color-cd' => $pro->category->category_name === 'Center Distribution',
                                            ])>
                                                {{ $pro->category->category_name }}</span>
                                        </div>
                                        <div class="text-color-100 fs-14 fw-medium">
                                            <i class="las la-user-alt"></i> {{ $pro->requester }} |
                                            {{ $pro->votes }}
                                            Votes
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col text-center no-data-val text-color-100">
                                <i class="las la-ban"></i> No Project Found
                            </div>
                        @endforelse
                    @else
                        @forelse ($projectTypes as $pro)
                            <div class="row {{ $loop->last ? '' : 'mb-3' }}">
                                <div class="col">
                                    <div class="table-content-mobile bg-second">
                                        <div class="d-flex justify-content-between align-items-start mb-10">
                                            @if ($pro->date)
                                                <div class="fs-14 fw-medium text-color-80"><i class="lar la-calendar"></i>
                                                    {{ \Carbon\Carbon::parse($pro->date)->format('j F Y, G:i T') }}
                                                </div>
                                            @else
                                                <div class="fs-14 fw-medium text-color-80"><i class="lar la-calendar"></i>
                                                    Coming Soon
                                                </div>
                                            @endif
                                            <div>
                                                <a href="/projects/{{ $pro->id }}"
                                                    class="text-decoration-none text-color-primary" aria-label="Details about {{ $pro->project_title }}">
                                                    <i class="las la-external-link-alt fs-18" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-title="Show Detail Project"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mb5">
                                            <span @class([
                                                'btn',
                                                'btn-complete' => $pro->status === 'Completed',
                                                'btn-onprocess' => $pro->status === 'On Process',
                                                'btn-pending' => $pro->status === 'Pending',
                                                'btn-rejected' => $pro->status === 'Rejected',
                                            ])> {{ $pro->status }}</span>
                                        </div>
                                        <div class="mb5">
                                            <p class="fs-14 m-0 fw-semibold text-color-100">
                                                {{ $pro->project_title }}
                                            </p>
                                        </div>
                                        <div class="fs-14 fw-medium mb5">
                                            <span @class([
                                                'text-color-ld' => $pro->category->category_name === 'Line Distribution',
                                                'text-color-le' => $pro->category->category_name === 'Line Evolution',
                                                'text-color-ad' => $pro->category->category_name === 'Album Distribution',
                                                'text-color-ae' => $pro->category->category_name === 'Album Evolution',
                                                'text-color-rb' => $pro->category->category_name === 'Ranking Battle',
                                                'text-color-hs' => $pro->category->category_name === 'How Should',
                                                'text-color-hw' => $pro->category->category_name === 'How Would',
                                                'text-color-cd' => $pro->category->category_name === 'Center Distribution',
                                            ])>
                                                {{ $pro->category->category_name }}</span>
                                        </div>
                                        <div class="text-color-100 fs-14 fw-medium">
                                            <i class="las la-user-alt"></i> {{ $pro->requester }} |
                                            {{ $pro->votes }}
                                            Votes
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col text-center no-data-val text-color-100">
                                <i class="las la-ban"></i> No Project Found
                            </div>
                        @endforelse
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
