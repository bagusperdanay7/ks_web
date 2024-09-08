@extends('dashboard.layouts.main')
@section('content')
    <section id="songGenreDashboard">
        <div class="row m-bottom-25 justify-content-center">
            <div class="col-md-8 col-12">
                <div class="form-container">
                    <h4 class="fw-bold m-bottom-30 text-color-100 text-center">Create Song Genre Form</h4>
                    <form method="post" action="{{ route('song-genre.store') }}">
                        @csrf
                        <div class="m-bottom-15">
                            <label for="song_id" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Song</label>
                            <select class="form-select" aria-label="Select Song" id="song_id" name="song_id">
                                @foreach ($songs as $song)
                                    <option value="{{ $song->id }}"
                                        {{ old('song_id') == $song->id ? ' selected' : ' ' }}>
                                        {{ $song->title }} · {{ $song->album->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="m-bottom-15">
                            <label for="genre_id"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Genre</label>
                            <select class="form-select" aria-label="Select Album" id="genre_id" name="genre_id">
                                @foreach ($genres as $genre)
                                    <option value="{{ $genre->id }}"
                                        {{ old('genre_id') == $genre->id ? ' selected' : ' ' }}>
                                        {{ $genre->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="button-grouping text-end">
                            <a href="{{ route('song-genre.index') }}" class="btn btn-light-border m-right-15">Cancel</a>
                            <button type="submit" class="btn btn-primary-color px-4">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
