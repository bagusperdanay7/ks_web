@extends('layouts.main')

@section('content')
    <section id="album-detail" class="mb-50">
        <div class="row mb-6">
            <div class="col-12 col-md-6 col-lg-5 col-xl-4 mb-xl-0 mb-15">
                @if ($album->cover === null)
                    <img src="{{ asset('img/unknown_album.jpg') }}" class="img-square rounded-10 img-fluid w-100 shadow"
                        alt="{{ $album->cover }} picture">
                @else
                    <img src="{{ asset('storage/' . $album->cover) }}" class="img-square rounded-10 img-fluid w-100 shadow"
                        alt="{{ $album->cover }} picture">
                @endif

            </div>
            <div class="col-12 col-md-6 col-lg-7 col-xl-8 align-self-center">
                <span class="text-color-80 fw-medium fs-14">{{ $album->type }}</span>
                <h3 class="fw-bold text-color-100 mb-10">{{ $album->name }}</h3>
                <h4 class="fw-semibold mb-15">
                    @foreach ($album->artists->sortBy('artist_name') as $albumArtist)
                        <a href="{{ route('discography-artist', $albumArtist->codename) }}"
                            class="text-underline-hover text-color-primary">{{ $albumArtist->artist_name }}{{ $loop->last ? '' : ',' }}</a>
                    @endforeach

                </h4>
                <div class="row mb-10">
                    <div class="col-5 col-lg-4 col-xl-3 col-xxl-2">
                        <h4 class="fs-16 fw-medium text-color-100 fs-lg-14 m-0">Release</h4>
                    </div>
                    <div class="col">
                        <p class="text-color-100 fs-lg-14 m-0">{{ \Carbon\Carbon::parse($album->release)->format('d F Y') }}
                        </p>
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-5 col-lg-4 col-xl-3 col-xxl-2">
                        <h4 class="fs-16 fw-medium text-color-100 fs-lg-14 m-0">Publisher</h4>
                    </div>
                    <div class="col">
                        <p class="text-color-100 fs-lg-14 m-0">℗{{ $album->publisher->name }}</p>
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-5 col-lg-4 col-xl-3 col-xxl-2">
                        <h4 class="fs-16 fw-medium text-color-100 fs-lg-14 m-0">Company</h4>
                    </div>
                    <div class="col">
                        <p class="text-color-100 fs-lg-14 m-0">
                            @foreach ($album->artists as $albumArtist)
                                {{ $albumArtist->company->name }}{{ $loop->last ? '' : ',' }}
                            @endforeach
                        </p>
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-5 col-lg-4 col-xl-3 col-xxl-2">
                        <h4 class="fs-16 fw-medium text-color-100 fs-lg-14 m-0">Tracks</h4>
                    </div>
                    <div class="col">
                        <p class="text-color-100 fs-lg-14 m-0">{{ $album->songs->count() }}</p>
                    </div>
                </div>
            </div>
    </section>

    <section id="album-song">
        <div class="row mb-3">
            <div class="col">
                <h4 class="fw-bold text-color-100">Track Song</h5>
            </div>
        </div>
        <div class="row mb-10">
            <div class="col-2 col-md-1 text-color-100 fw-medium">
                #
            </div>
            <div class="col-6 col-md-8 text-color-100 fw-medium">
                Title
            </div>
            <div class="col-2 text-color-100 fw-medium">
                Duration
            </div>
            <div class="col-2 col-md-1 text-color-100 fw-medium">
            </div>
        </div>
        @forelse ($album->songs->sortBy('track_number') as $track)
            <div class="row mt-4">
                <div class="col-2 col-md-1 text-color-100 align-self-center">{{ $track->track_number }}</div>
                @if ($track->category === 'Title Track')
                    <div class="col-6 col-md-8 text-color-100 fs-14">
                        <p class="fw-medium mb-1"><i class="las la-star" title="{{ $track->category }}"></i>
                            {{ $track->title }}</p>
                        <p class="text-color-80 fw-normal mb-0">
                            @foreach ($track->artists->sortBy('artist_name') as $songArtist)
                                @if ($songArtist->pivot->role === 'Primary Artist')
                                    {{ $songArtist->artist_name }}{{ $loop->last ? '' : ',' }}
                                @endif
                            @endforeach
                        </p>
                    </div>
                @else
                    <div class="col-6 col-md-8 text-color-100 fs-14">
                        <p class="fw-medium mb-1">{{ $track->title }}</p>
                        <p class="text-color-80 fw-normal mb-0">
                            @foreach ($track->artists as $songArtist)
                                @if ($songArtist->pivot->role === 'Primary Artist')
                                    {{ $songArtist->artist_name }}{{ $loop->last ? '' : ',' }}
                                @endif
                            @endforeach
                        </p>
                    </div>
                @endif
                <div class="col-2 text-color-100 fs-14">
                    {{ \App\Http\Controllers\UtilsController::intToDuration($track->duration) }}</div>
                <div class="col-2 col-md-1 text-color-100 fs-14 text-end">
                    <button class="text-color-100 border-0 bg-transparent" data-bs-toggle="modal"
                        data-bs-target="#songInfoModal{{ $track->id }}" type="button"><i
                            class="las la-info-circle fs-18" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Show Song Details"></i>
                    </button>
                </div>
            </div>
        @empty
            <div class="row">
                <div class="col">
                    <div class="text-color-100 text-center">
                        <i class="las la-compact-disc fs-1"></i>
                        <p class="fw-medium fs-14 mb-0 mt-1">No Song Found!</p>
                    </div>
                </div>
            </div>
        @endforelse
    </section>

    @foreach ($album->songs as $trackDetails)
        <div class="modal fade" id="songInfoModal{{ $trackDetails->id }}" tabindex="-1"
            aria-labelledby="songInfoModalLabel{{ $trackDetails->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-10 bg-second">
                    <div class="modal-header">
                        <h3 class="modal-title text-color-100 fw-semibold" id="uploadModalLabel">Song Details</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4 class="fw-semibold mb-15 text-color-100">{{ $trackDetails->title }}</h4>
                        <p class="fw-semibold mb5 text-color-100 fs-14">Genre</p>
                        <p class="fw-medium mb-15 text-color-80 fs-14">
                            @foreach ($trackDetails->genres->sortBy('name') as $songGenre)
                                {{ $songGenre->name }}{{ $loop->last ? '' : ',' }}
                            @endforeach
                        </p>
                        <p class="fw-semibold mb5 text-color-100 fs-14">Written By</p>
                        <p class="fw-medium mb-15 text-color-80 fs-14">
                            @foreach ($trackDetails->artists as $songArtist)
                                    @if ($songArtist->pivot->role === 'Lyricist')
                                        {{ $songArtist->artist_name }}{{ $loop->last ? '' : ',' }}
                                    @endif
                            @endforeach
                        </p>
                        <p class="fw-semibold mb5 text-color-100 fs-14">Composed By</p>
                        <p class="fw-medium mb-15 text-color-80 fs-14">
                            @foreach ($trackDetails->artists as $songArtist)
                                @if ($songArtist->pivot->role === 'Composer')
                                    {{ $songArtist->artist_name }}
                                @endif
                            @endforeach
                        </p>
                        <p class="fw-semibold mb5 text-color-100 fs-14">Arranged By</p>
                        <p class="fw-medium text-color-80 fs-14 mb-0">
                            @foreach ($trackDetails->artists as $songArtist)
                                @if ($songArtist->pivot->role === 'Arranger')
                                    {{ $songArtist->artist_name }}
                                @endif
                            @endforeach
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-border" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
