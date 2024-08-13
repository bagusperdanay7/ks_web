@extends('dashboard.layouts.main')
@section('content')
    <section id="projectArtistDashboard">
        <div class="row m-bottom-25 justify-content-center">
            <div class="col-md-8 col-12">
                <div class="form-container">
                    <h4 class="fw-bold m-bottom-30 text-color-100 text-center">Create Project Artist Form</h4>
                    <form method="post" action="{{ route('project-artist.store') }}">
                        @csrf
                        <div class="m-bottom-15">
                            <label for="project_id" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Project</label>
                            <select class="form-select" aria-label="Select Project" id="project_id" name="project_id">
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}"
                                        {{ old('project_id') == $project->id ? ' selected' : ' ' }}>
                                        {{ $project->title }}
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
                        <div class="button-grouping text-end">
                            <a href="{{ route('project-artist.index') }}" class="btn btn-light-border m-right-15">Cancel</a>
                            <button type="submit" class="btn btn-primary-color px-4">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
