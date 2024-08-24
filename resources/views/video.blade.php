@extends('layouts.main')

@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb" class="space-navbar">
        <ol class="breadcrumb fs-sm-12">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/gallery">Gallery</a></li>
            <li class="breadcrumb-item breadcumb-active text-truncate" aria-current="page">
                {{ $video->title }}
            </li>
        </ol>
    </nav>

    <section id="video-detail">
        <div class="row mb-5">
            <div class="col-12 col-lg-8 mb-lg-30">
                <div class="ratio ratio-16x9">
                    <iframe class="rounded-10" src="{{ 'https://www.youtube.com/embed/' . $video->youtube_id }}"
                        title="{{ $video->title }} YouTube video" allowfullscreen></iframe>
                </div>
                <div class="detail-video-description">
                    <p @class([
                        'mb-10',
                        'fs-14',
                        'font-inter',
                        'fw-semibold',
                        'text-color-ad' => $video->category->category_name === 'Album Distribution',
                        'text-color-ae' =>
                            $video->category->category_name === 'Total Line Evolution',
                        'text-color-cd' =>
                            $video->category->category_name === 'Center Distribution',
                        'text-color-hs' => $video->category->category_name === 'How Should',
                        'text-color-hw' => $video->category->category_name === 'How Would',
                        'text-color-ld' => $video->category->category_name === 'Line Distribution',
                        'text-color-le' => $video->category->category_name === 'Line Evolution',
                        'text-color-rb' => $video->category->category_name === 'Ranking Battle',
                        'text-info' => $video->category->category_name === 'Other',
                    ])>
                        {{ $video->category->category_name }}
                    </p>
                    <h3 class="fw-semibold text-color-100 mb-10">{{ $video->title }}</h3>
                    <p class="fs-14 text-color-100 mb-10"><i class="las la-calendar"></i>
                        <span
                            class="fs-14 font-inter fw-medium">{{ \Carbon\Carbon::parse($video->date)->format('d F Y, G:i T') }}</span>
                        •
                        <span class="fw-semibold fs-14">{{ $video->projectType->type_name }}</span>
                    </p>
                    <p class="fs-14 font-inter fw-medium text-color-100 mb-10"><i class="las la-user-alt"></i>
                        {{ $video->requester }} |
                        {{ $video->votes }} votes</p>
                    <p class="fw-medium fs-14 font-inter text-color-100 mb-10">Request Created at
                        {{ \Carbon\Carbon::parse($video->created_at)->format('d F Y, G:i T') }}
                    </p>
                    <p class="fs-14 font-inter text-color-100 mb-10">{{ $video->notes }}</p>
                    @if ($video->artists->count() >= 1)
                        <div id="projectArtists" class="d-flex flex-column row-gap-2">
                            @foreach ($video->artists->sortBy('artist_name') as $artists)
                                <a class="text-decoration-none" href="/gallery/artists/{{ $artists->codename ?? '' }}">
                                    <div class="d-flex align-items-center column-gap-2">
                                        <div>
                                            @if ($artists->artist_picture)
                                                <img class="rounded-circle img-square"
                                                    src="{{ asset('storage/' . $artists->artist_picture) }}"
                                                    alt="{{ $artists->artist_name }} thumbnail" width="40px">
                                            @else
                                                <img class="rounded-circle img-square"
                                                    src="{{ asset('img/unknown_artist.jpg') }}"
                                                    alt="{{ $artists->artist_name }} thumbnail" width="40px">
                                            @endif
                                        </div>
                                        <div>
                                            <p class="fw-medium text-color-100 mb-0">
                                                {{ $artists->artist_name }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
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
                    </a>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <h3 class="fw-medium text-color-100 mb-10">Related</h3>
                @forelse ($relatedVideo as $related)
                    <a href="/gallery/videos/{{ $related->id }}" class="text-decoration-none">
                        <div class="row {{ $loop->last ? '' : 'mb-15' }}">
                            <div class="col-12 col-xl-6 pe-xl-0">
                                @if ($related->youtube_id)
                                    <img src="{{ 'https://i3.ytimg.com/vi/' . $related->youtube_id . '/maxresdefault.jpg' }}"
                                        alt="{{ $related->title }} thumbnail" class="img-fluid thumbnail-mini">
                                @else
                                    <img src="{{ asset('img/no_thumbnail.jpg') }}" alt="{{ $related->title }} thumbnail"
                                        class="img-fluid thumbnail-mini">
                                @endif
                            </div>
                            <div class="col-12 col-xl-6 ps-xl-0">
                                <div class="related-vid-container justify-content-center d-flex flex-column">
                                    <p @class([
                                        'mb5',
                                        'fs-12',
                                        'font-inter',
                                        'fw-semibold',
                                        'text-color-ad' =>
                                            $related->category->category_name === 'Album Distribution',
                                        'text-color-ae' =>
                                            $related->category->category_name === 'Total Line Evolution',
                                        'text-color-cd' =>
                                            $related->category->category_name === 'Center Distribution',
                                        'text-color-hs' => $related->category->category_name === 'How Should',
                                        'text-color-hw' => $related->category->category_name === 'How Would',
                                        'text-color-ld' =>
                                            $related->category->category_name === 'Line Distribution',
                                        'text-color-le' => $related->category->category_name === 'Line Evolution',
                                        'text-color-rb' => $related->category->category_name === 'Ranking Battle',
                                        'text-info' => $related->category->category_name === 'Other',
                                    ])>
                                        {{ $related->category->category_name }}
                                    </p>
                                    <h5 class="fw-semibold text-color-100 mb5 text-truncate" title="{{ $related->title }}">
                                        {{ $related->title }}</h5>
                                    <p class="text-color-80 fs-12 font-inter fw-medium m-0 p-0">
                                        {{ \Carbon\Carbon::parse($related->date)->diffForHumans() }} •
                                        {{ $related->projectType->type_name }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="text-color-100 text-center">
                        <i class="las la-photo-video fs-1"></i>
                        <p class="fs-14 fw-medium mb-0 mt-1">
                            No Video Found!
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
