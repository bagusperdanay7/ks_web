@extends('layouts.main')

@section('content')
    <section id="album-detail" class="mb-50">
        <div class="row mb-6">
            <div class="col-12 col-md-6 col-lg-5 col-xl-4 mb-xl-0 mb-15">
                @if ($album->cover === null)
                    <img src="{{ asset('img/unknown_album.jpg') }}" class="img-square rounded-10 shadow img-fluid"
                        alt="{{ $album->cover }} picture">
                @else
                    <img src="{{ asset('storage/' . $album->cover) }}" class="img-square rounded-10 shadow img-fluid"
                        alt="{{ $album->cover }} picture">
                @endif

            </div>
            <div class="col-12 col-md-6 col-lg-7 col-xl-8 align-self-center">
                <span class="text-color-80 fw-medium fs-14">{{ $album->type }}</span>
                <h3 class="fw-bold text-color-100 mb-10">{{ $album->album_name }}</h3>
                <h4 class="fw-semibold mb-15"><a href="/artists/{{ $album->artist->codename }}"
                        class="text-underline-hover text-color-primary">{{ $album->artist->artist_name }}</a></h4>
                <div class="row mb-10">
                    <div class="col-5 col-lg-4 col-xl-3 col-xxl-2">
                        <h4 class="fs-16 fw-medium text-color-100 m-0 fs-lg-14">Release</h4>
                    </div>
                    <div class="col">
                        <p class="m-0 text-color-100 fs-lg-14">{{ \Carbon\Carbon::parse($album->release)->format('d F Y') }}
                        </p>
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-5 col-lg-4 col-xl-3 col-xxl-2">
                        <h4 class="fs-16 fw-medium text-color-100 m-0 fs-lg-14">Publisher</h4>
                    </div>
                    <div class="col">
                        <p class="m-0 text-color-100 fs-lg-14">℗ {{ $album->publisher }}</p>
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-5 col-lg-4 col-xl-3 col-xxl-2">
                        <h4 class="fs-16 fw-medium text-color-100 m-0 fs-lg-14">Company</h4>
                    </div>
                    <div class="col">
                        <p class="m-0 text-color-100 fs-lg-14">{{ $album->artist->company }}</p>
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-5 col-lg-4 col-xl-3 col-xxl-2">
                        <h4 class="fs-16 fw-medium text-color-100 m-0 fs-lg-14">Tracks</h4>
                    </div>
                    <div class="col">
                        <p class="m-0 text-color-100 fs-lg-14">{{ $album->songs->count() }}</p>
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
            <div class="col-8 col-md-10 text-color-100 fw-medium">
                Title
            </div>
            <div class="col-2 col-md-1 text-color-100 fw-medium">
            </div>
        </div>
        @forelse ($songs as $song)
            @foreach ($song->songs as $track)
                <div class="row mt-4">
                    <div class="col-2 col-md-1 text-color-100 fs-14">{{ $track->pivot->track_number }}</div>
                    @if ($track->pivot->category === 'Title Track')
                        <div class="col-8 col-md-10 text-color-100 fs-14"><i class="las la-star"
                                title="{{ $track->pivot->category }}"></i> {{ $track->title }}</div>
                    @else
                        <div class="col-8 col-md-10 text-color-100 fs-14">{{ $track->title }}</div>
                    @endif
                    <div class="col-2 col-md-1 text-color-100 fs-14 text-end">
                        <button class="border-0 bg-transparent text-color-100" data-bs-toggle="modal"
                            data-bs-target="#songInfoModal{{ $track->id }}" type="button" role="button"><i
                                class="las la-info-circle fs-18" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Show Song Details"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        @empty
            <div class="row">
                <div class="col">
                    <div class="text-color-100 text-center">
                        <i class="las la-compact-disc fs-1"></i>
                        <p class="mb-0 mt-1 fw-medium fs-14">No Song Found!</p>
                    </div>
                </div>
            </div>
        @endforelse
    </section>

    @foreach ($songs as $songInfoModal)
        @foreach ($songInfoModal->songs as $trackDetails)
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
                            <p class="fw-medium mb-15 text-color-80 fs-14">{{ $trackDetails->genre }}</p>
                            <p class="fw-semibold mb5 text-color-100 fs-14">Written By</p>
                            <p class="fw-medium mb-15 text-color-80 fs-14">{{ $trackDetails->author }}</p>
                            <p class="fw-semibold mb5 text-color-100 fs-14">Composed By</p>
                            <p class="fw-medium mb-15 text-color-80 fs-14">{{ $trackDetails->composer }}</p>
                            <p class="fw-semibold mb5 text-color-100 fs-14">Arranged By</p>
                            <p class="fw-medium mb-0 text-color-80 fs-14">{{ $trackDetails->composer }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-border" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
@endsection
