@extends('dashboard.layouts.main')
@section('content')
    <section id="ai-model-single-dashboard">
        <div class="row m-bottom-25 justify-content-center">
            <div class="col-md-8 col-12">
                <div class="form-container ">
                    <h4 class="fw-bold m-bottom-30 text-center text-color-100">Update AI Model Form</h4>
                    <form method="post" action="{{ route('ai-models.update', $aiModel->id)}}" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="m-bottom-15">
                            <label for="model_name" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Model
                                Name</label>
                            <input type="text" class="form-control @error('model_name') is-invalid @enderror"
                                name="model_name" id="model_name" placeholder="Jessica Jung (Ex Girls' Generation)"
                                value="{{ old('model_name', $aiModel->model_name) }}">
                            @error('model_name')
                                <div id="modelNameFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="artist" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Artist</label>
                            <select class="form-select @error('artist_id') is-invalid @enderror" aria-label="Select Artist"
                                id="artist" name="artist_id">
                                @foreach ($artists as $artist)
                                    <option value="{{ $artist->id }}"
                                        {{ old('artist_id', $aiModel->artist_id) == $artist->id ? ' selected' : ' ' }}>
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
                            <label for="url" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Url</label>
                            <input type="url" class="form-control @error('url') is-invalid @enderror" name="url"
                                id="url" value="{{ old('url', $aiModel->url) }}"
                                placeholder="Copy Mega or Hugging face Link">
                            @error('url')
                                <div id="urlFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="status" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" aria-label="Select Status" id="status" name="status">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->value }}"
                                        {{ old('status', $aiModel->status) == $status->value ? ' selected' : ' ' }}>
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
                        <div class="m-bottom-15">
                            <label for="description"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3"
                                name="description" placeholder="Enter the model description">{{ old('description', $aiModel->description) }}</textarea>
                            @error('description')
                                <div id="descriptionFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="audio_sample"
                                class="form-label text-color-100  m-bottom-10 fs-18 fw-medium">Audio Sample</label>
                            <input class="form-control @error('audio_sample') is-invalid @enderror" type="file" id="audio_sample"
                                accept="audio/*" name="audio_sample" onchange="previewAudio()">
                            <div class="form-text text-color-80 fw-semibold fs-14" id="maxSizeInfoAudio">Max Size: 5 MB.</div>
                            @error('audio_sample')
                                <div id="audioSampleFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            @if ($aiModel->audio_sample)
                                <p class="fs-14 fw-medium m-top-15 mb-0" id="previewAudio">Audio Preview:</p>
                                <audio id="audio" class="col-12 m-top-10 preview-audio"
                                    src="{{ asset('storage/' . $aiModel->audio_sample) }}" controls>
                                </audio>
                            @else
                                <p class="fs-14 fw-medium m-top-15 mb-0 d-none" id="previewAudio">Audio Preview:</p>
                                <audio id="audio" class="col-12 m-top-10 preview-audio d-none"controls>
                                </audio>
                            @endif
                        </div>
                        <div class="button-grouping text-end">
                            <a href="{{ route('ai-models.index') }}" class="btn btn-light-border m-right-15">Cancel</a>
                            <button type="submit" class="btn btn-primary-color px-4">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        function previewAudio() {
            const audioSample = document.querySelector('#audio_sample');
            const previewAudio = document.querySelector('.preview-audio');
            const previewAudioText = document.querySelector('#previewAudio');

            previewAudio.classList.remove("d-none");
            previewAudioText.classList.remove("d-none");

            const blob = URL.createObjectURL(audioSample.files[0]);
            previewAudio.src = blob;
        }
    </script>
@endsection
