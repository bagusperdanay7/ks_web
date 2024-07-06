@extends('dashboard.layouts.main')
@section('content')
    <section id="album-single-dashboard">
        <div class="row m-bottom-25 justify-content-center">
            <div class="col-md-8 col-12">
                <div class="form-container ">
                    <h4 class="fw-bold m-bottom-30 text-center text-color-100">Update Album Songs Form</h4>
                    <form method="post" action="/dashboard/album-songs/{{ $albumSong->id }}">
                        @method('put')
                        @csrf
                        <div class="m-bottom-15">
                            <label for="track_number" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Track
                                Number</label>
                            <input type="number" class="form-control @error('track_number') is-invalid @enderror"
                                name="track_number" id="track_number"
                                value="{{ old('track_number', $albumSong->track_number) }}" min="1">
                            @error('track_number')
                                <div id="trackNumberFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="album_id"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Album</label>
                            <select class="form-select @error('album_id') is-invalid @enderror" aria-label="Select Album" id="album_id" name="album_id">
                                @foreach ($albums as $album)
                                    <option value="{{ $album->id }}"
                                        {{ old('album_id', $albumSong->album_id) == $album->id ? ' selected' : ' ' }}>
                                        {{ $album->album_name }} · {{ $album->artist->artist_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('album_id')
                            <div id="albumIdFeedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="song_id" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Song</label>
                            <select class="form-select @error('song_id') is-invalid @enderror" aria-label="Select Song" id="artist" name="song_id">
                                @foreach ($songs as $song)
                                    <option value="{{ $song->id }}"
                                        {{ old('song_id', $albumSong->song_id) == $song->id ? ' selected' : ' ' }}>
                                        {{ $song->title }} · Written by {{ $song->author }}
                                    </option>
                                @endforeach
                            </select>
                            @error('song_id')
                            <div id="songIdFeedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="category"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Category</label>
                            <select class="form-select @error('category') is-invalid @enderror" aria-label="Select Category" id="category" name="category">
                                @if (old('category', $albumSong->category) === 'Track')
                                    <option value="">Select Category</option>
                                    <option value="{{ old('category', $albumSong->category) }}" selected>
                                        {{ old('category', $albumSong->category) }}
                                    </option>
                                    <option value="Title Track">Title Track</option>
                                @elseif (old('category', $albumSong->category) === 'Title Track')
                                    <option value="">Select Category</option>
                                    <option value="Track">Track</option>
                                    <option value="{{ old('category', $albumSong->category) }}" selected>
                                        {{ old('category', $albumSong->category) }}</option>
                                @else
                                    <option value="">Select Category</option>
                                    <option value="Track">Track</option>
                                    <option value="Title Track">Title Track</option>
                                @endif
                            </select>
                            @error('category')
                            <div id="categoryFeedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
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
