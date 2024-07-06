@extends('dashboard.layouts.main')
@section('content')
    <section id="project-single-dashboard">
        <div class="row m-bottom-25 justify-content-center">
            <div class="col-md-8 col-12">
                <div class="form-container ">
                    <h4 class="fw-bold m-bottom-30 text-center text-color-100">Create Project Form</h4>
                    <form method="post" action="/dashboard/projects">
                        @csrf
                        <div class="m-bottom-15">
                            <label for="artist" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Artist</label>
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
                        </div>
                        <div class="m-bottom-15">
                            <label for="category"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Category</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" aria-label="Select Category" id="category" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? ' selected' : ' ' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div id="categoryFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="type" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Type</label>
                            <select class="form-select @error('type_id') is-invalid @enderror" aria-label="Select Type" id="type" name="type_id">
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}"
                                        {{ old('type_id') == $type->id ? ' selected' : ' ' }}>
                                        {{ $type->type_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type_id')
                                <div id="typeFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="project_title" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Project
                                Title</label>
                            <input type="text" class="form-control @error('project_title') is-invalid @enderror"
                                name="project_title" id="project_title" placeholder="OH MY GIRL - Celebrate"
                                value="{{ old('project_title') }}">
                            @error('project_title')
                                <div id="projectTitleFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="requester"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Requester</label>
                            <input type="text" class="form-control @error('requester') is-invalid @enderror"
                                name="requester" id="requester" value="{{ old('requester', auth()->user()->name) }}">
                            @error('requester')
                                <div id="requesterFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="date" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Date</label>
                            <input type="datetime-local" class="form-control @error('date') is-invalid @enderror"
                                name="date" id="date" value="{{ old('date') }}">
                            @error('date')
                                <div id="dateFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="status"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" aria-label="Select status" id="status" name="status">
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
                            @error('status')
                                <div id="statusFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="url" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Url</label>
                            <input type="url" class="form-control @error('url') is-invalid @enderror" name="url"
                                id="url" maxlength="191" value="{{ old('url') }}"
                                placeholder="https://www.youtube.com/embed/{VIDEO_ID}" data-bs-toggle="tooltip"
                                data-bs-placement="bottom"
                                data-bs-title="Press Alt+C on this Input to copy the example url">
                            @error('url')
                                <div id="urlFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="thumbnail"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Thumbnail</label>
                            <input type="text" class="form-control @error('thumbnail') is-invalid @enderror"
                                name="thumbnail" id="thumbnail" maxlength="191" value="{{ old('thumbnail') }}"
                                placeholder="https://i.ytimg.com/vi/{VIDEO_ID}/maxresdefault.jpg" data-bs-toggle="tooltip"
                                data-bs-placement="bottom"
                                data-bs-title="Press Alt+C on this Input to copy the example url">
                            @error('thumbnail')
                                <div id="thumbnailFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row m-bottom-15">
                            <div class="col">
                                <label for="progress"
                                    class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Progress</label>
                                <input type="number" class="form-control @error('progress') is-invalid @enderror"
                                    name="progress" id="progress" min="0" max="100"
                                    value="{{ old('progress') }}" placeholder="0-100">
                                @error('progress')
                                    <div id="progressFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="votes"
                                    class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Votes</label>
                                <input type="number" class="form-control @error('votes') is-invalid @enderror"
                                    name="votes" id="votes" min="1" value="{{ old('votes') }}"
                                    placeholder="Min. 1">
                                @error('votes')
                                    <div id="votesFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="m-bottom-15">
                            <label for="is_exclusive"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Exclusive Status</label>
                            <select class="form-select @error('is_exclusive') is-invalid @enderror" aria-label="Select Exclusive Status" id="is_exclusive"
                                name="is_exclusive">
                                @if (old('is_exclusive') === 'No')
                                    <option value="{{ old('is_exclusive') }}" selected>{{ old('is_exclusive') }}</option>
                                    <option value="Yes">Yes</option>
                                @elseif (old('is_exclusive') === 'Yes')
                                    <option value="No">No</option>
                                    <option value="{{ old('is_exclusive') }}" selected>{{ old('is_exclusive') }}</option>
                                @else
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>
                                @endif
                            </select>
                            @error('is_exclusive')
                                <div id="exclusiveFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="created_at" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium @error('created_at') is-invalid @enderror">Created
                                At</label>
                            <input type="datetime-local" class="form-control" name="created_at" id="created_at"
                                value="{{ old('created_at') }}">
                            @error('created_at')
                                <div id="createdAtFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="notes"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium @error('notes') is-invalid @enderror">Notes</label>
                            <textarea class="form-control" id="notes" rows="3" name="notes"
                                placeholder="Ex: Please, make nayeon as thumbnail, in More & More video">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div id="notesFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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

        const url = document.querySelector('#url');
        url.addEventListener("keydown", (event) => {
            if (event.altKey && event.keyCode == 67) {
                url.value = "https://www.youtube.com/embed/{VIDEO_ID}"
            }
        });

        const thumbnail = document.querySelector('#thumbnail');
        thumbnail.addEventListener("keydown", (event) => {
            if (event.altKey && event.keyCode == 67) {
                thumbnail.value = "https://i.ytimg.com/vi/{VIDEO_ID}/maxresdefault.jpg"
            }
        });
    </script>
@endsection
