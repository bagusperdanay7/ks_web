@extends('layouts.main')

@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb" class="mb-15">
        <ol class="breadcrumb fs-sm-12">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/gallery">Gallery</a></li>
            <li class="breadcrumb-item"><a href="/gallery/artists">Artists</a></li>
            <li class="breadcrumb-item breadcumb-active" aria-current="page">{{ $artist->artist_name }}
            </li>
        </ol>
    </nav>

    <section id="artist-detail" class="mb-50">
        <div class="row mb-6">
            <div class="col-12 col-md-6 col-lg-5 col-xl-4 mb-xl-0 mb-15">
                @if ($artist->artist_picture)
                    <img src="{{ asset('storage/' . $artist->artist_picture) }}"
                        class="img-square rounded-10 img-fluid w-100 shadow" alt="{{ $artist->artist_pict }} picture">
                @else
                    <img src="{{ asset('img/unknown_artist.jpg') }}" class="img-square rounded-10 img-fluid w-100 shadow"
                        alt="{{ $artist->artist_picture }} picture">
                @endif
            </div>

            <div class="col-12 col-md-6 col-lg-7 col-xl-8 align-self-center">
                <h2 class="fw-bold text-color-100 fs-sm-24 mb-10">{{ $artist->artist_name }}</h2>
                <p class="artist-about">{{ $artist->about }}</p>
                <div class="row mb-10">
                    <div class="col-5 col-lg-4 col-xl-3 col-xxl-2">
                        <h4 class="fs-16 fw-medium text-color-100 fs-lg-14 m-0">Debut</h4>
                    </div>
                    <div class="col">
                        <p class="text-color-100 fs-lg-14 m-0">{{ \Carbon\Carbon::parse($artist->birthdate)->format('d F Y') }}
                        </p>
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-5 col-lg-4 col-xl-3 col-xxl-2">
                        <h4 class="fs-16 fw-medium text-color-100 fs-lg-14 m-0">Fandom Name</h4>
                    </div>
                    <div class="col">
                        <p class="text-color-100 fs-lg-14 m-0">{{ $artist->fandom }}</p>
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-5 col-lg-4 col-xl-3 col-xxl-2">
                        <h4 class="fs-16 fw-medium text-color-100 fs-lg-14 m-0">Origin</h4>
                    </div>
                    <div class="col">
                        <p class="text-color-100 fs-lg-14 m-0">{{ $artist->origin }}</p>
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-5 col-lg-4 col-xl-3 col-xxl-2">
                        <h4 class="fs-16 fw-medium text-color-100 fs-lg-14 m-0">Company</h4>
                    </div>
                    <div class="col">
                        <p class="text-color-100 fs-lg-14 m-0">{{ $artist->company->name }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5 col-lg-4 col-xl-3 col-xxl-2">
                        <h4 class="fs-16 fw-medium text-color-100 fs-lg-14 m-0">Total Video</h4>
                    </div>
                    <div class="col">
                        <p class="text-color-100 fs-lg-14 m-0">{{ $artistVideos }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-5" id="video-artist">
        @forelse ($projectsByGroup as $projectByGroup)
            <div class="row {{ $loop->last ? '' : 'mb-50' }}">
                <h3 class="fw-semibold text-color-100 mb-10">{{ $projectByGroup->first()->category->category_name }}</h3>
                @forelse ($projectByGroup as $project)
                    <div class="col-12 col-md-6 col-lg-4 {{ $loop->last ? '' : 'mb-15' }}">
                        <div class="video-card">
                            <a href="/gallery/videos/{{ $project->id }}">
                                @if ($project->youtube_id)
                                    <img src="{{ 'https://i3.ytimg.com/vi/' . $project->youtube_id . '/maxresdefault.jpg' }}" class="thumbnail m-0 p-0 img-fluid"
                                        alt="{{ $project->title }} thumbnail">
                                @else
                                    <img src="{{ asset('img/no_thumbnail.jpg') }}" class="thumbnail m-0 p-0 img-fluid"
                                        alt="{{ $project->title }} thumbnail">
                                @endif
                                <div class="video-desc-card">
                                    <a href="/gallery?category={{ $project->category->slug }}">
                                        <p @class([
                                            'mb5',
                                            'fs-14',
                                            'font-inter',
                                            'fw-semibold',
                                            'text-color-ad' =>
                                                $project->category->category_name === 'Album Distribution',
                                            'text-color-ae' => $project->category->category_name === 'Total Line Evolution',
                                            'text-color-cd' =>
                                                $project->category->category_name === 'Center Distribution',
                                            'text-color-hs' => $project->category->category_name === 'How Should',
                                            'text-color-hw' => $project->category->category_name === 'How Would',
                                            'text-color-ld' =>
                                                $project->category->category_name === 'Line Distribution',
                                            'text-color-le' => $project->category->category_name === 'Line Evolution',
                                            'text-color-rb' => $project->category->category_name === 'Ranking Battle',
                                            'text-info' => $project->category->category_name === 'Other',
                                        ])>
                                            {{ $project->category->category_name }}
                                        </p>
                                    </a>
                                    <h4>{{ $project->title }}</h4>
                                    <p class="date-text mb-0">
                                        {{ \Carbon\Carbon::createFromTimeStamp(strtotime($project->date))->diffForHumans() }}
                                        &#8226; <a href="/gallery?type={{ $project->projectType->slug }}"
                                            class="p-0 m-0 text-decoration-none"><span
                                                class="type-tag">{{ $project->projectType->type_name }}</span>
                                        </a>
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-color-100 text-center">
                            <i class="las la-photo-video fs-1"></i>
                            <p class="mt-1 fs-14 fw-medium mb-0">
                                No Video Found!
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>
        @empty
            <div class="row">
                <div class="col">
                    <div class="text-color-100 text-center">
                        <i class="las la-photo-video fs-1"></i>
                        <p class="mt-1 fs-14 fw-medium mb-0">
                            No Video Found!
                        </p>
                    </div>
                </div>
            </div>
        @endforelse
    </section>
@endsection
