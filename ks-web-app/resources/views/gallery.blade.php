@extends('layouts.main')

@section('content')
    <section id="searchForm" class="mb-30">
        <div class="row">
            <div class="col">
                <h2 class="text-color-100 fw-bold mb-15">Explore</h2>
                <form class="search-gallery-form" action="/gallery">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class='bx bx-search fs-18'></i>
                        </span>
                        <input type="search" class="form-control shadow-none"
                            placeholder="Search title, or artist (Press /)" aria-label="Search" id="searchGallery"
                            name="search" value="{{ request('search') }}" autofocus>
                    </div>
                    @if (request('category') || request('search') || request('type') || request('sort'))
                        <p class="mt-10 mb-15 fs-inter-14 fw-medium text-color-secondary text-end" id="triggerFilter"
                            data-bs-toggle="collapse" data-bs-target="#filterGroup" aria-expanded="false"
                            aria-controls="collapseExample" role="button">Show Advanced Filter</p>
                        <div class="row collapse" id="filterGroup">
                            <div class="col-6 col-auto-2">
                                <select class="form-select" aria-label="Select Category" name="category"
                                    onchange="if(this.value != '') { this.form.submit(); }">
                                    <option value="">Category</option>
                                    @foreach ($allCategory as $categoryList)
                                        <option value="{{ $categoryList->slug }}"
                                            {{ request('category') == $categoryList->slug ? ' selected' : ' ' }}>
                                            {{ $categoryList->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 col-auto-2 mb-2 mb-sm-0">
                                <select class="form-select" aria-label="Select Type" name="type"
                                    onchange="if(this.value != '') { this.form.submit(); }">
                                    <option value="">Type</option>
                                    @foreach ($allType as $typeList)
                                        <option value="{{ $typeList->slug }}"
                                            {{ request('type') == $typeList->slug ? ' selected' : ' ' }}>
                                            {{ $typeList->type_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 col-auto-2">
                                <select class="form-select" aria-label="Select Sort" name="sort"
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
                            <h4 class="m-0 fw-semibold">Search Results
                            </h4>
                            <span class="ms-2 align-middle badge bg-main text-white">
                                {{ $galleries->count() }}
                            </span>
                        </div>
                        <div>
                            <a href="{{ route('gallery') }}"
                                class="fs-inter-14 text-decoration-none text-color-100 fw-medium">
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
                            <a href="/gallery/videos/{{ $gallery->id }}">
                                @if ($gallery->thumbnail !== null)
                                    <img src="{{ $gallery->thumbnail }}" class="thumbnail m-0 p-0 img-fluid"
                                        alt="{{ $gallery->project_title }} thumbnail">
                                @else
                                    <img src="{{ asset('img/no_thumbnail.jpg') }}" class="thumbnail m-0 p-0 img-fluid"
                                        alt="{{ $gallery->project_title }} thumbnail">
                                @endif
                                <div class="video-desc-card">
                                    <a href="gallery?category={{ $gallery->category->slug }}">
                                        <p @class([
                                            'mb5',
                                            'fs-inter-14',
                                            'fw-semibold',
                                            'text-color-ad' =>
                                                $gallery->category->category_name === 'Album Distribution',
                                            'text-color-ae' => $gallery->category->category_name === 'Album Evolution',
                                            'text-color-cd' =>
                                                $gallery->category->category_name === 'Center Distribution',
                                            'text-color-hs' => $gallery->category->category_name === 'How Should',
                                            'text-color-hw' => $gallery->category->category_name === 'How Would',
                                            'text-color-ld' =>
                                                $gallery->category->category_name === 'Line Distribution',
                                            'text-color-le' => $gallery->category->category_name === 'Line Evolution',
                                            'text-color-rb' => $gallery->category->category_name === 'Ranking Battle',
                                        ])>
                                            {{ $gallery->category->category_name }}
                                        </p>
                                    </a>
                                    <h4>{{ $gallery->project_title }}</h4>
                                    <p class="date-text">
                                        {{ \Carbon\Carbon::createFromTimeStamp(strtotime($gallery->date))->diffForHumans() }}
                                        &#8226; <a href="gallery?type={{ $gallery->type->slug }}"
                                            class="p-0 m-0 text-decoration-none"><span
                                                class="type-tag">{{ $gallery->type->type_name }}</span>
                                        </a>
                                    </p>
                                    <a href="/gallery/artists/{{ $gallery->artist->codename ?? '' }}">
                                        <div class="d-flex flex-row align-items-center">
                                            <div>
                                                @if ($gallery->artist->artist_pict)
                                                    <img class="rounded-circle"
                                                        src="{{ asset('storage/' . $gallery->artist->artist_pict) }}"
                                                        alt="{{ $gallery->artist->artist_name }} thumbnail" width="40px"
                                                        height="40px">
                                                @else
                                                    <img class="rounded-circle" src="{{ asset('img/unknown_artist.jpg') }}"
                                                        alt="{{ $gallery->artist->artist_name }} thumbnail" width="40px"
                                                        height="40px">
                                                @endif
                                            </div>
                                            <div>
                                                <p class="ml-10 mb-0 fw-semibold fs-14 text-color-100">
                                                    {{ $gallery->artist->artist_name }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center text-color-100">
                            <svg width="48" height="48" viewBox="0 0 84 84" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                    fill="#EA8887" />
                                <path
                                    d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                    fill="#787878" />
                            </svg>
                            <p class="m-0 fw-medium fs-14 mt-1">
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
                                <a href="/gallery/videos/{{ $recVideo->id }}">
                                    @if ($recVideo->thumbnail !== null)
                                        <img src="{{ $recVideo->thumbnail }}" class="thumbnail m-0 p-0 img-fluid"
                                            alt="{{ $recVideo->project_title }} thumbnail">
                                    @else
                                        <img src="{{ asset('img/no_thumbnail.jpg') }}"
                                            class="thumbnail m-0 p-0 img-fluid"
                                            alt="{{ $recVideo->project_title }} thumbnail">
                                    @endif
                                    <div class="video-desc-card">
                                        <a href="gallery?category={{ $recVideo->category->slug }}">
                                            <p @class([
                                                'mb5',
                                                'fs-inter-14',
                                                'fw-semibold',
                                                'text-color-ad' =>
                                                    $recVideo->category->category_name === 'Album Distribution',
                                                'text-color-ae' => $recVideo->category->category_name === 'Album Evolution',
                                                'text-color-cd' =>
                                                    $recVideo->category->category_name === 'Center Distribution',
                                                'text-color-hs' => $recVideo->category->category_name === 'How Should',
                                                'text-color-hw' => $recVideo->category->category_name === 'How Would',
                                                'text-color-ld' =>
                                                    $recVideo->category->category_name === 'Line Distribution',
                                                'text-color-le' => $recVideo->category->category_name === 'Line Evolution',
                                                'text-color-rb' => $recVideo->category->category_name === 'Ranking Battle',
                                            ])>
                                                {{ $recVideo->category->category_name }}
                                            </p>
                                        </a>
                                        <h4>{{ $recVideo->project_title }}</h4>
                                        <p class="date-text">
                                            {{ \Carbon\Carbon::createFromTimeStamp(strtotime($recVideo->date))->diffForHumans() }}
                                            &#8226; <a href="gallery?type={{ $recVideo->type->slug }}"
                                                class="p-0 m-0 text-decoration-none"><span
                                                    class="type-tag">{{ $recVideo->type->type_name }}</span>
                                            </a>
                                        </p>
                                        <a href="/gallery/artists/{{ $recVideo->artist->codename ?? '' }}">
                                            <div class="d-flex flex-row align-items-center">
                                                <div>
                                                    @if ($recVideo->artist->artist_pict)
                                                        <img class="rounded-circle"
                                                            src="{{ asset('storage/' . $recVideo->artist->artist_pict) }}"
                                                            alt="{{ $recVideo->artist->artist_name }} thumbnail"
                                                            width="40px" height="40px">
                                                    @else
                                                        <img class="rounded-circle"
                                                            src="{{ asset('img/unknown_artist.jpg') }}"
                                                            alt="{{ $recVideo->artist->artist_name }} thumbnail"
                                                            width="40px" height="40px">
                                                    @endif
                                                </div>
                                                <div>
                                                    <p class="ml-10 mb-0 fw-semibold fs-14 text-color-100">
                                                        {{ $recVideo->artist->artist_name }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-color-100 text-center">
                                <i class="las la-photo-video fs-48"></i>
                                <p class="mt-1 fs-14 fw-medium mb-0">
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
                            <a href="{{ route('categories') }}">
                                <span>Show All</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($categories as $category)
                    <div class="col-6 col-xl-3 {{ $loop->iteration > 2 ? '' : 'mb-3' }} mb-xl-0">
                        <a href="/gallery?category={{ $category->category->slug }}" class="text-decoration-none">
                            <div @class([
                                'd-flex',
                                'flex-column',
                                'flex-sm-row',
                                'align-items-center',
                                'category-card',
                                'bg-alert-10' =>
                                    $category->category->category_name === 'Album Distribution',
                                'bg-second-10' => $category->category->category_name === 'Album Evolution',
                                'bg-main-10' => $category->category->category_name === 'Line Distribution',
                                'bg-tertiary-10' => $category->category->category_name === 'Line Evolution',
                                'bg-cd-10' => $category->category->category_name === 'Center Distribution',
                                'bg-success-10' => $category->category->category_name === 'How Should',
                                'bg-hw-10' => $category->category->category_name === 'How Would',
                                'bg-rb-10' => $category->category->category_name === 'Ranking Battle',
                            ])>
                                <div class="mb-sm-10">
                                    <i @class([
                                        $category->category->icon_class,
                                        'text-color-ad' =>
                                            $category->category->category_name === 'Album Distribution',
                                        'text-color-ae' => $category->category->category_name === 'Album Evolution',
                                        'text-color-ld' =>
                                            $category->category->category_name === 'Line Distribution',
                                        'text-color-le' => $category->category->category_name === 'Line Evolution',
                                        'text-color-cd' =>
                                            $category->category->category_name === 'Center Distribution',
                                        'text-color-hs' => $category->category->category_name === 'How Should',
                                        'text-color-hw' => $category->category->category_name === 'How Would',
                                        'text-color-rb' => $category->category->category_name === 'Ranking Battle',
                                    ])></i>
                                </div>
                                <div class="ml-10 ml-sm-0 text-center text-sm-start">
                                    <h5>{{ $category->category->category_name }}</h5>
                                    <p>{{ $category->total }} videos</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col">
                        <div class="text-color-100 text-center">
                            <i class="las la-icons fs-48"></i>
                            <p class="fw-medium mt-1 fs-14 mb-0 ">No Category Found!</p>
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
                        <a href="{{ route('artists') }}">
                            <span>Show All</span>
                        </a>
                    </div>
                </div>
                @forelse ($artistsTotal as $artistTotal)
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <div class="artist-card">
                            <a href="/gallery/artists/{{ $artistTotal->artist->codename ?? '' }}">
                                @if ($artistTotal->artist?->artist_pict)
                                    <img src="{{ asset('storage/' . $artistTotal->artist->artist_pict ?? '') }}"
                                        class="rounded artist-image img-fluid"
                                        alt="{{ $artistTotal->artist->artist_name }}">
                                @else
                                    <img src="{{ asset('img/unknown_artist.jpg') }}"
                                        class="rounded artist-image img-fluid"
                                        alt="{{ $artistTotal->artist->artist_name ?? '' }}">
                                @endif
                                <p>{{ $artistTotal->artist->artist_name ?? '' }}</p>
                                <span>{{ $artistTotal->total ?? '' }} Videos</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col">
                        <div class="text-color-100 text-center">
                            <i class="las la-user-slash fs-48"></i>
                            <p class="mb-0 mt-1 fw-medium fs-14">No Artist Found!</p>
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
                {{-- TODO: https://laraveldaily.com/post/laravel-relation-attempt-to-read-property-on-null-error --}}
                @forelse ($latestVideo as $latestVid)
                    <div class="col-12 col-md-6 col-lg-4 mb-xl-0 {{ $loop->last ? '' : 'mb-15' }}">
                        <div class="video-card">
                            <a href="/gallery/videos/{{ $latestVid->id }}">
                                @if ($latestVid->thumbnail !== null)
                                    <img src="{{ $latestVid->thumbnail }}" class="thumbnail m-0 p-0 img-fluid"
                                        alt="{{ $latestVid->project_title }} thumbnail">
                                @else
                                    <img src="{{ asset('img/no_thumbnail.jpg') }}" class="thumbnail m-0 p-0 img-fluid"
                                        alt="{{ $latestVid->project_title }} thumbnail">
                                @endif
                                <div class="video-desc-card">
                                    <a href="gallery?category={{ $latestVid->category->slug }}">
                                        <p @class([
                                            'mb5',
                                            'fs-inter-14',
                                            'fw-semibold',
                                            'text-color-ad' =>
                                                $latestVid->category->category_name === 'Album Distribution',
                                            'text-color-ae' =>
                                                $latestVid->category->category_name === 'Album Evolution',
                                            'text-color-cd' =>
                                                $latestVid->category->category_name === 'Center Distribution',
                                            'text-color-hs' => $latestVid->category->category_name === 'How Should',
                                            'text-color-hw' => $latestVid->category->category_name === 'How Would',
                                            'text-color-ld' =>
                                                $latestVid->category->category_name === 'Line Distribution',
                                            'text-color-le' => $latestVid->category->category_name === 'Line Evolution',
                                            'text-color-rb' => $latestVid->category->category_name === 'Ranking Battle',
                                        ])>
                                            {{ $latestVid->category->category_name }}
                                        </p>
                                    </a>
                                    <h4>{{ $latestVid->project_title }}</h4>
                                    <p class="date-text">
                                        {{ \Carbon\Carbon::createFromTimeStamp(strtotime($latestVid->date))->diffForHumans() }}
                                        &#8226; <a href="gallery?type={{ $latestVid->type->slug }}"
                                            class="p-0 m-0 text-decoration-none"><span
                                                class="type-tag">{{ $latestVid->type->type_name }}</span>
                                        </a>
                                    </p>
                                    <a href="/gallery/artists/{{ $latestVid->artist->codename ?? '' }}">
                                        <div class="d-flex flex-row align-items-center">
                                            <div>
                                                @if ($latestVid->artist?->artist_pict)
                                                    <img class="rounded-circle"
                                                        src="{{ asset('storage/' . $latestVid->artist->artist_pict) }}"
                                                        alt="{{ $latestVid->artist->artist_name }} thumbnail"
                                                        width="40px" height="40px">
                                                @else
                                                    <img class="rounded-circle"
                                                        src="{{ asset('img/unknown_artist.jpg') }}"
                                                        alt="{{ $latestVid->artist?->artist_name }} thumbnail"
                                                        width="40px" height="40px">
                                                @endif
                                            </div>
                                            <div>
                                                <p class="ml-10 mb-0 fw-semibold fs-14 text-color-100">
                                                    {{ $latestVid->artist?->artist_name }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-color-100 text-center">
                            <i class="las la-photo-video fs-48"></i>
                            <p class="fs-14 fw-medium mt-1 mb-0">
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
                            <a href="/gallery/videos/{{ $recVideo->id }}">
                                @if ($recVideo->thumbnail !== null)
                                    <img src="{{ $recVideo->thumbnail }}" class="thumbnail m-0 p-0 img-fluid"
                                        alt="{{ $recVideo->project_title }} thumbnail">
                                @else
                                    <img src="{{ asset('img/no_thumbnail.jpg') }}" class="thumbnail m-0 p-0 img-fluid"
                                        alt="{{ $recVideo->project_title }} thumbnail">
                                @endif
                                <div class="video-desc-card">
                                    <a href="gallery?category={{ $recVideo->category->slug }}">
                                        <p @class([
                                            'mb5',
                                            'fs-inter-14',
                                            'fw-semibold',
                                            'text-color-ad' =>
                                                $recVideo->category->category_name === 'Album Distribution',
                                            'text-color-ae' => $recVideo->category->category_name === 'Album Evolution',
                                            'text-color-cd' =>
                                                $recVideo->category->category_name === 'Center Distribution',
                                            'text-color-hs' => $recVideo->category->category_name === 'How Should',
                                            'text-color-hw' => $recVideo->category->category_name === 'How Would',
                                            'text-color-ld' =>
                                                $recVideo->category->category_name === 'Line Distribution',
                                            'text-color-le' => $recVideo->category->category_name === 'Line Evolution',
                                            'text-color-rb' => $recVideo->category->category_name === 'Ranking Battle',
                                        ])>
                                            {{ $recVideo->category->category_name }}
                                        </p>
                                    </a>
                                    <h4>{{ $recVideo->project_title }}</h4>
                                    <p class="date-text">
                                        {{ \Carbon\Carbon::createFromTimeStamp(strtotime($recVideo->date))->diffForHumans() }}
                                        &#8226; <a href="gallery?type={{ $recVideo->type->slug }}"
                                            class="p-0 m-0 text-decoration-none"><span
                                                class="type-tag">{{ $recVideo->type->type_name }}</span>
                                        </a>
                                    </p>
                                    <a href="/gallery/artists/{{ $recVideo->artist->codename ?? '' }}">
                                        <div class="d-flex flex-row align-items-center">
                                            <div>
                                                @if ($recVideo->artist?->artist_pict)
                                                    <img class="rounded-circle"
                                                        src="{{ asset('storage/' . $recVideo->artist?->artist_pict) }}"
                                                        alt="{{ $recVideo->artist->artist_name }} thumbnail"
                                                        width="40px" height="40px">
                                                @else
                                                    <img class="rounded-circle"
                                                        src="{{ asset('img/unknown_artist.jpg') }}"
                                                        alt="{{ $recVideo->artist?->artist_name }} thumbnail"
                                                        width="40px" height="40px">
                                                @endif
                                            </div>
                                            <div>
                                                <p class="ml-10 mb-0 fw-semibold fs-14 text-color-100">
                                                    {{ $recVideo->artist?->artist_name }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-color-100 text-center">
                            <i class="las la-photo-video fs-48"></i>
                            <p class="fs-14 fw-medium mt-1 mb-0">
                                No Video Found!
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>
        </section>
    @endif
@endsection
