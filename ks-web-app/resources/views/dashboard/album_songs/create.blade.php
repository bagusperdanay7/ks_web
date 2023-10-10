@extends('dashboard.layouts.main')
@section('content')
    <section id="album-single-dashboard">
        <div class="row m-bottom-25 justify-content-center">
            <div class="col-md-8 col-12">
                <div class="form-container ">
                    <h4 class="fw-bold m-bottom-30 text-center text-color-100">Create Album Songs Form</h4>
                    <form method="post" action="/dashboard/album-songs">
                        @csrf
                        <div class="m-bottom-15">
                            <label for="track_number" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Track
                                Number</label>
                            <input type="number" class="form-control @error('track_number') is-invalid @enderror"
                                name="track_number" id="track_number" value="{{ old('track_number') }}" min="1">
                            @error('track_number')
                                <div id="trackNumberFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="album_id"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Album</label>
                            <select class="form-select" aria-label="Select Album" id="album_id" name="album_id">
                                @foreach ($albums as $album)
                                    <option value="{{ $album->id }}"
                                        {{ old('album_id') == $album->id ? ' selected' : ' ' }}>
                                        {{ $album->album_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="m-bottom-15">
                            <label for="song_id" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Song</label>
                            <select class="form-select" aria-label="Select Song" id="artist" name="song_id">
                                @foreach ($songs as $song)
                                    <option value="{{ $song->id }}"
                                        {{ old('song_id') == $song->id ? ' selected' : ' ' }}>
                                        {{ $song->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="button-grouping text-end">
                            <a href="/dashboard/album-songs" class="btn btn-light-border m-right-15">Cancel</a>
                            <button type="submit" class="btn btn-primary-color px-4">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection