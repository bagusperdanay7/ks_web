@extends('dashboard.layouts.main')
@section('content')
    <section id="playlist-project-single-dashboard">
        <div class="row m-bottom-25 justify-content-center">
            <div class="col-md-8 col-12">
                <div class="form-container">
                    <h4 class="fw-bold m-bottom-30 text-color-100 text-center">Create Playlist Project Form</h4>
                    <form method="post" action="{{ route('playlist-project.store') }}">
                        @csrf
                        <div class="m-bottom-15">
                            <label for="playlist_id" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Playlist</label>
                            <select class="form-select" aria-label="Select Playlist" id="playlist_id" name="playlist_id">
                                @foreach ($playlists as $playlist)
                                    <option value="{{ $playlist->id }}"
                                        {{ old('playlist_id') == $playlist->id ? ' selected' : ' ' }}>
                                        {{ $playlist->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="m-bottom-15">
                            <label for="project_id"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Project</label>
                            <select class="form-select" aria-label="Select Project" id="project_id" name="project_id">
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}"
                                        {{ old('project_id') == $project->id ? ' selected' : ' ' }}>
                                        {{ $project->title }} · {{ $project->category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="m-bottom-15">
                            <label for="order"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Order</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror" name="order"
                                id="order" placeholder="Enter Order" value="{{ old('order') }}">
                            @error('order')
                                <div id="orderFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="main_video" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Main Video</label>
                            <select class="form-select @error('main_video') is-invalid @enderror" aria-label="Select Main Video"
                                id="main_video" name="main_video">
                                <option value="0"
                                    {{ old('main_video') == 0 ? ' selected' : ' ' }}>
                                    False
                                </option>
                                <option value="1"
                                    {{ old('main_video') == 1 ? ' selected' : ' ' }}>
                                    True
                                </option>
                            </select>
                            @error('main_video')
                                <div id="mainVideoFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="button-grouping text-end">
                            <a href="{{ route('playlist-project.index') }}" class="btn btn-light-border m-right-15">Cancel</a>
                            <button type="submit" class="btn btn-primary-color px-4">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
