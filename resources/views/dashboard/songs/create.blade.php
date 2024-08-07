@extends('dashboard.layouts.main')
@section('content')
    <section id="song-single-dashboard">
        <div class="row m-bottom-25 justify-content-center">
            <div class="col-md-8 col-12">
                <div class="form-container ">
                    <h4 class="fw-bold m-bottom-30 text-center text-color-100">Create Song Form</h4>
                    <form method="post" action="/dashboard/songs">
                        @csrf
                        <div class="m-bottom-15">
                            <label for="title" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                id="title" placeholder="Enter Song Title" value="{{ old('title') }}">
                            @error('title')
                                <div id="TitleFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="duration"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Duration</label>
                            <input type="number" class="form-control @error('duration') is-invalid @enderror" name="duration"
                                id="duration" placeholder="Ex: 185 (in seconds)" value="{{ old('duration') }}">
                            @error('duration')
                                <div id="durationFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="category" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Category</label>
                            <select class="form-select @error('category') is-invalid @enderror" aria-label="Select category" id="category" name="category">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->value }}"
                                        {{ old('category') == $category->value ? ' selected' : ' ' }}>
                                        {{ $category->value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <div id="categoryFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="track_number"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Track Number</label>
                            <input type="number" class="form-control @error('track_number') is-invalid @enderror" name="track_number"
                                id="track_number" placeholder="Enter Track Number" value="{{ old('track_number') }}">
                            @error('track_number')
                                <div id="trackNumberFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="album_id" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Album</label>
                            <select class="form-select @error('album_id') is-invalid @enderror" aria-label="Select Publisher" id="album_id" name="album_id">
                                @foreach ($albums as $album)
                                    <option value="{{ $album->id }}"
                                        {{ old('album_id') == $album->id ? ' selected' : ' ' }}>
                                        {{ $album->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('album_id')
                                <div id="albumFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="lyrics"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium @error('lyrics') is-invalid @enderror">Lyrics</label>
                            <textarea class="form-control" id="lyrics" rows="3" name="lyrics"
                                placeholder="Enter the Lyrics">{{ old('lyrics') }}</textarea>
                            @error('lyrics')
                                <div id="lyricsFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="button-grouping text-end">
                            <a href="/dashboard/songs" class="btn btn-light-border m-right-15">Cancel</a>
                            <button type="submit" class="btn btn-primary-color px-4">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
