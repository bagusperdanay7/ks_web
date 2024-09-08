@extends('dashboard.layouts.main')
@section('content')
    <section id="song-artist-single-dashboard">
        <div class="row m-bottom-25 justify-content-center">
            <div class="col-md-8 col-12">
                <div class="form-container">
                    <h4 class="fw-bold m-bottom-30 text-color-100 text-center">Create Song Artist Form</h4>
                    <form method="post" action="{{ route('song-artist.store') }}">
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
                            <label for="artist_id"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Artist</label>
                            <select class="form-select" aria-label="Select Album" id="artist_id" name="artist_id">
                                @foreach ($artists as $artist)
                                    <option value="{{ $artist->id }}"
                                        {{ old('artist_id') == $artist->id ? ' selected' : ' ' }}>
                                        {{ $artist->artist_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="m-bottom-15">
                            <label for="role" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Role</label>
                            <select class="form-select @error('role') is-invalid @enderror" aria-label="Select Role"
                                id="role" name="role">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->value }}"
                                        {{ old('role') == $role->value ? ' selected' : ' ' }}>
                                        {{ $role->value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <div id="roleFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="button-grouping text-end">
                            <a href="{{ route('song-artist.index') }}" class="btn btn-light-border m-right-15">Cancel</a>
                            <button type="submit" class="btn btn-primary-color px-4">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
