@extends('layouts.main')

@section('container')
    <div class="row gallery-section justify-content-between mb-4">
        <div class="gallery-cards-head">
            <h2 class="">Content Category</h2>
        </div>

        @foreach ($content_categories as $category)
            <div class="col-3 category-card mb-4">
                <a href="/gallery?content_category={{ $category->slug }}">
                    <div class="d-flex align-items-center gallery-card">
                        <div class="">
                            <i class="{{ $category->icon_class }}"></i>
                        </div>
                        <div class="space-card">
                            <h5>{{ $category->name }}</h5>
                            <p>{{ $category->total }} videos</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
