@extends('layouts.main')

@section('content')
    <div class="row gallery-section">
        <h1 class="mb-3">Explore</h1>
        <div class="col mb-4">
            <form class="search-gallery-form" action="/gallery">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif

                @if (request('artist'))
                    <input type="hidden" name="artist" value="{{ request('artist') }}">
                @endif
                {{-- <button class="btn btn-primary mb-3 " type="button" onclick="toggleFilter()">Filter</button>
                <div class="hide" id="showFilter">aDA NIH</div> --}}
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="las la-search icon-transform icon-size-18"></i>
                    </span>
                    <input type="search" class="form-control shadow-none"
                        placeholder="Search title, artist, or project class (Press /)" aria-label="Search"
                        id="searchGallery" name="search" value="{{ request('search') }}" autofocus>
                </div>
            </form>
        </div>
    </div>

    {{-- TODO:tambahin juga {{ Route::current()->getName() }} jika yang diakses url artist atau bikin filter --}}
    @if (request('search') or request('artist') or request('category'))
        <div class="row  mb-4">
            <div class="gallery-cards-head">
                <h3>Search Results <span class="align-middle badge bg-black-80">
                        {{ $gallery->count() }}
                    </span>
                </h3>
            </div>
            @forelse ($gallery as $gallery)
                <div class="col-4 artist-card mb-3">
                    <a href="/gallery/videos/{{ $gallery->id }}">
                        <div class="video-description-card">
                            @if ($gallery->thumbnail != null)
                                <img src="{{ $gallery->thumbnail }}" class="rounded thumbnail m-0 p-0" width="100%"
                                    alt="{{ $gallery->project_title }} thumbnail">
                            @else
                                <img src="{{ asset('img/no_thumbnail.jpg') }}" class="rounded thumbnail m-0 p-0"
                                    width="100%" alt="{{ $gallery->project_title }} thumbnail">
                            @endif
                            <a href="gallery?category={{ $gallery->category->slug }}">
                                <p class="category-text-video">{{ $gallery->category->category_name }}</p>
                            </a>
                            <h4>{{ $gallery->project_title }}
                                ({{ $gallery->category->category_name }})
                            </h4>
                            <span
                                class="pro-class-date">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($gallery->date))->diffForHumans() }}
                                &#8226; <a href="gallery?search={{ $gallery->type->type_name }}"
                                    class="p-0 m-0 text-decoration-none"><span
                                        class="pro-class-text">{{ $gallery->type->type_name }}</span>
                                </a>
                            </span>
                            <p class="px-3 text-primary">{{ $gallery->project_status }}</p>
                            <div class="d-flex flex-row my-2 px-2 pb-2">
                                <div>
                                    <a href="/gallery?artist={{ $gallery->artist->codename }}">
                                        @if ($gallery->artist->artist_pict)
                                            <img class="rounded-circle fit-img"
                                                src="{{ asset('storage' . $gallery->artist->artist_pict) }}"
                                                alt="{{ $gallery->artist->artist_name }} thumbnail" width="40px"
                                                height="40px">
                                        @else
                                            <img class="rounded-circle fit-img" src="{{ asset('img/unknown_artist.jpg') }}"
                                                alt="{{ $gallery->artist->artist_name }} thumbnail" width="40px"
                                                height="40px">
                                        @endif
                                    </a>
                                </div>
                                <div class="align-self-center">
                                    <a href="/gallery?artist={{ $gallery->artist->codename }}">
                                        <p class="mx-2 my-0 py-0">{{ $gallery->artist->artist_name }}</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="row">
                    <div class="col text-center">
                        <svg width="48" height="48" viewBox="0 0 84 84" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                fill="#EA8887" />
                            <path
                                d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                fill="#787878" />
                        </svg>
                        <h5 class="mt-2 text-center">No search results found!</h5>
                    </div>
                </div>
                <div class="row justify-content-between mb-4">
                    <div class="gallery-cards-head">
                        <h3>For You</h3>
                    </div>
                    @foreach ($recommendationVideo as $recVideo)
                        <div class="col-4 artist-card mb-3">
                            <a href="/gallery/videos/{{ $recVideo->id }}">
                                <div class="video-description-card">
                                    @if ($recVideo->thumbnail != null)
                                        <img src="{{ $recVideo->thumbnail }}" class="rounded thumbnail m-0 p-0"
                                            width="100%" alt="{{ $recVideo->project_title }} thumbnail">
                                    @else
                                        <img src="{{ asset('img/no_thumbnail.jpg') }}" class="rounded thumbnail m-0 p-0"
                                            width="100%" alt="{{ $recVideo->project_title }} thumbnail">
                                    @endif
                                    <a href="gallery?category={{ $recVideo->category->slug }}">
                                        <p class="category-text-video">{{ $recVideo->category->category_name }}</p>
                                    </a>
                                    <h4>{{ $recVideo->project_title }}
                                        ({{ $recVideo->category->category_name }})
                                    </h4>
                                    <span
                                        class="pro-class-date">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($recVideo->date))->diffForHumans() }}
                                        &#8226; <a href="gallery?search={{ $recVideo->type->type_name }}"
                                            class="p-0 m-0 text-decoration-none"><span
                                                class="pro-class-text">{{ $recVideo->type->type_name }}</span>
                                        </a>
                                    </span>
                                    <div class="d-flex flex-row my-2 px-2 pb-2">
                                        <div>
                                            <a href="/gallery?artist={{ $recVideo->artist->codename }}">
                                                @if ($recVideo->artist->artist_pict)
                                                    <img class="rounded-circle fit-img"
                                                        src="{{ asset('storage/' . $recVideo->artist->artist_pict) }}"
                                                        alt="{{ $recVideo->artist->artist_name }} thumbnail" width="40px"
                                                        height="40px">
                                                @else
                                                    <img class="rounded-circle fit-img"
                                                        src="{{ asset('img/unknown_artist.jpg') }}"
                                                        alt="{{ $recVideo->artist->artist_name }} thumbnail" width="40px"
                                                        height="40px">
                                                @endif

                                            </a>
                                        </div>
                                        <div class="align-self-center">
                                            <a href="/gallery?artist={{ $recVideo->artist->codename }}">
                                                <p class="mx-2 my-0 py-0">{{ $recVideo->artist->artist_name }}</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforelse
        </div>
    @else
        <div class="row justify-content-between mb-4">
            <div class="d-flex justify-content-between gallery-cards-head">
                <div>
                    <h3>Content Category</h3>
                </div>
                <div class="align-self-end">
                    <a href="{{ route('categories') }}">
                        <span>Show All Categories</span>
                    </a>
                </div>
            </div>
            @foreach ($categories as $category)
                <div class="col-3 category-card">
                    <a href="/gallery?category={{ $category->category->slug }}">
                        <div class="d-flex align-items-center gallery-card">
                            <div class="">
                                <i class="{{ $category->category->icon_class }}"></i>
                            </div>
                            <div class="space-card">
                                <h5>{{ $category->category->category_name }}</h5>
                                <p>{{ $category->total }} videos</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="row mb-4">
            <div class="d-flex justify-content-between gallery-cards-head">
                <div>
                    <h3>Artist</h3>
                </div>
                <div class="align-self-end">
                    <a href="{{ route('artists') }}">
                        <span>Show All Artist</span>
                    </a>
                </div>
            </div>
            @forelse ($artistsTotal as $artistTotal)
                <div class="col-2 artist-card">
                    <a href="/gallery?artist={{ $artistTotal->artist->codename ?? '' }}">
                        @if ($artistTotal->artist?->artist_pict)
                            <img src="{{ asset('storage/' . $artistTotal->artist->artist_pict ?? '') }}"
                                class="rounded artist-image" width="195px" height="195px"
                                alt="{{ $artistTotal->artist->artist_name }}">
                        @else
                            <img src="{{ asset('img/unknown_artist.jpg') }}" class="rounded artist-image" width="195px"
                                height="195px" alt="{{ $artistTotal->artist->artist_name ?? '' }}">
                        @endif
                        <p>{{ $artistTotal->artist->artist_name ?? '' }}</p>
                        <span>{{ $artistTotal->total ?? '' }} Videos</span>
                    </a>
                </div>
            @empty
                <div class="col-2 artist-card">
                    <a href="/gallery?artist=">
                        <img src="{{ asset('img/unknown_artist.jpg') }}" class="rounded artist-image" width="195px"
                            height="195px" alt="">
                        <p>No Artist</p>
                        <span>0 Videos</span>
                    </a>
                </div>
            @endforelse
        </div>

        <div class="row justify-content-between mb-4">
            <div class="gallery-cards-head">
                <h3>Latest Video</h3>
            </div>
            {{-- TODO: https://laraveldaily.com/post/laravel-relation-attempt-to-read-property-on-null-error --}}
            @foreach ($latestVideo as $latestVid)
                <div class="col-4 artist-card">
                    <a href="/gallery/videos/{{ $latestVid->id }}">
                        <div class="video-description-card">
                            @if ($latestVid->thumbnail !== null)
                                <img src="{{ $latestVid->thumbnail }}" class="rounded thumbnail m-0 p-0" width="100%"
                                    alt="{{ $latestVid->project_title }} thumbnail">
                            @else
                                <img src="{{ asset('img/no_thumbnail.jpg') }}" class="rounded thumbnail m-0 p-0"
                                    width="100%" alt="{{ $latestVid->project_title }} thumbnail">
                            @endif
                            <a href="gallery?category={{ $latestVid->category->slug }}">
                                <p class="category-text-video">{{ $latestVid->category->category_name }}</p>
                            </a>
                            <h4>{{ $latestVid->project_title }}
                                ({{ $latestVid->category->category_name }})
                            </h4>
                            <span
                                class="pro-class-date">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($latestVid->date))->diffForHumans() }}
                                &#8226; <a href="gallery?search={{ $latestVid->type->type_name }}"
                                    class="p-0 m-0 text-decoration-none"><span
                                        class="pro-class-text">{{ $latestVid->type->type_name }}</span>
                                </a>
                            </span>
                            <div class="d-flex flex-row my-2 px-2 pb-2">
                                <div>
                                    <a href="/gallery?artist={{ $latestVid->artist->codename ?? '' }}">
                                        @if ($latestVid->artist->artist_pict)
                                            <img class="rounded-circle fit-img"
                                                src="{{ asset('storage/' . $latestVid->artist->artist_pict) }}"
                                                alt="{{ $latestVid->artist->artist_name }} thumbnail" width="40px"
                                                height="40px">
                                        @else
                                            <img class="rounded-circle fit-img"
                                                src="{{ asset('img/unknown_artist.jpg') }}"
                                                alt="{{ $latestVid->artist->artist_name }} thumbnail" width="40px"
                                                height="40px">
                                        @endif
                                    </a>
                                </div>
                                <div class="align-self-center">
                                    <a href="/gallery?artist={{ $latestVid->artist->codename }}">
                                        <p class="mx-2 my-0 py-0">{{ $latestVid->artist->artist_name }}</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="row justify-content-between mb-4">
            <div class="gallery-cards-head">
                <h3>Recommended For You</h3>
            </div>
            @foreach ($recommendationVideo as $recVideo)
                <div class="col-4 artist-card mb-3">
                    <a href="/gallery/videos/{{ $recVideo->id }}">
                        <div class="video-description-card">
                            @if ($recVideo->thumbnail != null)
                                <img src="{{ $recVideo->thumbnail }}" class="rounded thumbnail m-0 p-0" width="100%"
                                    alt="{{ $recVideo->project_title }} thumbnail">
                            @else
                                <img src="{{ asset('img/no_thumbnail.jpg') }}" class="rounded thumbnail m-0 p-0"
                                    width="100%" alt="{{ $recVideo->project_title }} thumbnail">
                            @endif
                            <a href="gallery?category={{ $recVideo->category->slug }}">
                                <p class="category-text-video">{{ $recVideo->category->category_name }}</p>
                            </a>
                            <h4>{{ $recVideo->project_title }}
                                ({{ $recVideo->category->category_name }})
                            </h4>
                            <span
                                class="pro-class-date">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($recVideo->date))->diffForHumans() }}
                                &#8226; <a href="gallery?search={{ $recVideo->type->type_name }}"
                                    class="p-0 m-0 text-decoration-none"><span
                                        class="pro-class-text">{{ $recVideo->type->type_name }}</span>
                                </a>
                            </span>
                            <div class="d-flex flex-row my-2 px-2 pb-2">
                                <div>
                                    <a href="/gallery?artist={{ $recVideo->artist->codename ?? '' }}">
                                        @if ($recVideo->artist?->artist_pict)
                                            <img class="rounded-circle fit-img"
                                                src="{{ asset('storage/' . $recVideo->artist->artist_pict) }}"
                                                alt="{{ $recVideo->artist->artist_name ?? '' }} thumbnail" width="40px"
                                                height="40px">
                                        @else
                                            <img class="rounded-circle fit-img"
                                                src="{{ asset('img/unknown_artist.jpg') }}"
                                                alt="{{ $recVideo->artist->artist_name ?? '' }} thumbnail" width="40px"
                                                height="40px">
                                        @endif

                                    </a>
                                </div>
                                <div class="align-self-center">
                                    <a href="/gallery?artist={{ $recVideo->artist->codename ?? '' }}">
                                        <p class="mx-2 my-0 py-0">{{ $recVideo->artist->artist_name ?? '' }}</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif

@endsection
