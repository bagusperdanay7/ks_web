@extends('dashboard.layouts.main')
@section('content')
    <section id="project-single-dashboard">
        <div class="row m-bottom-25 justify-content-center">
            <div class="col-md-8 col-12">
                <div class="form-container ">
                    <h4 class="fw-bold m-bottom-30 text-center">Create Project Form</h4>
                    <form method="post" action="/dashboard/projects">
                        @csrf
                        <div class="m-bottom-15">
                            <label for="artist" class="form-label m-bottom-10 fs-18 fw-medium">Artist</label>
                            <select class="form-select" aria-label="Select Artist" id="artist" name="artist_id">
                                @foreach ($artists as $artist)
                                    <option value="{{ $artist->id }}"
                                        {{ old('artist_id') == $artist->id ? ' selected' : ' ' }}>
                                        {{ $artist->artist_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="m-bottom-15">
                            <label for="category" class="form-label m-bottom-10 fs-18 fw-medium">Category</label>
                            <select class="form-select" aria-label="Select Category" id="category" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? ' selected' : ' ' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="m-bottom-15">
                            <label for="type" class="form-label m-bottom-10 fs-18 fw-medium">Type</label>
                            <select class="form-select" aria-label="Select Type" id="type" name="type_id">
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}"
                                        {{ old('type_id') == $type->id ? ' selected' : ' ' }}>
                                        {{ $type->type_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="m-bottom-15">
                            <label for="project_title" class="form-label m-bottom-10 fs-18 fw-medium">Project Title</label>
                            <input type="type" class="form-control @error('project_title') is-invalid @enderror"
                                name="project_title" id="project_title" placeholder="OH MY GIRL - Celebrate"
                                value="{{ old('project_title') }}">
                            @error('project_title')
                                <div id="projectTitleFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="requester" class="form-label m-bottom-10 fs-18 fw-medium">Requester</label>
                            <input type="type" class="form-control @error('requester') is-invalid @enderror"
                                name="requester" id="requester" value="{{ old('requester', auth()->user()->name) }}">
                            @error('requester')
                                <div id="requesterFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="date" class="form-label m-bottom-10 fs-18 fw-medium">Date</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" name="date"
                                id="date" value="{{ old('date') }}">
                            @error('date')
                                <div id="dateFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="status" class="form-label m-bottom-10 fs-18 fw-medium">Status</label>
                            <select class="form-select" aria-label="Select status" id="status" name="status">
                                @if (old('status') === 'Completed')
                                    <option value="{{ old('status') }}" selected>{{ old('status') }}</option>
                                    <option value="On Process">On Process</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Rejected">Rejected</option>
                                @elseif (old('status') === 'On Process')
                                    <option value="Completed">Completed</option>
                                    <option value="{{ old('status') }}" selected>{{ old('status') }}</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Rejected">Rejected</option>
                                @elseif (old('status') === 'Pending')
                                    <option value="Completed">Completed</option>
                                    <option value="On Process">On Process</option>
                                    <option value="{{ old('status') }}" selected>{{ old('status') }}</option>
                                    <option value="Rejected">Rejected</option>
                                @elseif (old('status') === 'Rejected')
                                    <option value="Completed">Completed</option>
                                    <option value="On Process">On Process</option>
                                    <option value="Pending">Pending</option>
                                    <option value="{{ old('status') }}" selected>{{ old('status') }}</option>
                                @else
                                    <option value="Completed">Completed</option>
                                    <option value="On Process">On Process</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Rejected">Rejected</option>
                                @endif
                            </select>
                        </div>
                        <div class="m-bottom-15">
                            <label for="url" class="form-label m-bottom-10 fs-18 fw-medium">Url</label>
                            <input type="url" class="form-control @error('url') is-invalid @enderror" name="url"
                                id="url" maxlength="191" value="{{ old('url') }}">
                            @error('url')
                                <div id="urlFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="thumbnail" class="form-label m-bottom-10 fs-18 fw-medium">Thumbnail</label>
                            <input type="text" class="form-control @error('thumbnail') is-invalid @enderror"
                                name="thumbnail" id="thumbnail" maxlength="191" value="{{ old('thumbnail') }}">
                            @error('thumbnail')
                                <div id="thumbnailFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row m-bottom-15">
                            <div class="col">
                                <label for="progress" class="form-label m-bottom-10 fs-18 fw-medium">Progress</label>
                                <input type="number" class="form-control @error('progress') is-invalid @enderror"
                                    name="progress" id="progress" min="0" max="100"
                                    value="{{ old('progress') }}">
                                @error('progress')
                                    <div id="progressFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="votes" class="form-label m-bottom-10 fs-18 fw-medium">Votes</label>
                                <input type="number" class="form-control @error('votes') is-invalid @enderror"
                                    name="votes" id="votes" min="1" value="{{ old('votes') }}">
                                @error('votes')
                                    <div id="votesFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="m-bottom-15">
                            <label for="created_at" class="form-label m-bottom-10 fs-18 fw-medium">Created At</label>
                            <input type="datetime-local" class="form-control" name="created_at" id="created_at"
                                value="{{ old('created_at') }}">
                        </div>
                        <div class="m-bottom-15">
                            <label for="notes" class="form-label m-bottom-10 fs-18 fw-medium">Notes</label>
                            <textarea class="form-control" id="notes" rows="3" name="notes"
                                placeholder="Ex: Please, make nayeon as thumbnail, in More & More video">{{ old('notes') }}</textarea>
                        </div>
                        <div class="button-grouping text-end">
                            <a href="/dashboard/projects" class="btn btn-light-border m-right-15">Cancel</a>
                            <button type="submit" class="btn btn-primary-color px-4">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        const projectTitle = document.querySelector('#project_title');
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
