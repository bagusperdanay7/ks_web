@extends('layouts.main')

@section('content')
    <section id="request-form">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 col-xl-6">
                <div class="form-request-container">
                    <h3 class="text-center m-0 fw-bold text-color-100">Form Request</h3>
                    <div class="row justify-content-center align-items-center m-0">
                        <form action="{{ route('request-form-post') }}" method="post" class="mt-30 col-12 p-0">
                            @csrf
                            {{-- <div class="mb-15">
                                <label for="artist" class="form-label fs-18 fw-medium text-color-100">Artist</label>
                                <select class="form-select" aria-label="Select Artist" id="artist" name="artist_id">
                                    @foreach ($artists as $artist)
                                        <option value="{{ $artist->id }}"
                                            {{ old('artist_id') == $artist->id ? ' selected' : ' ' }}>
                                            {{ $artist->artist_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="mb-15">
                                <label for="category" class="form-label fs-18 fw-medium text-color-100">Category</label>
                                <select class="form-select" aria-label="Select Category" id="category" name="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? ' selected' : ' ' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-15">
                                <label for="title" class="form-label fs-18 fw-medium text-color-100">Project
                                    Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" aria-describedby="title_Help"
                                    placeholder="Ex: OH MY GIRL - Celebrate" value="{{ old('title') }}" required>
                                @error('title')
                                    <div id="title_Help" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-15">
                                <label for="requester" class="form-label fs-18 fw-medium text-color-100">Requester</label>
                                <input type="text" class="form-control @error('requester') is-invalid @enderror"
                                    id="requester" name="requester" aria-describedby="requesterHelp"
                                    placeholder="Your Name or Youtube Channel"
                                    @auth value="{{ auth()->user()->name }}" @endauth value="{{ old('requester') }}"
                                    required>
                                @error('requester')
                                    <div id="requesterHelp" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-30">
                                <label for="notes" class="form-label text-color-100 mb-10 fs-18 fw-medium">Notes</label>
                                <textarea class="form-control" id="notes" rows="3" name="notes"
                                    placeholder="Ex: Please, make nayeon as thumbnail, in More & More video">{{ old('notes') }}</textarea>
                            </div>
                            <div class="button-grouping text-end">
                                <a href="{{ route('request-list') }}"
                                    class="btn text-color-primary fw-semibold mr-10">Cancel</a>
                                <button type="submit" class="btn btn-main px-4">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const projectTitle = document.querySelector('#title');
        const artist = document.querySelector('#artist');

        artist.onchange = (e) => {
            e.preventDefault();
            const selectedValues = [].filter
                .call(artist.options, option => option.selected)
                .map(option => option.text);

            projectTitle.value = selectedValues + ' - ';
        };
    </script>
@endsection
