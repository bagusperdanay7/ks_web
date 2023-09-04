@extends('layouts.main')

@section('content')
    <div class="row gallery-section mb-4">
        <div class="d-flex justify-content-between gallery-cards-head">
            <div>
                <h2>All Artist</h2>
            </div>
        </div>
        @foreach ($artists as $artist)
            <div class="col-2 artist-card mb-4">
                <a href="/gallery/artists/{{ $artist->codename }}">
                    @if ($artist->artist_pict)
                        <img src="{{ asset('storage/' . $artist->artist_pict) }}" class="rounded artist-image" width="195px"
                            height="195px" alt="{{ $artist->artist_name }}">
                    @else
                        <img src="{{ asset('img/unknown_artist.jpg') }}" class="rounded artist-image" width="195px"
                            height="195px" alt="{{ $artist->artist_name }}">
                    @endif
                    <p>{{ $artist->artist_name }}</p>
                    <span>{{ $artist->projects->count() }} Videos</span>
                </a>
            </div>
        @endforeach
    </div>
@endsection
