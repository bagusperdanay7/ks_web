@extends('layouts.main')

@section('container')
    <div class="row gallery-section">
        <h1 class="mb-3">Explore</h1>
        <div class="col mb-4">
            <form class="" action="/gallery">
                @if (request('content_category'))
                    <input type="hidden" name="content_category" value="{{ request('content_category') }}">
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
                        id="searchGallery" name="search" value="{{ request('search') }}">
                </div>
            </form>

        </div>
    </div>

    {{-- TODO:tambahin juga {{ Route::current()->getName() }} jika yang diakses url artist atau bikin filter --}}
    @if (request('search') or request('artist') or request('content_category'))
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
                            @if ($gallery->project_thumbnail != null)
                                <img src="{{ $gallery->project_thumbnail }}" class="rounded thumbnail m-0 p-0"
                                    width="100%" alt="{{ $gallery->project_title }} thumbnail">
                            @else
                                <img src="{{ asset('img/no_thumbnail.jpg') }}" class="rounded thumbnail m-0 p-0"
                                    width="100%" alt="{{ $gallery->project_title }} thumbnail">
                            @endif
                            <a href="gallery?content_category={{ $gallery->content_category->slug }}">
                                <p class="category-text-video">{{ $gallery->content_category->name }}</p>
                            </a>
                            <h4>{{ $gallery->project_title }}
                                ({{ $gallery->content_category->name }})
                            </h4>
                            <span
                                class="pro-class-date">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($gallery->project_date))->diffForHumans() }}
                                &#8226; <a href="gallery?search={{ $gallery->project_class }}"
                                    class="p-0 m-0 text-decoration-none"><span
                                        class="pro-class-text">{{ $gallery->project_class }}</span>
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
                    @foreach ($recommendation_video as $rec_vids)
                        <div class="col-4 artist-card mb-3">
                            <a href="/gallery/videos/{{ $rec_vids->id }}">
                                <div class="video-description-card">
                                    @if ($rec_vids->project_thumbnail != null)
                                        <img src="{{ $rec_vids->project_thumbnail }}" class="rounded thumbnail m-0 p-0"
                                            width="100%" alt="{{ $rec_vids->project_title }} thumbnail">
                                    @else
                                        <img src="{{ asset('img/no_thumbnail.jpg') }}" class="rounded thumbnail m-0 p-0"
                                            width="100%" alt="{{ $rec_vids->project_title }} thumbnail">
                                    @endif
                                    <a href="gallery?content_category={{ $rec_vids->content_category->slug }}">
                                        <p class="category-text-video">{{ $rec_vids->content_category->name }}</p>
                                    </a>
                                    <h4>{{ $rec_vids->project_title }}
                                        ({{ $rec_vids->content_category->name }})
                                    </h4>
                                    <span
                                        class="pro-class-date">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($rec_vids->project_date))->diffForHumans() }}
                                        &#8226; <a href="gallery?search={{ $rec_vids->project_class }}"
                                            class="p-0 m-0 text-decoration-none"><span
                                                class="pro-class-text">{{ $rec_vids->project_class }}</span>
                                        </a>
                                    </span>
                                    <div class="d-flex flex-row my-2 px-2 pb-2">
                                        <div>
                                            <a href="/gallery?artist={{ $rec_vids->artist->codename }}">
                                                @if ($rec_vids->artist->artist_pict != null)
                                                    <img class="rounded-circle fit-img"
                                                        src="{{ asset('img/artist/' . $rec_vids->artist->artist_pict) }}"
                                                        alt="{{ $rec_vids->artist->artist_name }} thumbnail" width="40px"
                                                        height="40px">
                                                @else
                                                    <img class="rounded-circle fit-img"
                                                        src="{{ asset('img/artist/unknown_artist.jpg') }}"
                                                        alt="{{ $rec_vids->artist->artist_name }} thumbnail" width="40px"
                                                        height="40px">
                                                @endif

                                            </a>
                                        </div>
                                        <div class="align-self-center">
                                            <a href="/gallery?artist={{ $rec_vids->artist->codename }}">
                                                <p class="mx-2 my-0 py-0">{{ $rec_vids->artist->artist_name }}</p>
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
                    <a href="/gallery/content_categories">
                        <span>Show All Categories</span>
                    </a>
                </div>
            </div>
            @foreach ($categories as $category)
                <div class="col-3 category-card">
                    <a href="/gallery?content_category={{ $category->content_category->slug }}">
                        <div class="d-flex align-items-center gallery-card">
                            <div class="">
                                <i class="{{ $category->content_category->icon_class }}"></i>
                            </div>
                            <div class="space-card">
                                <h5>{{ $category->content_category->name }}</h5>
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
                    <a href="/gallery/artists">
                        <span>Show All Artist</span>
                    </a>
                </div>
            </div>
            @foreach ($artists_total as $artist_total)
                <div class="col-2 artist-card">
                    <a href="/gallery?artist={{ $artist_total->artist->codename }}">
                        @if ($artist_total->artist->artist_pict != null)
                            <img src="{{ asset('img/artist/' . $artist_total->artist->artist_pict) }}"
                                class="rounded artist-image" width="195px" height="195px"
                                alt="{{ $artist_total->artist->artist_name }}">
                        @else
                            <img src="{{ asset('img/artist/unknown_artist.jpg') }}" class="rounded artist-image"
                                width="195px" height="195px" alt="{{ $artist_total->artist->artist_name }}">
                        @endif
                        <p>{{ $artist_total->artist->artist_name }}</p>
                        <span>{{ $artist_total->total }} Videos</span>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="row justify-content-between mb-4">
            <div class="gallery-cards-head">
                <h3>Latest Video</h3>
            </div>
            @foreach ($latest_video as $latest_vid)
                <div class="col-4 artist-card">
                    <a href="/gallery/videos/{{ $latest_vid->id }}">
                        <div class="video-description-card">
                            @if ($latest_vid->project_thumbnail != null)
                                <img src="{{ $latest_vid->project_thumbnail }}" class="rounded thumbnail m-0 p-0"
                                    width="100%" alt="{{ $latest_vid->project_title }} thumbnail">
                            @else
                                <img src="{{ asset('img/no_thumbnail.jpg') }}" class="rounded thumbnail m-0 p-0"
                                    width="100%" alt="{{ $latest_vid->project_title }} thumbnail">
                            @endif
                            <a href="gallery?content_category={{ $latest_vid->content_category->slug }}">
                                <p class="category-text-video">{{ $latest_vid->content_category->name }}</p>
                            </a>
                            <h4>{{ $latest_vid->project_title }}
                                ({{ $latest_vid->content_category->name }})
                            </h4>
                            <span
                                class="pro-class-date">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($latest_vid->project_date))->diffForHumans() }}
                                &#8226; <a href="gallery?search={{ $latest_vid->project_class }}"
                                    class="p-0 m-0 text-decoration-none"><span
                                        class="pro-class-text">{{ $latest_vid->project_class }}</span>
                                </a>
                            </span>
                            <div class="d-flex flex-row my-2 px-2 pb-2">
                                <div>
                                    <a href="/gallery?artist={{ $latest_vid->artist->codename }}">
                                        @if ($latest_vid->artist->artist_pict != null)
                                            <img class="rounded-circle fit-img"
                                                src="{{ asset('img/artist/' . $latest_vid->artist->artist_pict) }}"
                                                alt="{{ $latest_vid->artist->artist_name }} thumbnail" width="40px"
                                                height="40px">
                                        @else
                                            <img class="rounded-circle fit-img"
                                                src="{{ asset('img/artist/unknown_artist.jpg') }}"
                                                alt="{{ $latest_vid->artist->artist_name }} thumbnail" width="40px"
                                                height="40px">
                                        @endif
                                    </a>
                                </div>
                                <div class="align-self-center">
                                    <a href="/gallery?artist={{ $latest_vid->artist->codename }}">
                                        <p class="mx-2 my-0 py-0">{{ $latest_vid->artist->artist_name }}</p>
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
            @foreach ($recommendation_video as $rec_vids)
                <div class="col-4 artist-card mb-3">
                    <a href="/gallery/videos/{{ $rec_vids->id }}">
                        <div class="video-description-card">
                            @if ($rec_vids->project_thumbnail != null)
                                <img src="{{ $rec_vids->project_thumbnail }}" class="rounded thumbnail m-0 p-0"
                                    width="100%" alt="{{ $rec_vids->project_title }} thumbnail">
                            @else
                                <img src="{{ asset('img/no_thumbnail.jpg') }}" class="rounded thumbnail m-0 p-0"
                                    width="100%" alt="{{ $rec_vids->project_title }} thumbnail">
                            @endif
                            <a href="gallery?content_category={{ $rec_vids->content_category->slug }}">
                                <p class="category-text-video">{{ $rec_vids->content_category->name }}</p>
                            </a>
                            <h4>{{ $rec_vids->project_title }}
                                ({{ $rec_vids->content_category->name }})
                            </h4>
                            <span
                                class="pro-class-date">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($rec_vids->project_date))->diffForHumans() }}
                                &#8226; <a href="gallery?search={{ $rec_vids->project_class }}"
                                    class="p-0 m-0 text-decoration-none"><span
                                        class="pro-class-text">{{ $rec_vids->project_class }}</span>
                                </a>
                            </span>
                            <div class="d-flex flex-row my-2 px-2 pb-2">
                                <div>
                                    <a href="/gallery?artist={{ $rec_vids->artist->codename }}">
                                        @if ($rec_vids->artist->artist_pict != null)
                                            <img class="rounded-circle fit-img"
                                                src="{{ asset('img/artist/' . $rec_vids->artist->artist_pict) }}"
                                                alt="{{ $rec_vids->artist->artist_name }} thumbnail" width="40px"
                                                height="40px">
                                        @else
                                            <img class="rounded-circle fit-img"
                                                src="{{ asset('img/artist/unknown_artist.jpg') }}"
                                                alt="{{ $rec_vids->artist->artist_name }} thumbnail" width="40px"
                                                height="40px">
                                        @endif

                                    </a>
                                </div>
                                <div class="align-self-center">
                                    <a href="/gallery?artist={{ $rec_vids->artist->codename }}">
                                        <p class="mx-2 my-0 py-0">{{ $rec_vids->artist->artist_name }}</p>
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
