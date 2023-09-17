@extends('dashboard.layouts.main')
@section('content')
    <section id="type-single-dashboard">
        <div class="row m-bottom-25 justify-content-center">
            <div class="col-md-8 col-12">
                <div class="form-container ">
                    <h4 class="fw-bold m-bottom-30 text-center text-color-100">Update Project Type Form</h4>
                    <form method="post" action="/dashboard/project-types/{{ $type->slug }}">
                        @method('put')
                        @csrf
                        <div class="m-bottom-15">
                            <label for="type_name" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Type
                                Name</label>
                            <input type="text" class="form-control @error('type_name') is-invalid @enderror"
                                name="type_name" id="type_name" placeholder="Enter Type Name"
                                value="{{ old('type_name', $type->type_name) }}">
                            @error('type_name')
                                <div id="typeNameFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="slug" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug"
                                id="slug" value="{{ old('slug', $type->slug) }}" aria-label="slug input Readonly"
                                readonly>
                            @error('slug')
                                <div id="slugFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="about"
                                class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">About</label>
                            <textarea class="form-control" id="about" rows="3" name="about" placeholder="Enter Project Type About">{{ old('about', $type->about) }}</textarea>
                        </div>
                        <div class="button-grouping text-end">
                            <a href="/dashboard/project-types" class="btn btn-light-border m-right-15">Cancel</a>
                            <button type="submit" class="btn btn-primary-color px-4">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        const typeName = document.querySelector('#type_name');
        const slug = document.querySelector('#slug');

        typeName.onchange = (e) => {
            e.preventDefault();
            let selectedValues = typeName.value
            selectedValues = selectedValues.replaceAll(/[&\/\\#,+()$~%.'":*?<>{}]/g, '');
            selectedValues = selectedValues.replaceAll(' ', '-');
            selectedValues = selectedValues.toLowerCase();

            slug.value = selectedValues;
        };
    </script>
@endsection
