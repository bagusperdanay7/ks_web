@extends('dashboard.layouts.main')
@section('content')
    <section id="song-single-dashboard">
        <div class="row m-bottom-25 justify-content-center">
            <div class="col-md-8 col-12">
                <div class="form-container ">
                    <h4 class="fw-bold m-bottom-30 text-center text-color-100">Update Song Form</h4>
                    <form method="post" action="/dashboard/songs/{{ $song->id }}">
                        @method('put')
                        @csrf
                        <div class="m-bottom-15">
                            <label for="title" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                id="title" placeholder="Enter Title Song" value="{{ old('title', $song->title) }}">
                            @error('title')
                                <div id="TitleFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="genre"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Genre</label>
                            <input type="text" class="form-control @error('genre') is-invalid @enderror" name="genre"
                                id="genre" placeholder="K-Pop, Dance, Rock" value="{{ old('genre', $song->genre) }}">
                            @error('genre')
                                <div id="genreFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="category"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Category</label>
                            <select class="form-select" aria-label="Select Category" id="category" name="category">
                                @if (old('category', $song->category) === 'Track')
                                    <option value="{{ old('category') }}" selected>{{ old('category', $song->category) }}
                                    </option>
                                    <option value="Title Track">Title Track</option>
                                @elseif (old('category', $song->category) === 'Title Track')
                                    <option value="Track">Track</option>
                                    <option value="{{ old('category', $song->category) }}" selected>
                                        {{ old('category', $song->category) }}</option>
                                @else
                                    <option value="Track">Track</option>
                                    <option value="Title Track">Title Track</option>
                                @endif
                            </select>
                        </div>
                        <div class="m-bottom-15">
                            <label for="author"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Author</label>
                            <input type="text" class="form-control @error('author') is-invalid @enderror" name="author"
                                id="author" value="{{ old('author', $song->author) }}"
                                placeholder="Ex: Soyeon ((G)I-DLE))">
                            @error('author')
                                <div id="authorFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="composer"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Composer</label>
                            <input type="text" class="form-control @error('composer') is-invalid @enderror"
                                name="composer" id="composer" value="{{ old('composer', $song->composer) }}"
                                placeholder="Enter the Composer">
                            @error('composer')
                                <div id="composerFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="arranger"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Arranger</label>
                            <input type="text" class="form-control @error('arranger') is-invalid @enderror"
                                name="arranger" id="arranger" value="{{ old('arranger', $song->arranger) }}"
                                placeholder="Enter the arranger">
                            @error('arranger')
                                <div id="arrangerFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="button-grouping text-end">
                            <a href="/dashboard/songs" class="btn btn-light-border m-right-15">Cancel</a>
                            <button type="submit" class="btn btn-primary-color px-4">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
