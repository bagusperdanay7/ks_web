@extends('layouts.main')

@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb" class="space-navbar">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/gallery">Gallery</a></li>
            <li class="breadcrumb-item"><a href="/gallery/artists">Artists</a></li>
            <li class="breadcrumb-item breadcumb-active" aria-current="page">{{ $artist->artist_name }}
            </li>
        </ol>
    </nav>

    <div class="row gallery-section-artist mb-5">
        <div class="col-4">
            @if ($artist->artist_pict == null)
                <img src="{{ asset('img/unknown_artist.jpg') }}" class="image-hero-artist shadow"
                    alt="{{ $artist->artist_pict }} picture" width="">
            @else
                <img src="{{ asset('storage/' . $artist->artist_pict) }}" class="image-hero-artist shadow"
                    alt="{{ $artist->artist_pict }} picture" width="">
            @endif

        </div>
        <div class="col-8 align-self-center">
            <h2 class="header-2">{{ $artist->artist_name }}</h2>
            <p class="text-about-artist">{{ $artist->about }}</p>
            <div class="row">
                <div class="col-2">
                    <h4 class="heading-info-artist">Debut</h4>
                </div>
                <div class="col">
                    <p>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $artist->debut)->format('d F Y') }}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <h4 class="heading-info-artist">Fandom Name</h4>
                </div>
                <div class="col">
                    <p>{{ $artist->fandom }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <h4 class="heading-info-artist">Origin</h4>
                </div>
                <div class="col">
                    <p>{{ $artist->origin }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <h4 class="heading-info-artist">Company</h4>
                </div>
                <div class="col">
                    <p>{{ $artist->company }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <h4 class="heading-info-artist">Total Video</h4>
                </div>
                <div class="col">
                    <p>{{ $artists->count() }}</p>
                </div>
            </div>
        </div>
        {{-- TODO: Untuk Debuggin jangan dihapus --}}
        {{-- <div class="d-flex justify-content-between gallery-cards-head">
            <div>
                <p>{{ $artists }}</p> <br>
            </div>
        </div> --}}
    </div>

    @php
        // $category_le = $artists->where('category_id', '=', 2)->sortBy('project_title');
        $videos = $artists->sortBy('project_title');
    @endphp

    <div class="row mt-4 mb-4">
        <h3>Video</h3>
        @foreach ($videos as $video)
            <div class="col-4 artist-card">
                <a href="">
                    <div class="video-description-card">
                        @if ($video->project_thumbnail != null)
                            <img src="{{ $video->project_thumbnail }}" class="rounded thumbnail m-0 p-0" width="100%"
                                alt="{{ $video->project_title }} thumbnail">
                        @else
                            <img src="{{ asset('img/no_thumbnail.jpg') }}" class="rounded thumbnail m-0 p-0" width="100%"
                                alt="{{ $video->project_title }} thumbnail">
                        @endif
                        <a href="gallery?category={{ $video->category->slug }}">
                            <p class="category-text-video">{{ $video->category->category_name }}</p>
                        </a>
                        <h4>{{ $video->project_title }}
                            ({{ $video->category->category_name }})
                        </h4>
                        <span
                            class="pro-class-date">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($video->project_date))->diffForHumans() }}
                            &#8226; <a href="gallery?search={{ $video->project_class }}"
                                class="p-0 m-0 text-decoration-none"><span
                                    class="pro-class-text">{{ $video->project_class }}</span>
                            </a>
                        </span>
                        <div class="d-flex flex-row my-2 px-2 pb-2">
                            <div>
                                <a href="/gallery?artist={{ $video->artist->codename }}">
                                    @if ($video->artist->artist_pict != null)
                                        <img class="rounded-circle fit-img"
                                            src="{{ asset('storage/' . $video->artist->artist_pict) }}"
                                            alt="{{ $video->artist->artist_name }} thumbnail" width="40px"
                                            height="40px">
                                    @else
                                        <img class="rounded-circle fit-img" src="{{ asset('img/unknown_artist.jpg') }}"
                                            alt="{{ $video->artist->artist_name }} thumbnail" width="40px"
                                            height="40px">
                                    @endif
                                </a>
                            </div>
                            <div class="align-self-center">
                                <a href="/gallery?artist={{ $video->artist->codename }}">
                                    <p class="mx-2 my-0 py-0">{{ $video->artist->artist_name }}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
