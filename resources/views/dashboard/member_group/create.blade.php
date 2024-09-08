@extends('dashboard.layouts.main')
@section('content')
    <section id="album-single-dashboard">
        <div class="row m-bottom-25 justify-content-center">
            <div class="col-md-8 col-12">
                <div class="form-container">
                    <h4 class="fw-bold m-bottom-30 text-color-100 text-center">Create Member Group Form</h4>
                    <form method="post" action="{{ route('member-group.store') }}">
                        @csrf
                        <div class="m-bottom-15">
                            <label for="idol_id" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Idol</label>
                            <select class="form-select" aria-label="Select Idol" id="idol_id" name="idol_id">
                                @foreach ($idols as $idol)
                                    <option value="{{ $idol->id }}"
                                        {{ old('idol_id') == $idol->id ? ' selected' : ' ' }}>
                                        {{ $idol->stage_name }} • {{ $idol->birth_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="m-bottom-15">
                            <label for="artist_id"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Group</label>
                            <select class="form-select" aria-label="Select Album" id="artist_id" name="artist_id">
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}"
                                        {{ old('artist_id') == $group->id ? ' selected' : ' ' }}>
                                        {{ $group->artist_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="m-bottom-15">
                            <label for="status" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" aria-label="Select Status"
                                id="status" name="status">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->value }}"
                                        {{ old('status') == $status->value ? ' selected' : ' ' }}>
                                        {{ $status->value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <div id="statusFeedback" class="invalid-feedback">
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
