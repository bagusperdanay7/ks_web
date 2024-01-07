@extends('dashboard.layouts.main')

@section('content')
    <section id="ai-model-single-dashboard">
        <div class="row m-bottom-25 justify-content-center">
            <div class="col-md-8 col-12">
                <div class="form-container ">
                    <h4 class="fw-bold m-bottom-30 text-center text-color-100">Create AI Model Form</h4>
                    <form method="post" action="/dashboard/ai-models" enctype="multipart/form-data">
                        @csrf
                        <div class="m-bottom-15">
                            <label for="model_name" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Model
                                Name</label>
                            <input type="text" class="form-control @error('model_name') is-invalid @enderror"
                                name="model_name" id="model_name" placeholder="Jessica Jung (Ex Girls' Generation)"
                                value="{{ old('model_name') }}">
                            @error('model_name')
                                <div id="modelNameFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="cover_model" class="form-label text-color-100  m-bottom-10 fs-18 fw-medium">Cover
                                Model</label>
                            <input class="form-control @error('cover_model') is-invalid @enderror" type="file"
                                id="cover_model" accept="image/*" name="cover_model" onchange="previewPicture()">
                            @error('cover_model')
                                <div id="modelCoverFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <p class="fs-14 fw-medium m-top-15 mb-0 d-none" id="previewImageText">Picture Preview:</p>
                            <img class="img-square rounded-circle preview-pict img-fluid m-top-5 d-none">
                        </div>
                        <div class="m-bottom-15">
                            <label for="url" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Url</label>
                            <input type="url" class="form-control @error('url') is-invalid @enderror" name="url"
                                id="url" value="{{ old('url') }}" placeholder="Copy Mega or Hugging face Link">
                            @error('url')
                                <div id="urlFeedback" class="invalid-feedback">
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
                            <label for="description"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3" name="description"
                                placeholder="Enter the model description">{{ old('description') }}</textarea>
                            @error('description')
                                <div id="descriptionFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="sample"
                                class="form-label text-color-100  m-bottom-10 fs-18 fw-medium">Sample</label>
                            <input class="form-control @error('sample') is-invalid @enderror" type="file" id="sample"
                                accept="audio/*" name="sample" onchange="previewAudio()">
                            @error('sample')
                                <div id="sampleFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <p class="fs-14 fw-medium m-top-15 mb-0 d-none" id="previewAudio">Audio Preview:</p>
                            <audio id="audio" class="col-12 m-top-10 preview-audio d-none" controls>
                            </audio>
                        </div>
                        <div class="button-grouping text-end">
                            <a href="/dashboard/ai-models" class="btn btn-light-border m-right-15">Cancel</a>
                            <button type="submit" class="btn btn-primary-color px-4">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        function previewPicture() {
            const modelCover = document.querySelector('#cover_model');
            const picturePreview = document.querySelector('.preview-pict');
            const previewImageText = document.querySelector('#previewImageText');

            picturePreview.classList.remove("d-none");
            previewImageText.classList.remove("d-none");

            const blob = URL.createObjectURL(modelCover.files[0]);
            picturePreview.src = blob;
        }

        function previewAudio() {
            const sample = document.querySelector('#sample');
            const previewAudio = document.querySelector('.preview-audio');
            const previewAudioText = document.querySelector('#previewAudio');

            previewAudio.classList.remove("d-none");
            previewAudioText.classList.remove("d-none");

            const blob = URL.createObjectURL(sample.files[0]);
            previewAudio.src = blob;
        }
    </script>
@endsection
