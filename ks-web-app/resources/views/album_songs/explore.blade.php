@extends('layouts.main')

@section('content')
    <div class="alert alert-warning fs-14 rounded-10" role="alert">
        <strong><i class="las la-exclamation-triangle fs-18 mb-0"></i> This page is still experimental!</strong>. We are still working on entering the album data into this page, so it may not have the content you are searching for right now.
    </div>
    <section id="searchForm" class="mb-30">
        <div class="row">
            <div class="col">
                <h2 class="text-color-100 fw-bold mb-15">Explore</h2>
                <form class="search-gallery-form" action="/explore" method="GET">
                    <div class="input-group">
                        <span class="input-group-text" id="search-logo">
                            <i class='bx bx-search fs-18'></i>
                        </span>
                        <input type="search" class="form-control shadow-none"
                            placeholder="Search albums or artist (Press /)" aria-label="Search" id="searchGallery"
                            name="search" value="{{ request('search') }}" autofocus>
                    </div>
                </form>
            </div>
        </div>
    </section>

    @if (request('search'))
        <section id="search-results">
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-between">
                        <div class="gallery-cards-head d-flex align-items-center">
                            <h4 class="m-0 fw-semibold text-color-100">Search Results
                            </h4>
                            <span class="ms-2 align-middle badge font-inter fs-14 fw-medium bg-main text-white">
                                {{ $searchResults->count() }}
                            </span>
                        </div>
                        <div class="filter-clear">
                            <a href="{{ route('explore-album') }}"
                                class="fs-14 font-inter text-decoration-none text-color-100 fw-medium">
                                <i class="las la-times-circle"></i> Clear Filter
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-2">
                @forelse ($searchResults as $result)
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2 {{ $loop->last || $loop->iteration == 5 ? '' : 'mb-3' }}">
                        <div class="album-card">
                            <a href="/albums/{{ $result->id ?? '' }}" class="text-decoration-none">
                                @if ($result->cover)
                                    <img src="{{ asset('storage/' . $result->cover ?? '') }}"
                                        class="rounded artist-image img-fluid" alt="{{ $result->album_name }}">
                                @else
                                    <img src="{{ asset('img/unknown_artist.jpg') }}" class="rounded artist-image img-fluid"
                                        alt="{{ $result->album_name ?? '' }}">
                                @endif
                                <p class="text-truncate-2-line text-truncate text-color-100"
                                    title="{{ $result->album_name }}">{{ $result->album_name ?? '' }}</p>
                                <span>{{ \Carbon\Carbon::create($result->release)->format('Y') }} •
                                    {{ $result->type }}</span>
                                <p class="fw-medium text-color-100 mt-0">{{ $result->artist->artist_name }}</p>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col">
                        <div class="text-color-100 text-center">
                            <svg width="48" height="48" viewBox="0 0 84 84" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                    fill="#EA8887" />
                                <path
                                    d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                    fill="#787878" />
                            </svg>
                            <p class="mb-0 mt-1 fw-medium fs-14">No Search Results Found!</p>
                        </div>
                    </div>
                    <div class="col-12 mt-30">
                        <div class="gallery-cards-head">
                            <h3>For You</h3>
                        </div>
                    </div>
                    @forelse ($albums as $album)
                        <div
                            class="col-6 col-md-4 col-lg-3 col-xl-2 mb-xl-0 {{ $loop->last || $loop->iteration == 5 ? '' : 'mb-3' }}">
                            <div class="album-card">
                                <a href="/albums/{{ $album->id ?? '' }}" class="text-decoration-none">
                                    @if ($album->cover)
                                        <img src="{{ asset('storage/' . $album->cover ?? '') }}"
                                            class="rounded artist-image img-fluid" alt="{{ $album->album_name }}">
                                    @else
                                        <img src="{{ asset('img/unknown_artist.jpg') }}"
                                            class="rounded artist-image img-fluid" alt="{{ $album->album_name ?? '' }}">
                                    @endif
                                    <p class="text-truncate-2-line text-truncate text-color-100"
                                        title="{{ $album->album_name }}">{{ $album->album_name ?? '' }}</p>
                                    <span>{{ \Carbon\Carbon::create($album->release)->format('Y') }} •
                                        {{ $album->type }}</span>
                                    <p class="fw-medium text-color-100 mt-0">{{ $album->artist->artist_name }}</p>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col">
                            <div class="text-color-100 text-center">
                                <i class="las la-compact-disc fs-1"></i>
                                <p class="mb-0 mt-1 fw-medium fs-14">No Album Found!</p>
                            </div>
                        </div>
                    @endforelse
                @else
                    <div class="row">
                        <div class="gallery-cards-head">
                            <h3>Artists</h3>
                        </div>
                        @foreach ($searchResults->load('artist')->unique('artist_id') as $artistResult)
                            <div
                                class="col-6 col-md-4 col-lg-3 col-xl-2 {{ $loop->last || $loop->iteration == 5 ? '' : 'mb-3' }}">
                                <div class="artist-card">
                                    <a href="/artists/{{ $artistResult->artist->codename ?? '' }}">
                                        @if ($artistResult->artist->artist_pict)
                                            <img src="{{ asset('storage/' . $artistResult->artist->artist_pict ?? '') }}"
                                                class="rounded artist-image img-fluid"
                                                alt="{{ $artistResult->artist->artist_name }}">
                                        @else
                                            <img src="{{ asset('img/unknown_artist.jpg') }}"
                                                class="rounded artist-image img-fluid"
                                                alt="{{ $artistResult->artist->artist_name ?? '' }}">
                                        @endif
                                        <p>{{ $artistResult->artist->artist_name ?? '' }}</p>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforelse
            </div>
        </section>
    @else
        <section id="artist-cards" class="mb-30">
            <div class="row">
                <div class="d-flex justify-content-between gallery-cards-head">
                    <div>
                        <h3>Artist</h3>
                    </div>
                </div>
                @forelse ($artists as $artist)
                    <div
                        class="col-6 col-md-4 col-lg-3 col-xl-2 mb-xl-0 {{ $loop->last || $loop->iteration == 5 ? '' : 'mb-3' }}">
                        <div class="artist-card">
                            <a href="/artists/{{ $artist->codename ?? '' }}">
                                @if ($artist->artist_pict)
                                    <img src="{{ asset('storage/' . $artist->artist_pict ?? '') }}"
                                        class="rounded artist-image img-fluid" alt="{{ $artist->artist_name }}">
                                @else
                                    <img src="{{ asset('img/unknown_artist.jpg') }}" class="rounded artist-image img-fluid"
                                        alt="{{ $artist->artist_name ?? '' }}">
                                @endif
                                <p>{{ $artist->artist_name ?? '' }}</p>
                                <span>{{ $artist->albums->count() ?? '' }} Albums</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col">
                        <div class="text-color-100 text-center">
                            <i class="las la-user-slash fs-1"></i>
                            <p class="mb-0 mt-1 fw-medium fs-14">No Artist Found!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </section>

        <section id="rec-video">
            <div class="row justify-content-between">
                <div class="gallery-cards-head">
                    <h3 class="mb-10">Recommended Albums</h3>
                </div>
                @forelse ($albums as $album)
                    <div
                        class="col-6 col-md-4 col-lg-3 col-xl-2 mb-xl-0 {{ $loop->last || $loop->iteration == 5 ? '' : 'mb-3' }}">
                        <div class="album-card">
                            <a href="/albums/{{ $album->id ?? '' }}" class="text-decoration-none">
                                @if ($album->cover)
                                    <img src="{{ asset('storage/' . $album->cover ?? '') }}"
                                        class="rounded artist-image img-fluid" alt="{{ $album->album_name }}">
                                @else
                                    <img src="{{ asset('img/unknown_artist.jpg') }}"
                                        class="rounded artist-image img-fluid" alt="{{ $album->album_name ?? '' }}">
                                @endif
                                <p class="text-truncate-2-line text-truncate text-color-100"
                                    title="{{ $album->album_name }}">{{ $album->album_name ?? '' }}</p>
                                <span>{{ \Carbon\Carbon::create($album->release)->format('Y') }} •
                                    {{ $album->type }}</span>
                                <p class="fw-medium text-color-100 mt-0">{{ $album->artist->artist_name }}</p>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col">
                        <div class="text-color-100 text-center">
                            <i class="las la-compact-disc fs-1"></i>
                            <p class="mb-0 mt-1 fw-medium fs-14">No Album Found!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </section>
    @endif
@endsection
