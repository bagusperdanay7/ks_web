@extends('dashboard.layouts.main')
@section('content')
    <section id="idol-single-dashboard">
        <div class="row m-bottom-25 justify-content-center">
            <div class="col-md-8 col-12">
                <div class="form-container">
                    <h4 class="fw-bold m-bottom-30 text-color-100 text-center">Create Idol Form</h4>
                    <form method="post" action="{{ route('idols.store') }}">
                        @csrf
                        <div class="m-bottom-15">
                            <label for="artist_id"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Artist</label>
                            <select class="form-select @error('artist_id') is-invalid @enderror" aria-label="Select Artist"
                                id="artist_id" name="artist_id">
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
                        </div>
                        <div class="m-bottom-15">
                            <label for="stage_name" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Stage
                                Name</label>
                            <input type="text" class="form-control @error('stage_name') is-invalid @enderror"
                                name="stage_name" id="stage_name" placeholder="Yoona" value="{{ old('stage_name') }}">
                            @error('stage_name')
                                <div id="stageNameFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="birth_name" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Birth
                                Name</label>
                            <input type="text" class="form-control @error('birth_name') is-invalid @enderror"
                                name="birth_name" id="birth_name" value="{{ old('birth_name') }}"
                                placeholder="Im Yoon Ah">
                            @error('birth_name')
                                <div id="birthNameFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="button-grouping text-end">
                            <a href="{{ route('idols.index') }}" class="btn btn-light-border m-right-15">Cancel</a>
                            <button type="submit" class="btn btn-primary-color px-4">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
