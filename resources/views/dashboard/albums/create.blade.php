@extends('dashboard.layouts.main')
@section('content')
    <section id="album-single-dashboard">
        <div class="row m-bottom-25 justify-content-center">
            <div class="col-md-8 col-12">
                <div class="form-container ">
                    <h4 class="fw-bold m-bottom-30 text-center text-color-100">Create Album Form</h4>
                    <form method="post" action="/dashboard/albums" enctype="multipart/form-data">
                        @csrf
                        {{-- <div class="m-bottom-15">
                            <label for="artist"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Artist</label>
                            <select class="form-select @error('artist_id') is-invalid @enderror" aria-label="Select Artist" id="artist" name="artist_id">
                                @foreach ($artists as $artist)
                                    <option value="{{ $artist->id }}"
                                        {{ old('artist_id') == $artist->id ? ' selected' : ' ' }}>
                                        {{ $artist->artist_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('artist_id')
                                <div id="artistFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div> --}}
                        <div class="m-bottom-15">
                            <label for="name" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" id="name" placeholder="Ex: Neverland"
                                value="{{ old('name') }}">
                            @error('name')
                                <div id="nameFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="type" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Type</label>
                            <select class="form-select @error('type') is-invalid @enderror" aria-label="Select Type" id="type" name="type">
                                @foreach ($types as $type)
                                    <option value="{{ $type->value }}"
                                        {{ old('type') == $type->value ? ' selected' : ' ' }}>
                                        {{ $type->value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type')
                                <div id="typeFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="release"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Release</label>
                            <input type="date" class="form-control @error('release') is-invalid @enderror" name="release"
                                id="release" value="{{ old('release') }}">
                            @error('release')
                                <div id="releaseFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="cover" class="form-label text-color-100">Cover</label>
                            <input class="form-control @error('cover') is-invalid @enderror" type="file" id="cover"
                                accept="image/*" name="cover" onchange="previewPicture()">
                            @error('cover')
                                <div id="artistPictFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <p class="fs-14 fw-medium m-top-15 mb-0 d-none" id="previewImageText">Cover Preview:</p>
                            <img class="img-square rounded-all-5 preview-pict img-fluid m-top-5 d-none">
                        </div>
                        <div class="m-bottom-15">
                            <label for="publisher_id" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Publisher</label>
                            <select class="form-select @error('publisher_id') is-invalid @enderror" aria-label="Select Publisher" id="publisher_id" name="publisher_id">
                                @foreach ($publishers as $publisher)
                                    <option value="{{ $publisher->id }}"
                                        {{ old('publisher_id') == $publisher->id ? ' selected' : ' ' }}>
                                        {{ $publisher->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('publisher_id')
                                <div id="publisherFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="button-grouping text-end">
                            <a href="/dashboard/albums" class="btn btn-light-border m-right-15">Cancel</a>
                            <button type="submit" class="btn btn-primary-color px-4">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        function previewPicture() {
            const albumCover = document.querySelector('#cover');
            const picturePreview = document.querySelector('.preview-pict');
            const previewImageText = document.querySelector('#previewImageText');

            picturePreview.classList.remove("d-none");
            previewImageText.classList.remove("d-none");

            const blob = URL.createObjectURL(albumCover.files[0]);
            picturePreview.src = blob;
        }
    </script>
@endsection
