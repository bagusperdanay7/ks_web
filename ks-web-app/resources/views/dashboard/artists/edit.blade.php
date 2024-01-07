@extends('dashboard.layouts.main')
@section('content')
    <section id="artist-single-dashboard">
        <div class="row m-bottom-25 justify-content-center">
            <div class="col-md-8 col-12">
                <div class="form-container ">
                    <h4 class="fw-bold m-bottom-30 text-center text-color-100">Update Artist Form</h4>
                    <form method="post" action="/dashboard/artists/{{ $artist->codename }}" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="m-bottom-15">
                            <label for="artist_name" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Artist
                                Name</label>
                            <input type="text" class="form-control @error('artist_name') is-invalid @enderror"
                                name="artist_name" id="artist_name" placeholder="OH MY GIRL"
                                value="{{ old('artist_name', $artist->artist_name) }}">
                            @error('artist_name')
                                <div id="artistTitleFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="codename" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Code
                                Name</label>
                            <input type="text" class="form-control @error('codename') is-invalid @enderror"
                                name="codename" id="codename" value="{{ old('codename', $artist->codename) }}"
                                aria-label="Codename input Readonly" readonly>
                            @error('codename')
                                <div id="codenameFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="debut"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Debut</label>
                            <input type="date" class="form-control @error('debut') is-invalid @enderror" name="debut"
                                id="debut" value="{{ old('debut', $artist->debut) }}">
                            @error('debut')
                                <div id="debutFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="origin"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Origin</label>
                            <input type="text" class="form-control @error('origin') is-invalid @enderror" name="origin"
                                id="origin" value="{{ old('origin', $artist->origin) }}">
                            @error('origin')
                                <div id="originFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="artist_pict" class="form-label text-color-100">Artist Picture</label>
                            <input class="form-control @error('artist_pict') is-invalid @enderror" type="file"
                                id="artist_pict" accept="image/*" name="artist_pict" onchange="previewPicture()">
                            @error('artist_pict')
                                <div id="artistPictFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            @if ($artist->artist_pict)
                                <p class="fs-14 fw-medium m-top-15 mb-0" id="previewImageText">Picture Preview:</p>
                                <img class="img-square rounded-all-5 img-fluid preview-pict m-top-5"
                                    src="{{ asset('storage/' . $artist->artist_pict) }}">
                            @else
                                <p class="fs-14 fw-medium m-top-15 mb-0 d-none" id="previewImageText">Picture Preview :</p>
                                <img class="img-square rounded-all-5 img-fluid preview-pict m-top-5 d-none">
                            @endif
                        </div>
                        <div class="m-bottom-15">
                            <label for="fandom"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Fandom</label>
                            <input type="text" class="form-control @error('fandom') is-invalid @enderror" name="fandom"
                                id="fandom" value="{{ old('fandom', $artist->fandom) }}">
                            @error('fandom')
                                <div id="fandomFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="company"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Company</label>
                            <input type="text" class="form-control @error('company') is-invalid @enderror" name="company"
                                id="company" value="{{ old('company', $artist->company) }}">
                            @error('company')
                                <div id="companyFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="about"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">About</label>
                            <textarea class="form-control @error('about') is-invalid @enderror"
                                id="about" rows="3" name="about" placeholder="Enter the group about">{{ old('about', $artist->about) }}</textarea>
                            @error('about')
                                <div id="aboutFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="button-grouping text-end">
                            <a href="/dashboard/artists" class="btn btn-light-border m-right-15">Cancel</a>
                            <button type="submit" class="btn btn-primary-color px-4">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        const artistName = document.querySelector('#artist_name');
        const codeName = document.querySelector('#codename');

        artistName.onchange = (e) => {
            e.preventDefault();
            let selectedValues = artistName.value
            selectedValues = selectedValues.replaceAll(/[&\/\\#,+()$~%.'":*?<>{}]/g, '');
            selectedValues = selectedValues.replaceAll(' ', '-');
            selectedValues = selectedValues.toLowerCase();

            codeName.value = selectedValues;
        };

        function previewPicture() {
            const artistPicture = document.querySelector('#artist_pict');
            const picturePreview = document.querySelector('.preview-pict');
            const previewImageText = document.querySelector('#previewImageText');

            picturePreview.classList.remove("d-none");
            previewImageText.classList.remove("d-none");

            const blob = URL.createObjectURL(artistPicture.files[0]);
            picturePreview.src = blob;
        }
    </script>
@endsection
