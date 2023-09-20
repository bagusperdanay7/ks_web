@extends('layouts.main')

@section('content')
    <section id="all-artists">
        <div class="row">
            <div class="d-flex justify-content-between gallery-cards-head">
                <div>
                    <h2 class="fw-bold text-color-100 mb-0">Artists</h2>
                </div>
            </div>
            @forelse ($artists as $artist)
                <div class="col-6 col-md-4 col-lg-3 col-xl-2 {{ $loop->last ? '' : 'mb-15' }}">
                    <div class="artist-card">
                        <a href="/gallery/artists/{{ $artist->codename }}">
                            @if ($artist->artist_pict)
                                <img src="{{ asset('storage/' . $artist->artist_pict) }}"
                                    class="rounded artist-image img-fluid" alt="{{ $artist->artist_name }} picture">
                            @else
                                <img src="{{ asset('img/unknown_artist.jpg') }}" class="rounded artist-image img-fluid"
                                    alt="{{ $artist->artist_name }} picture">
                            @endif
                            <p>{{ $artist->artist_name }}</p>
                            <span>{{ $artist->projects->where('status', 'Completed')->where('is_exclusive', 'No')->count() }}
                                Videos</span>
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
@endsection
