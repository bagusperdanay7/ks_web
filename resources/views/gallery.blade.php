@extends('layouts.main')

@section('content')
    <section id="searchForm" class="mb-30">
        <div class="row">
            <div class="col">
                <h2 class="text-color-100 fw-bold mb-15">Explore</h2>
                <form class="search-gallery-form" action="{{ route('gallery') }}">
                    <div class="input-group">
                        <span class="input-group-text" id="search-logo">
                            <i class='bx bx-search fs-18'></i>
                        </span>
                        <input type="search" class="form-control shadow-none"
                            placeholder="Search title, or artist (Press /)" aria-label="Search" id="searchGallery"
                            name="search" value="{{ request('search') }}" autofocus>
                    </div>
                    @if (request('category') || request('search') || request('type') || request('sort'))
                        <p class="d-block mb-15 fs-14 font-inter fw-medium text-color-secondary mt-10 text-end" id="triggerFilter"
                            data-bs-toggle="collapse" data-bs-target="#filterGroup" aria-expanded="false"
                            aria-controls="collapseExample">
                            {{ request('category') || request('sort') || request('type') ? 'Hide Advanced Filter' : 'Show Advanced Filter' }}
                        </>
                        <div class="row {{ request('category') || request('sort') || request('type') ? 'show' : '' }} collapse"
                            id="filterGroup">
                            <div class="col-6 col-sm-auto">
                                <select class="form-select filter-select" aria-label="Select Category" name="category"
                                    onchange="if(this.value != '') { this.form.submit(); }">
                                    <option value="">Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->slug }}"
                                            {{ request('category') == $category->slug ? ' selected' : ' ' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 col-sm-auto mb-sm-0 mb-2">
                                <select class="form-select filter-select" aria-label="Select Type" name="type"
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
                            <div class="col-6 col-sm-auto">
                                <select class="form-select filter-select" aria-label="Select Sort" name="sort"
                                    onchange="if(this.value != '') { this.form.submit(); }">
                                    <option value="">Sort By</option>
                                    <optgroup label="Title">
                                        <option value="title_asc" {{ request('sort') == 'title_asc' ? ' selected' : '' }}>
                                            Ascending</option>
                                    </optgroup>
                                    <optgroup label="Date">
                                        <option value="latest" {{ request('sort') == 'latest' ? ' selected' : '' }}>Latest
                                        </option>
                                        <option value="oldest" {{ request('sort') == 'oldest' ? ' selected' : '' }}>Oldest
                                        </option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </section>

    @if (request('search') or request('type') or request('category'))
        <section id="search-results">
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-between">
                        <div class="gallery-cards-head d-flex align-items-center">
                            <h4 class="fw-semibold text-color-100 m-0">Search Results
                            </h4>
                            <span class="badge font-inter fs-14 fw-medium bg-main ms-2 align-middle text-white">
                                {{ $galleries->count() }}
                            </span>
                        </div>
                        <div class="filter-clear">
                            <a href="{{ route('gallery') }}"
                                class="fs-14 font-inter text-decoration-none text-color-100 fw-medium">
                                <i class="las la-times-circle"></i> Clear Filter
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($galleries as $gallery)
                    <div class="col-12 col-md-6 col-lg-4 {{ $loop->last ? '' : 'mb-15' }}">
                        <div class="video-card">
                            <a href="{{ route('videos', $gallery->id) }}">
                                @if ($gallery->youtube_id)
                                    <img src="{{ 'https://i3.ytimg.com/vi/' . $gallery->youtube_id . '/maxresdefault.jpg' }}"
                                        class="thumbnail img-fluid m-0 p-0" alt="{{ $gallery->title }} thumbnail">
                                @else
                                    <img src="{{ asset('img/no_thumbnail.jpg') }}" class="thumbnail img-fluid m-0 p-0"
                                        alt="{{ $gallery->title }} thumbnail">
                                @endif

                                <div class="video-desc-card">
                                    <a href="{{ route('gallery') . '?category=' . $gallery->category->slug }}">
                                        <p @class([
                                            'mb5',
                                            'fs-14',
                                            'font-inter',
                                            'fw-semibold',
                                            'text-color-ad' =>
                                                $gallery->category->category_name === 'Album Distribution',
                                            'text-color-ae' =>
                                                $gallery->category->category_name === 'Total Line Evolution',
                                            'text-color-cd' =>
                                                $gallery->category->category_name === 'Center Distribution',
                                            'text-color-hs' => $gallery->category->category_name === 'How Should',
                                            'text-color-hw' => $gallery->category->category_name === 'How Would',
                                            'text-color-ld' =>
                                                $gallery->category->category_name === 'Line Distribution',
                                            'text-color-le' => $gallery->category->category_name === 'Line Evolution',
                                            'text-color-rb' => $gallery->category->category_name === 'Ranking Battle',
                                            'text-info' => $gallery->category->category_name === 'Other',
                                        ])>
                                            {{ $gallery->category->category_name }}
                                        </p>
                                    </a>
                                    <h4>{{ $gallery->title }}</h4>
                                    <p class="date-text">
                                        {{ \Carbon\Carbon::createFromTimeStamp(strtotime($gallery->date))->diffForHumans() }}
                                        &#8226; <a href="{{ route('gallery') . '?type=' . $gallery->projectType->slug }}"
                                            class="text-decoration-none m-0 p-0"><span
                                                class="type-tag">{{ $gallery->projectType->type_name }}</span>
                                        </a>
                                    </p>
                                    @if ($gallery->artists->count() > 1)
                                        @foreach ($gallery->artists->sortBy('artist_name') as $galleryArtists)
                                            <a href="{{ route('artist', $galleryArtists->codename ?? '') }}">
                                                <span class="fw-semibold fs-14 text-color-100 mb-0">
                                                    {{ $galleryArtists->artist_name }}{{ $loop->last ? '' : ',' }}
                                                </span>
                                            </a>
                                        @endforeach
                                    @elseif ($gallery->artists->count() == 1)
                                        @foreach ($gallery->artists as $galleryArtist)
                                            <a href="{{ route('artist', $galleryArtist->codename ?? '') }}">
                                                <div class="d-flex align-items-center flex-row">
                                                    <div>
                                                        @if ($galleryArtist->artist_picture)
                                                            <img class="rounded-circle"
                                                                src="{{ asset('storage/' . $galleryArtist->artist_picture) }}"
                                                                alt="{{ $galleryArtist->artist_name }} thumbnail"
                                                                width="40px" height="40px">
                                                        @else
                                                            <img class="rounded-circle"
                                                                src="{{ asset('img/unknown_artist.jpg') }}"
                                                                alt="{{ $galleryArtist->artist_name }} thumbnail"
                                                                width="40px" height="40px">
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <p class="fw-semibold fs-14 text-color-100 mb-0 ml-10">
                                                            {{ $galleryArtist->artist_name }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @else
                                        <div class="d-flex align-items-center flex-row">
                                            <div>
                                                <img class="rounded-circle" src="{{ asset('img/unknown_artist.jpg') }}"
                                                    alt="unknown artist thumbnail" width="40px" height="40px">
                                            </div>
                                            <div>
                                                <p class="fw-semibold fs-14 text-danger mb-0 ml-10">No Artist</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
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
                            <p class="fw-medium fs-14 m-0 mt-1">
                                No Search Results Found!
                            </p>
                        </div>
                    </div>
                    <div class="col-12 mt-30">
                        <div class="gallery-cards-head">
                            <h3>For You</h3>
                        </div>
                    </div>

                    @forelse ($recommendationVideo as $recVideo)
                        <div class="col-12 col-md-6 col-lg-4 {{ $loop->last ? '' : 'mb-15' }}">
                            <div class="video-card">
                                <a href="{{ route('videos', $recVideo->id) }}">
                                    @if ($recVideo->youtube_id)
                                        <img src="{{ 'https://i3.ytimg.com/vi/' . $recVideo->youtube_id . '/maxresdefault.jpg' }}"
                                            class="thumbnail img-fluid m-0 p-0" alt="{{ $recVideo->title }} thumbnail">
                                    @else
                                        <img src="{{ asset('img/no_thumbnail.jpg') }}" class="thumbnail img-fluid m-0 p-0"
                                            alt="{{ $recVideo->title }} thumbnail">
                                    @endif
                                    <div class="video-desc-card">
                                        <a href="{{ route('gallery') . '?category=' . $recVideo->category->slug  }}">
                                            <p @class([
                                                'mb5',
                                                'fs-14',
                                                'font-inter',
                                                'fw-semibold',
                                                'text-color-ad' =>
                                                    $recVideo->category->category_name === 'Album Distribution',
                                                'text-color-ae' =>
                                                    $recVideo->category->category_name === 'Total Line Evolution',
                                                'text-color-cd' =>
                                                    $recVideo->category->category_name === 'Center Distribution',
                                                'text-color-hs' => $recVideo->category->category_name === 'How Should',
                                                'text-color-hw' => $recVideo->category->category_name === 'How Would',
                                                'text-color-ld' =>
                                                    $recVideo->category->category_name === 'Line Distribution',
                                                'text-color-le' => $recVideo->category->category_name === 'Line Evolution',
                                                'text-color-rb' => $recVideo->category->category_name === 'Ranking Battle',
                                                'text-info' => $recVideo->category->category_name === 'Other',
                                            ])>
                                                {{ $recVideo->category->category_name }}
                                            </p>
                                        </a>
                                        <h4>{{ $recVideo->title }}</h4>
                                        <p class="date-text">
                                            {{ \Carbon\Carbon::createFromTimeStamp(strtotime($recVideo->date))->diffForHumans() }}
                                            &#8226; <a href="{{ route('gallery') . '?type=' . $recVideo->projectType->slug }}"
                                                class="text-decoration-none m-0 p-0"><span
                                                    class="type-tag">{{ $recVideo->projectType->type_name }}</span>
                                            </a>
                                        </p>
                                        @if ($recVideo->artists->count() > 1)
                                            @foreach ($recVideo->artists->sortBy('artist_name') as $recVideoArtists)
                                                <a href="{{ route('artist', $recVideoArtists->codename ?? '') }}"
                                                    class="m-t-">
                                                    <span class="fw-semibold fs-14 text-color-100 mb-0">
                                                        {{ $recVideoArtists->artist_name }}{{ $loop->last ? '' : ',' }}
                                                    </span>
                                                </a>
                                            @endforeach
                                        @elseif ($recVideo->artists->count() == 1)
                                            @foreach ($recVideo->artists as $recVideoArtist)
                                                <a href="{{ route('artist', $recVideoArtist->codename ?? '') }}">
                                                    <div class="d-flex align-items-center flex-row">
                                                        <div>
                                                            @if ($recVideoArtist->artist_picture)
                                                                <img class="rounded-circle"
                                                                    src="{{ asset('storage/' . $recVideoArtist->artist_picture) }}"
                                                                    alt="{{ $recVideoArtist->artist_name }} thumbnail"
                                                                    width="40px" height="40px">
                                                            @else
                                                                <img class="rounded-circle"
                                                                    src="{{ asset('img/unknown_artist.jpg') }}"
                                                                    alt="{{ $recVideoArtist->artist_name }} thumbnail"
                                                                    width="40px" height="40px">
                                                            @endif
                                                        </div>
                                                        <div>
                                                            <p class="fw-semibold fs-14 text-color-100 mb-0 ml-10">
                                                                {{ $recVideoArtist->artist_name }}</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        @else
                                            <div class="d-flex align-items-center flex-row">
                                                <div>
                                                    <img class="rounded-circle"
                                                        src="{{ asset('img/unknown_artist.jpg') }}"
                                                        alt="unknown artist thumbnail" width="40px" height="40px">
                                                </div>
                                                <div>
                                                    <p class="fw-semibold fs-14 text-danger mb-0 ml-10">No Artist</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-color-100 text-center">
                                <i class="las la-photo-video fs-1"></i>
                                <p class="fs-14 fw-medium mb-0 mt-1">
                                    No Video Found!
                                </p>
                            </div>
                        </div>
                    @endforelse
                @endforelse
            </div>
        </section>
    @else
        <section id="category-cards" class="mb-30">
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-between gallery-cards-head">
                        <div>
                            <h3>Category</h3>
                        </div>
                        <div class="align-self-end">
                            <a class="fw-medium text-color-100 fs-14 font-inter" href="{{ route('categories') }}">
                                <span>Show All</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($projectCategories as $projectCategory)
                    <div class="col-6 col-xl-3 {{ $loop->iteration > 2 ? '' : 'mb-3' }} mb-xl-0">
                        <a href="{{ route('gallery') . '?category=' . $projectCategory->category->slug }}" class="text-decoration-none">
                            <div @class([
                                'd-flex',
                                'flex-column',
                                'flex-sm-row',
                                'align-items-center',
                                'category-card',
                                'bg-alert-10' =>
                                    $projectCategory->category->category_name === 'Album Distribution',
                                'bg-second-10' =>
                                    $projectCategory->category->category_name === 'Total Line Evolution',
                                'bg-main-10' =>
                                    $projectCategory->category->category_name === 'Line Distribution',
                                'bg-tertiary-10' =>
                                    $projectCategory->category->category_name === 'Line Evolution',
                                'bg-cd-10' =>
                                    $projectCategory->category->category_name === 'Center Distribution',
                                'bg-success-10' =>
                                    $projectCategory->category->category_name === 'How Should',
                                'bg-hw-10' => $projectCategory->category->category_name === 'How Would',
                                'bg-rb-10' =>
                                    $projectCategory->category->category_name === 'Ranking Battle',
                                'bg-info-subtle' => $projectCategory->category->category_name === 'Other',
                            ])>
                                <div class="mb-sm-10">
                                    <i @class([
                                        $projectCategory->category->icon_class,
                                        'text-color-ad' =>
                                            $projectCategory->category->category_name === 'Album Distribution',
                                        'text-color-ae' =>
                                            $projectCategory->category->category_name === 'Total Line Evolution',
                                        'text-color-ld' =>
                                            $projectCategory->category->category_name === 'Line Distribution',
                                        'text-color-le' =>
                                            $projectCategory->category->category_name === 'Line Evolution',
                                        'text-color-cd' =>
                                            $projectCategory->category->category_name === 'Center Distribution',
                                        'text-color-hs' =>
                                            $projectCategory->category->category_name === 'How Should',
                                        'text-color-hw' =>
                                            $projectCategory->category->category_name === 'How Would',
                                        'text-color-rb' =>
                                            $projectCategory->category->category_name === 'Ranking Battle',
                                        'text-info' => $projectCategory->category->category_name === 'Other',
                                    ])></i>
                                </div>
                                <div class="ml-sm-0 text-sm-start ml-10 text-center">
                                    <h5>{{ $projectCategory->category->category_name }}</h5>
                                    <p>{{ $projectCategory->total }} videos</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col">
                        <div class="text-color-100 text-center">
                            <i class="las la-icons fs-1"></i>
                            <p class="fw-medium fs-14 mb-0 mt-1">No Category Found!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </section>

        <section id="artist-cards" class="mb-30">
            <div class="row">
                <div class="d-flex justify-content-between gallery-cards-head">
                    <div>
                        <h3>Artist</h3>
                    </div>
                    <div class="align-self-end">
                        <a class="fw-medium text-color-100 fs-14 font-inter" href="{{ route('artists') }}">
                            <span>Show All</span>
                        </a>
                    </div>
                </div>
                @forelse ($artists as $artist)
                    <div
                        class="col-6 col-md-4 col-lg-3 col-xl-2 mb-xl-0 {{ $loop->last || $loop->iteration == 5 ? '' : 'mb-3' }}">
                        <div class="artist-card">
                            <a href="{{ route('artist', $artist->codename ?? '') }}">
                                @if ($artist?->artist_picture)
                                    <img src="{{ asset('storage/' . $artist->artist_picture ?? '') }}"
                                        class="artist-image img-fluid rounded" alt="{{ $artist->artist_name }}">
                                @else
                                    <img src="{{ asset('img/unknown_artist.jpg') }}"
                                        class="artist-image img-fluid rounded" alt="{{ $artist->artist_name ?? '' }}">
                                @endif
                                <p>{{ $artist->artist_name ?? '' }}</p>
                                <span>{{ $artist->projects_count ?? '' }} Videos</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col">
                        <div class="text-color-100 text-center">
                            <i class="las la-user-slash fs-1"></i>
                            <p class="fw-medium fs-14 mb-0 mt-1">No Artist Found!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </section>

        <section id="latest-video" class="mb-30">
            <div class="row justify-content-between">
                <div class="gallery-cards-head">
                    <h3>Latest Video</h3>
                </div>
                @forelse ($latestVideo as $latestVid)
                    <div class="col-12 col-md-6 col-lg-4 mb-xl-0 {{ $loop->last ? '' : 'mb-15' }}">
                        <div class="video-card">
                            <a href="{{ route('videos', $latestVid->id) }}">
                                @if ($latestVid->youtube_id)
                                    <img src="{{ 'https://i3.ytimg.com/vi/' . $latestVid->youtube_id . '/maxresdefault.jpg' }}"
                                        class="thumbnail img-fluid m-0 p-0" alt="{{ $latestVid->title }} thumbnail">
                                @else
                                    <img src="{{ asset('img/no_thumbnail.jpg') }}" class="thumbnail img-fluid m-0 p-0"
                                        alt="{{ $latestVid->title }} thumbnail">
                                @endif
                                <div class="video-desc-card">
                                    <a href="{{ route('gallery') . '?category=' . $latestVid->category->slug }}">
                                        <p @class([
                                            'mb5',
                                            'fs-14',
                                            'font-inter',
                                            'fw-semibold',
                                            'text-color-ad' =>
                                                $latestVid->category->category_name === 'Album Distribution',
                                            'text-color-ae' =>
                                                $latestVid->category->category_name === 'Total Line Evolution',
                                            'text-color-cd' =>
                                                $latestVid->category->category_name === 'Center Distribution',
                                            'text-color-hs' => $latestVid->category->category_name === 'How Should',
                                            'text-color-hw' => $latestVid->category->category_name === 'How Would',
                                            'text-color-ld' =>
                                                $latestVid->category->category_name === 'Line Distribution',
                                            'text-color-le' => $latestVid->category->category_name === 'Line Evolution',
                                            'text-color-rb' => $latestVid->category->category_name === 'Ranking Battle',
                                            'text-info' => $latestVid->category->category_name === 'Other',
                                        ])>
                                            {{ $latestVid->category->category_name }}
                                        </p>
                                    </a>
                                    <h4>{{ $latestVid->title }}</h4>
                                    <p class="date-text">
                                        {{ \Carbon\Carbon::createFromTimeStamp(strtotime($latestVid->date))->diffForHumans() }}
                                        &#8226; <a href="{{ route('gallery') . '?type=' . $latestVid->projectType->slug }}"
                                            class="text-decoration-none m-0 p-0"><span
                                                class="type-tag">{{ $latestVid->projectType->type_name }}</span>
                                        </a>
                                    </p>
                                    @if ($latestVid->artists->count() > 1)
                                        @foreach ($latestVid->artists->sortBy('artist_name') as $lVArtists)
                                            <a href="{{ route('artist', $lVArtists) }}">
                                                <span class="fw-semibold fs-14 text-color-100 mb-0">
                                                    {{ $lVArtists->artist_name }}{{ $loop->last ? '' : ',' }}
                                                </span>
                                            </a>
                                        @endforeach
                                    @elseif ($latestVid->artists->count() == 1)
                                        @foreach ($latestVid->artists as $lVArtist)
                                            <a href="{{ route('artist', $lVArtist->codename ?? '') }}">
                                                <div class="d-flex align-items-center flex-row">
                                                    <div>
                                                        @if ($lVArtist->artist_picture)
                                                            <img class="rounded-circle"
                                                                src="{{ asset('storage/' . $lVArtist->artist_picture) }}"
                                                                alt="{{ $lVArtist->artist_name }} thumbnail"
                                                                width="40px" height="40px">
                                                        @else
                                                            <img class="rounded-circle"
                                                                src="{{ asset('img/unknown_artist.jpg') }}"
                                                                alt="{{ $lVArtist->artist_name }} thumbnail"
                                                                width="40px" height="40px">
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <p class="fw-semibold fs-14 text-color-100 mb-0 ml-10">
                                                            {{ $lVArtist->artist_name }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @else
                                        <div class="d-flex align-items-center flex-row">
                                            <div>
                                                <img class="rounded-circle" src="{{ asset('img/unknown_artist.jpg') }}"
                                                    alt="unknown artist thumbnail" width="40px" height="40px">
                                            </div>
                                            <div>
                                                <p class="fw-semibold fs-14 text-danger mb-0 ml-10">No Artist</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-color-100 text-center">
                            <i class="las la-photo-video fs-1"></i>
                            <p class="fs-14 fw-medium mb-0 mt-1">
                                No Video Found!
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>
        </section>

        <section id="rec-video">
            <div class="row justify-content-between">
                <div class="gallery-cards-head">
                    <h3>For You</h3>
                </div>
                @forelse ($recommendationVideo as $recVideo)
                    <div class="col-12 col-md-6 col-lg-4 {{ $loop->last ? '' : 'mb-15' }}">
                        <div class="video-card">
                            <a href="{{ route('videos', $recVideo->id) }}">
                                @if ($recVideo->youtube_id)
                                    <img src="{{ 'https://i3.ytimg.com/vi/' . $recVideo->youtube_id . '/maxresdefault.jpg' }}"
                                        class="thumbnail img-fluid m-0 p-0" alt="{{ $recVideo->title }} thumbnail">
                                @else
                                    <img src="{{ asset('img/no_thumbnail.jpg') }}" class="thumbnail img-fluid m-0 p-0"
                                        alt="{{ $recVideo->title }} thumbnail">
                                @endif
                                <div class="video-desc-card">
                                    <a href="{{ route('gallery') . '?category=' . $recVideo->category->slug }}">
                                        <p @class([
                                            'mb5',
                                            'fs-14',
                                            'font-inter',
                                            'fw-semibold',
                                            'text-color-ad' =>
                                                $recVideo->category->category_name === 'Album Distribution',
                                            'text-color-ae' =>
                                                $recVideo->category->category_name === 'Total Line Evolution',
                                            'text-color-cd' =>
                                                $recVideo->category->category_name === 'Center Distribution',
                                            'text-color-hs' => $recVideo->category->category_name === 'How Should',
                                            'text-color-hw' => $recVideo->category->category_name === 'How Would',
                                            'text-color-ld' =>
                                                $recVideo->category->category_name === 'Line Distribution',
                                            'text-color-le' => $recVideo->category->category_name === 'Line Evolution',
                                            'text-color-rb' => $recVideo->category->category_name === 'Ranking Battle',
                                            'text-info' => $recVideo->category->category_name === 'Other',
                                        ])>
                                            {{ $recVideo->category->category_name }}
                                        </p>
                                    </a>
                                    <h4>{{ $recVideo->title }}</h4>
                                    <p class="date-text">
                                        {{ \Carbon\Carbon::createFromTimeStamp(strtotime($recVideo->date))->diffForHumans() }}
                                        &#8226; <a href="{{ route('gallery') . '?type=' . $recVideo->projectType->slug }}"
                                            class="text-decoration-none m-0 p-0"><span
                                                class="type-tag">{{ $recVideo->projectType->type_name }}</span>
                                        </a>
                                    </p>
                                    @if ($recVideo->artists->count() > 1)
                                        @foreach ($recVideo->artists->sortBy('artist_name') as $recVideoArtists)
                                            <a href="{{ route('artist', $recVideoArtists->codename ?? '') }}"
                                                class="m-t-">
                                                <span class="fw-semibold fs-14 text-color-100 mb-0">
                                                    {{ $recVideoArtists->artist_name }}{{ $loop->last ? '' : ',' }}
                                                </span>
                                            </a>
                                        @endforeach
                                    @elseif ($recVideo->artists->count() == 1)
                                        @foreach ($recVideo->artists as $recVideoArtist)
                                            <a href="{{ route('artist', $recVideoArtist->codename ?? '') }}">
                                                <div class="d-flex align-items-center flex-row">
                                                    <div>
                                                        @if ($recVideoArtist->artist_picture)
                                                            <img class="rounded-circle"
                                                                src="{{ asset('storage/' . $recVideoArtist->artist_picture) }}"
                                                                alt="{{ $recVideoArtist->artist_name }} thumbnail"
                                                                width="40px" height="40px">
                                                        @else
                                                            <img class="rounded-circle"
                                                                src="{{ asset('img/unknown_artist.jpg') }}"
                                                                alt="{{ $recVideoArtist->artist_name }} thumbnail"
                                                                width="40px" height="40px">
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <p class="fw-semibold fs-14 text-color-100 mb-0 ml-10">
                                                            {{ $recVideoArtist->artist_name }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @else
                                        <div class="d-flex align-items-center flex-row">
                                            <div>
                                                <img class="rounded-circle" src="{{ asset('img/unknown_artist.jpg') }}"
                                                    alt="unknown artist thumbnail" width="40px" height="40px">
                                            </div>
                                            <div>
                                                <p class="fw-semibold fs-14 text-danger mb-0 ml-10">No Artist</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-color-100 text-center">
                            <i class="las la-photo-video fs-1"></i>
                            <p class="fs-14 fw-medium mb-0 mt-1">
                                No Video Found!
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>
        </section>
    @endif
@endsection
