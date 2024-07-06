@extends('layouts.main')

@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb" class="space-navbar">
        <ol class="breadcrumb fs-sm-12">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/gallery">Gallery</a></li>
            <li class="breadcrumb-item"><a
                    href="/gallery/artists/{{ $video->artist->codename }}">{{ $video->artist->artist_name }}</a></li>
            <li class="breadcrumb-item breadcumb-active text-truncate" aria-current="page">
                {{ $video->project_title }}
            </li>
        </ol>
    </nav>

    <section id="video-detail">
        <div class="row mb-5">
            <div class="col-12 col-lg-8 mb-lg-30">
                <div class="ratio ratio-16x9">
                    <iframe class="rounded-10" src="{{ $video->url }}"
                        title="{{ $video->project_title }} YouTube video" allowfullscreen></iframe>
                </div>
                <div class="detail-video-description">
                    <p @class([
                        'mb-10',
                        'fs-14',
                        'font-inter',
                        'fw-semibold',
                        'text-color-ad' => $video->category->category_name === 'Album Distribution',
                        'text-color-ae' => $video->category->category_name === 'Total Line Evolution',
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
                    <h3 class="fw-semibold text-color-100 mb-10">{{ $video->project_title }}</h3>
                    <p class="fs-14 mb-10 text-color-100"><i class="las la-calendar"></i>
                        <span
                            class="fs-14 font-inter fw-medium">{{ \Carbon\Carbon::parse($video->date)->format('d F Y, G:i T') }}</span>
                        •
                        <span class="fw-semibold fs-14">{{ $video->type->type_name }}</span>
                    </p>
                    <p class="fs-14 font-inter fw-medium mb-10 text-color-100"><i class="las la-user-alt"></i>
                        {{ $video->requester }} |
                        {{ $video->votes }} votes</p>
                    <p class="mb-10 fw-medium fs-14 font-inter text-color-100">Request Created at
                        {{ \Carbon\Carbon::parse($video->created_at)->format('d F Y, G:i T') }}
                    </p>
                    <p class="mb-10 fs-14 font-inter text-color-100">{{ $video->notes }}</p>
                    <a class="text-decoration-none" href="/gallery/artists/{{ $video->artist->codename ?? '' }}">
                        <div class="d-flex flex-row align-items-center">
                            <div>
                                @if ($video->artist->artist_pict)
                                    <img class="rounded-circle img-square"
                                        src="{{ asset('storage/' . $video->artist->artist_pict) }}"
                                        alt="{{ $video->artist->artist_name }} thumbnail" width="40px">
                                @else
                                    <img class="rounded-circle img-square" src="{{ asset('img/unknown_artist.jpg') }}"
                                        alt="{{ $video->artist->artist_name }} thumbnail" width="40px">
                                @endif
                            </div>
                            <div>
                                <p class="ml-10 mb-0 fw-medium text-color-100">
                                    {{ $video->artist->artist_name }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <h3 class="fw-medium text-color-100 mb-10">Related</h3>
                @forelse ($relatedVideo as $related)
                    <a href="/gallery/videos/{{ $related->id }}" class="text-decoration-none">
                        <div class="row {{ $loop->last ? '' : 'mb-15' }}">
                            <div class="col-12 col-xl-6 pe-xl-0">
                                @if ($related->thumbnail)
                                    <img src="{{ $related->thumbnail }}" alt="{{ $related->project_title }} thumbnail"
                                        class="img-fluid thumbnail-mini">
                                @else
                                    <img src="{{ asset('img/no_thumbnail.jpg') }}"
                                        alt="{{ $related->project_title }} thumbnail" class="img-fluid thumbnail-mini">
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
                                        'text-color-ae' => $related->category->category_name === 'Total Line Evolution',
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
                                    <h5 class="fw-semibold text-color-100 mb5 text-truncate" title="{{ $related->project_title }}">{{ $related->project_title }}</h5>
                                    <p class="m-0 text-color-80 p-0 fs-12 font-inter fw-medium">
                                        {{ \Carbon\Carbon::parse($related->date)->diffForHumans() }} •
                                        {{ $related->type->type_name }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="text-color-100 text-center">
                        <i class="las la-photo-video fs-1"></i>
                        <p class="mt-1 fs-14 fw-medium mb-0">
                            No Video Found!
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
