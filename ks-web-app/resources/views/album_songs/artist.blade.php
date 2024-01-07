@extends('layouts.main')

@section('content')
    <section id="artist-detail" class="mb-50">
        <div class="row mb-6">
            <div class="col-12 col-md-6 col-lg-5 col-xl-4 mb-xl-0 mb-15">
                @if ($artist->artist_pict === null)
                    <img src="{{ asset('img/unknown_artist.jpg') }}" class="img-square rounded-10 shadow img-fluid"
                        alt="{{ $artist->artist_pict }} picture">
                @else
                    <img src="{{ asset('storage/' . $artist->artist_pict) }}" class="img-square rounded-10 shadow img-fluid"
                        alt="{{ $artist->artist_pict }} picture">
                @endif

            </div>
            <div class="col-12 col-md-6 col-lg-7 col-xl-8 align-self-center">
                <h2 class="fw-bold text-color-100 mb-10 fs-sm-24">{{ $artist->artist_name }}</h2>
                <p class="artist-about">{{ $artist->about }}</p>
                <div class="row mb-10">
                    <div class="col-5 col-lg-4 col-xl-3 col-xxl-2">
                        <h4 class="fs-16 fw-medium text-color-100 m-0 fs-lg-14">Debut</h4>
                    </div>
                    <div class="col">
                        <p class="m-0 text-color-100 fs-lg-14">{{ \Carbon\Carbon::parse($artist->debut)->format('d F Y') }}
                        </p>
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-5 col-lg-4 col-xl-3 col-xxl-2">
                        <h4 class="fs-16 fw-medium text-color-100 m-0 fs-lg-14">Fandom Name</h4>
                    </div>
                    <div class="col">
                        <p class="m-0 text-color-100 fs-lg-14">{{ $artist->fandom }}</p>
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-5 col-lg-4 col-xl-3 col-xxl-2">
                        <h4 class="fs-16 fw-medium text-color-100 m-0 fs-lg-14">Origin</h4>
                    </div>
                    <div class="col">
                        <p class="m-0 text-color-100 fs-lg-14">{{ $artist->origin }}</p>
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-5 col-lg-4 col-xl-3 col-xxl-2">
                        <h4 class="fs-16 fw-medium text-color-100 m-0 fs-lg-14">Company</h4>
                    </div>
                    <div class="col">
                        <p class="m-0 text-color-100 fs-lg-14">{{ $artist->company }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="album-artist">
        <div class="row">
            <h3 class="fw-semibold text-color-100 mb-10">Albums</h3>
            @forelse ($albumsArtist as $itemAlbum)
                <div
                    class="col-6 col-md-4 col-lg-3 col-xl-2 mb-xl-0 {{ $loop->last || $loop->iteration == 5 ? '' : 'mb-3' }}">
                    <div class="album-card">
                        <a href="/albums/{{ $itemAlbum->id ?? '' }}" class="text-decoration-none">
                            @if ($itemAlbum->cover)
                                <img src="{{ asset('storage/' . $itemAlbum->cover ?? '') }}"
                                    class="rounded artist-image img-fluid" alt="{{ $itemAlbum->album_name }}">
                            @else
                                <img src="{{ asset('img/unknown_artist.jpg') }}" class="rounded artist-image img-fluid"
                                    alt="{{ $itemAlbum->album_name ?? '' }}">
                            @endif
                            <p class="text-truncate-2-line text-truncate" title="{{ $itemAlbum->album_name }}">{{ $itemAlbum->album_name ?? '' }}</p>
                            <span>{{ \Carbon\Carbon::create($itemAlbum->release)->format('Y') }} • {{ $itemAlbum->type }}</span>
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
@endsection
