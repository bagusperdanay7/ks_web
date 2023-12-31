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
                @if ($artist->artist_pict === null)
                    <img src="{{ asset('img/unknown_artist.jpg') }}" class="img-square rounded-10 shadow img-fluid"
                        alt="{{ $artist->artist_pict }} picture">
                @else
                    <img src="{{ asset('storage/' . $artist->artist_pict) }}" class="img-square rounded-10 shadow img-fluid"
                        alt="{{ $artist->artist_pict }} picture">
                @endif

            </div>
            <div class="col-12 col-md-6 col-lg-7 col-xl-8 align-self-center">
                <h2 class="fw-bold text-color-100 mb-10 fs-sm-24">{{ $artist->artist_name }}</h2>
                <p class="artist-about">{{ $artist->about }}</p>
                <div class="row mb-10">
                    <div class="col-5 col-lg-4 col-xl-3 col-xxl-2">
                        <h4 class="fs-16 fw-medium text-color-100 m-0 fs-lg-14">Debut</h4>
                    </div>
                    <div class="col">
                        <p class="m-0 text-color-100 fs-lg-14">{{ \Carbon\Carbon::parse($artist->debut)->format('d F Y') }}
                        </p>
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-5 col-lg-4 col-xl-3 col-xxl-2">
                        <h4 class="fs-16 fw-medium text-color-100 m-0 fs-lg-14">Fandom Name</h4>
                    </div>
                    <div class="col">
                        <p class="m-0 text-color-100 fs-lg-14">{{ $artist->fandom }}</p>
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-5 col-lg-4 col-xl-3 col-xxl-2">
                        <h4 class="fs-16 fw-medium text-color-100 m-0 fs-lg-14">Origin</h4>
                    </div>
                    <div class="col">
                        <p class="m-0 text-color-100 fs-lg-14">{{ $artist->origin }}</p>
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-5 col-lg-4 col-xl-3 col-xxl-2">
                        <h4 class="fs-16 fw-medium text-color-100 m-0 fs-lg-14">Company</h4>
                    </div>
                    <div class="col">
                        <p class="m-0 text-color-100 fs-lg-14">{{ $artist->company }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5 col-lg-4 col-xl-3 col-xxl-2">
                        <h4 class="fs-16 fw-medium text-color-100 m-0 fs-lg-14">Total Video</h4>
                    </div>
                    <div class="col">
                        <p class="m-0 text-color-100 fs-lg-14">{{ $artists->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @php
        // $category_le = $artists->where('category_id', '=', 2)->sortBy('project_title');
        $videos = $artists->sortBy('project_title');
    @endphp

    <section id="videos-artist">
        <div class="row">
            <h3 class="fw-semibold text-color-100 mb-10">Video</h3>
            @forelse ($videos as $video)
                <div class="col-12 col-md-6 col-lg-4 {{ $loop->last ? '' : 'mb-15' }}">
                    <div class="video-card">
                        <a href="/gallery/videos/{{ $video->id }}">
                            @if ($video->thumbnail !== null)
                                <img src="{{ $video->thumbnail }}" class="thumbnail m-0 p-0 img-fluid"
                                    alt="{{ $video->project_title }} thumbnail">
                            @else
                                <img src="{{ asset('img/no_thumbnail.jpg') }}" class="thumbnail m-0 p-0 img-fluid"
                                    alt="{{ $video->project_title }} thumbnail">
                            @endif
                            <div class="video-desc-card">
                                <a href="gallery?category={{ $video->category->slug }}">
                                    <p @class([
                                        'mb5',
                                        'fs-14',
                                        'font-inter',
                                        'fw-semibold',
                                        'text-color-ad' => $video->category->category_name === 'Album Distribution',
                                        'text-color-ae' => $video->category->category_name === 'Album Evolution',
                                        'text-color-cd' =>
                                            $video->category->category_name === 'Center Distribution',
                                        'text-color-hs' => $video->category->category_name === 'How Should',
                                        'text-color-hw' => $video->category->category_name === 'How Would',
                                        'text-color-ld' => $video->category->category_name === 'Line Distribution',
                                        'text-color-le' => $video->category->category_name === 'Line Evolution',
                                        'text-color-rb' => $video->category->category_name === 'Ranking Battle',
                                    ])>
                                        {{ $video->category->category_name }}
                                    </p>
                                </a>
                                <h4>{{ $video->project_title }}</h4>
                                <p class="date-text mb-0">
                                    {{ \Carbon\Carbon::createFromTimeStamp(strtotime($video->date))->diffForHumans() }}
                                    &#8226; <a href="/gallery?type={{ urlencode($video->type->type_name) }}"
                                        class="p-0 m-0 text-decoration-none"><span
                                            class="type-tag">{{ $video->type->type_name }}</span>
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
    </section>
@endsection
