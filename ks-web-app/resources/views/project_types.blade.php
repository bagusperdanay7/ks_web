@extends('layouts.main')

@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb" class="space-navbar">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('projects') }}">Projects</a></li>
            <li class="breadcrumb-item breadcumb-active" aria-current="page">{{ $projectType->first()->type->type_name }}
            </li>
        </ol>
    </nav>
    <section id="banner-project">
        @if ($projectType->first()->type->type_name === 'Non-Project')
            <div class="row non-pro-hero">
                <div class="col">
                    <h2 class="mb-3">{{ $projectType->first()->type->type_name }}</h2>
                    <p class="non-pro-text">{{ $projectType->first()->type->about }}</p>
                    <a href="#project-type-table-section" class="btn btn-non-project">View Details</a>
                </div>
            </div>
        @elseif ($projectType->first()->type->type_name === 'Huge Project Vol.#01')
            <div class="row huge-pro-hero">
                <div class="col-12 mb-3 col-md-6 align-self-center">
                    <h2 class="mb-3">Huge Project Vol.#01</h2>
                    <p class="huge-pro-text">Huge Project Vol.#01 is a project based on Google Forms requests, where the
                        content
                        will
                        be the line evolution of
                        the female group of your choice</p>
                    <a href="#project-type-table-section" class="btn btn-huge-project-vol1">View Details</a>
                </div>

                <div class="col-12 col-md-6">
                    <img src="{{ asset('img/huge-pro-hero.png') }}" alt="" class="float-end" width="100%">
                </div>
            </div>
        @elseif ($projectType->first()->type->type_name === 'Nostalgic Vibes')
            <div class="row nv-pro-hero align-items-center">
                <div class="col">
                    <h2 class="mb-3">Nostalgic Vibes</h2>
                    <p class="nv-pro-text">Nostalgic Vibes is a project that is planned to be uploaded every weekend.
                        Where the
                        video contains the line distribution of old songs.</p>
                    <a href="#project-type-table-section" class="btn btn-nv-project">View Details</a>
                </div>
            </div>
        @elseif ($projectType->first()->type->type_name === 'Youtube Comment')
            <div class="row yt-pro-hero">
                <div class="col">
                    <h2 class="mb-3">Youtube Comments</h2>
                    <p class="yt-pro-text">This project is retrieved from youtube comments.</p>
                    <a href="#project-type-table-section" class="btn btn-yt-project">View Details</a>
                </div>
                <div class="col">
                    <img src="{{ asset('img/Untitled.png') }}" alt="" class="float-end" width="100%">
                </div>
            </div>
        @endif
    </section>

    <section id="data-table-section">
        <div class="row" id="project-type-table-section">
            <div class="col">
                <div class="project-section">
                    <div class="d-flex justify-content-between">
                        <h3>{{ $projectType->first()->type->type_name }}</h3>
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
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($projectType as $type)
                                    <tr>
                                        <td class="align-middle">{{ $type->project_title }}</td>
                                        @if ($type->category->category_name === 'Line Distribution')
                                            <td class="align-middle category-text-ld">
                                                {{ $type->category->category_name }}
                                            </td>
                                        @elseif ($type->category->category_name === 'Line Evolution')
                                            <td class="align-middle category-text-le">
                                                {{ $type->category->category_name }}
                                            </td>
                                        @elseif ($type->category->category_name === 'Album Distribution')
                                            <td class="align-middle category-text-ad">
                                                {{ $type->category->category_name }}
                                            </td>
                                        @elseif ($type->category->category_name === 'Album Evolution')
                                            <td class="align-middle category-text-ae">
                                                {{ $type->category->category_name }}
                                            </td>
                                        @elseif ($type->category->category_name === 'Ranking Battle')
                                            <td class="align-middle category-text-rb">
                                                {{ $type->category->category_name }}
                                            </td>
                                        @elseif ($type->category->category_name === 'How Should')
                                            <td class="align-middle category-text-hs">
                                                {{ $type->category->category_name }}
                                            </td>
                                        @elseif ($type->category->category_name === 'How Would')
                                            <td class="align-middle category-text-hw">
                                                {{ $type->category->category_name }}
                                            </td>
                                        @elseif ($type->category->category_name === 'Center Distribution')
                                            <td class="align-middle category-text-cd">
                                                {{ $type->category->category_name }}
                                            </td>
                                        @endif
                                        <td class="align-middle"><i class="lar la-calendar"></i>
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $type->date)->format('d F Y') }}
                                        </td>
                                        <td class="align-middle">{{ $type->requester }}</td>
                                        @if ($type->status == 'Completed')
                                            <td class="align-middle">
                                                <span class="btn btn-complete">
                                                    {{ $type->status }}
                                                </span>
                                            </td>
                                        @elseif ($type->status == 'On Process')
                                            <td class="align-middle">
                                                <span class="btn btn-onprocess">
                                                    {{ $type->status }}
                                                </span>
                                            </td>
                                        @elseif ($type->status == 'Pending')
                                            <td class="align-middle">
                                                <span class="btn btn-pending">
                                                    {{ $type->status }}
                                                </span>
                                            </td>
                                        @elseif ($type->status == 'Rejected')
                                            <td class="align-middle">
                                                <span class="btn btn-rejected">
                                                    {{ $type->status }}
                                                </span>
                                            </td>
                                        @else
                                            <td class="align-middle">
                                                <span class="btn btn-onprocess">
                                                    {{ $type->status }}
                                                </span>
                                            </td>
                                        @endif
                                        <td class="align-middle">{{ $type->votes }}</td>
                                        <td class="align-middle"><a href="/projects/{{ $type->id }}"
                                                class="text-decoration-none"><i class="las la-external-link-alt"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-title="Show Detail Project"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center no-data-val">
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
    </section>
@endsection
