@extends('layouts.main')

@section('container')
    <div class="row gallery-section">
        <h1 class="mb-3">Explore</h1>
        <div class="col mb-4">
            <form class="" action="/gallery">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif

                @if (request('artist'))
                    <input type="hidden" name="artist" value="{{ request('artist') }}">
                @endif
                {{-- <button class="btn btn-primary mb-3 " type="button" onclick="toggleFilter()">Filter</button>
                <div class="hide" id="showFilter">aDA NIH</div> --}}
                <div class="form-group search-icon-pos">
                    <i class="las la-search form-control-feedback icon-transform"></i>
                    <input type="search" class="form-control search-form shadow-none"
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
                                        @if ($gallery->artist->artist_pict != null)
                                            <img class="rounded-circle fit-img"
                                                src="{{ asset('img/artist/' . $gallery->artist->artist_pict) }}"
                                                alt="{{ $gallery->artist->artist_name }} thumbnail" width="40px"
                                                height="40px">
                                        @else
                                            <img class="rounded-circle fit-img"
                                                src="{{ asset('img/artist/unknown_artist.jpg') }}"
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
                <h5 class="text-center"><i class="las la-search-minus icon-transform"></i> No search results found!</h5>
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
                                                @if ($recVideo->artist->artist_pict != null)
                                                    <img class="rounded-circle fit-img"
                                                        src="{{ asset('img/artist/' . $recVideo->artist->artist_pict) }}"
                                                        alt="{{ $recVideo->artist->artist_name }} thumbnail" width="40px"
                                                        height="40px">
                                                @else
                                                    <img class="rounded-circle fit-img"
                                                        src="{{ asset('img/artist/unknown_artist.jpg') }}"
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

        <div class="row justify-content-between mb-4">
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
            @foreach ($artistsTotal as $artistTotal)
                <div class="col-2 artist-card">
                    <a href="/gallery?artist={{ $artistTotal->artist->codename }}">
                        @if ($artistTotal->artist->artist_pict != null)
                            <img src="{{ asset('img/artist/' . $artistTotal->artist->artist_pict) }}"
                                class="rounded artist-image" width="195px" height="195px"
                                alt="{{ $artistTotal->artist->artist_name }}">
                        @else
                            <img src="{{ asset('img/artist/unknown_artist.jpg') }}" class="rounded artist-image"
                                width="195px" height="195px" alt="{{ $artistTotal->artist->artist_name }}">
                        @endif
                        <p>{{ $artistTotal->artist->artist_name }}</p>
                        <span>{{ $artistTotal->total }} Videos</span>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="row justify-content-between mb-4">
            <div class="gallery-cards-head">
                <h3>Latest Video</h3>
            </div>
            @foreach ($latestVideo as $latestVid)
                <div class="col-4 artist-card">
                    <a href="/gallery/videos/{{ $latestVid->id }}">
                        <div class="video-description-card">
                            @if ($latestVid->thumbnail != null)
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
                                    <a href="/gallery?artist={{ $latestVid->artist->codename }}">
                                        @if ($latestVid->artist->artist_pict != null)
                                            <img class="rounded-circle fit-img"
                                                src="{{ asset('img/artist/' . $latestVid->artist->artist_pict) }}"
                                                alt="{{ $latestVid->artist->artist_name }} thumbnail" width="40px"
                                                height="40px">
                                        @else
                                            <img class="rounded-circle fit-img"
                                                src="{{ asset('img/artist/unknown_artist.jpg') }}"
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
                                    <a href="/gallery?artist={{ $recVideo->artist->codename }}">
                                        @if ($recVideo->artist->artist_pict != null)
                                            <img class="rounded-circle fit-img"
                                                src="{{ asset('img/artist/' . $recVideo->artist->artist_pict) }}"
                                                alt="{{ $recVideo->artist->artist_name }} thumbnail" width="40px"
                                                height="40px">
                                        @else
                                            <img class="rounded-circle fit-img"
                                                src="{{ asset('img/artist/unknown_artist.jpg') }}"
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
    @endif

@endsection
