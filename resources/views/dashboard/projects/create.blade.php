@extends('dashboard.layouts.main')
@section('content')
    <section id="project-single-dashboard">
        <div class="row m-bottom-25 justify-content-center">
            <div class="col-md-8 col-12">
                <div class="form-container">
                    <h4 class="fw-bold m-bottom-30 text-color-100 text-center">Create Project Form</h4>
                    <form method="post" action="{{ route('projects.store') }}">
                        @csrf
                        <div class="m-bottom-15">
                            <label for="category"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Category</label>
                            <select class="form-select @error('category_id') is-invalid @enderror"
                                aria-label="Select Category" id="category" name="category_id">
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
                            <label for="project_type_id"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Type</label>
                            <select class="form-select @error('project_type_id') is-invalid @enderror"
                                aria-label="Select Type" id="project_type_id" name="project_type_id">
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}"
                                        {{ old('project_type_id') == $type->id ? ' selected' : ' ' }}>
                                        {{ $type->type_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('project_type_id')
                                <div id="typeFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="title"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                id="title" placeholder="OH MY GIRL - Celebrate" value="{{ old('title') }}">
                            @error('title')
                                <div id="titleFeedback" class="invalid-feedback">
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
                        <div class="row m-bottom-15">
                            <div class="col">
                                <label for="status"
                                    class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Status</label>
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
                            <div class="col">
                                <label for="exclusive"
                                    class="form-label text-color-100 m-bottom-10 fs-18 fw-medium @error('exclusive') is-invalid @enderror">Exclusive</label>
                                <div class="form-check">
                                    <input class="form-check-input @error('exclusive') is-invalid @enderror" type="radio"
                                        name="exclusive" id="exclusiveTrue" value="1" @checked(old('exclusive') == 1)>
                                    <label class="form-check-label" for="exclusiveTrue">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input @error('exclusive') is-invalid @enderror" type="radio"
                                        name="exclusive" id="exclusiveFalse" value="0" @checked(old('exclusive') == 0)>
                                    <label class="form-check-label" for="exclusiveFalse">
                                        No
                                    </label>
                                    @error('exclusive')
                                        <div class="invalid-feedback" id="exclusiveFeedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="m-bottom-15">
                            <label for="youtube_id" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Youtube
                                Id</label>
                            <input type="text" class="form-control @error('youtube_id') is-invalid @enderror"
                                name="youtube_id" id="youtube_id" maxlength="191" value="{{ old('youtube_id') }}"
                                placeholder="https://www.youtube.com/embed/{VIDEO_ID}" data-bs-toggle="tooltip"
                                data-bs-placement="bottom"
                                data-bs-title="Press Alt+C on this Input to copy the example youtube_id">
                            @error('youtube_id')
                                <div id="youtube_idFeedback" class="invalid-feedback">
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
                            <label for="created_at" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Created
                                At</label>
                            <input type="datetime-local" class="form-control @error('created_at') is-invalid @enderror"
                                name="created_at" id="created_at" value="{{ old('created_at') }}">
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
                            <a href="{{ route('projects.index') }}" class="btn btn-light-border m-right-15">Cancel</a>
                            <button type="submit" class="btn btn-primary-color px-4">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        const title = document.querySelector('#title');
        const artist = document.querySelector('#artist');

        artist.onchange = (e) => {
            e.preventDefault();
            const selectedValues = [].filter
                .call(artist.options, option => option.selected)
                .map(option => option.text);

            title.value = selectedValues + ' - ';
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
