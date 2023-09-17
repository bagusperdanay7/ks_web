@extends('dashboard.layouts.main')
@section('content')
    <section id="category-single-dashboard">
        <div class="row m-bottom-25 justify-content-center">
            <div class="col-md-8 col-12">
                <div class="form-container ">
                    <h4 class="fw-bold m-bottom-30 text-center text-color-100">Update Category Form</h4>
                    <form method="post" action="/dashboard/categories/{{ $category->slug }}">
                        @method('put')
                        @csrf
                        <div class="m-bottom-15">
                            <label for="category_name" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Category
                                Name</label>
                            <input type="text" class="form-control @error('category_name') is-invalid @enderror"
                                name="category_name" id="category_name" placeholder="Enter Category Name"
                                value="{{ old('category_name', $category->category_name) }}">
                            @error('category_name')
                                <div id="categoryNameFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="slug" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug"
                                id="slug" value="{{ old('slug', $category->slug) }}" aria-label="slug input Readonly"
                                readonly>
                            @error('slug')
                                <div id="slugFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-bottom-15">
                            <label for="icon_class" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Icon
                                Class</label>
                            <input type="text" class="form-control @error('icon_class') is-invalid @enderror"
                                name="icon_class" id="icon_class" value="{{ old('icon_class', $category->icon_class) }}"
                                placeholder="Enter Icon Class from Box Icons">
                            @error('icon_class')
                                <div id="icon_classFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="button-grouping text-end">
                            <a href="/dashboard/categories" class="btn btn-light-border m-right-15">Cancel</a>
                            <button type="submit" class="btn btn-primary-color px-4">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        const categoryName = document.querySelector('#category_name');
        const slug = document.querySelector('#slug');

        categoryName.onchange = (e) => {
            e.preventDefault();
            let selectedValues = categoryName.value
            selectedValues = selectedValues.replaceAll(/[&\/\\#,+()$~%.'":*?<>{}]/g, '');
            selectedValues = selectedValues.replaceAll(' ', '-');
            selectedValues = selectedValues.toLowerCase();

            slug.value = selectedValues;
        };
    </script>
@endsection
