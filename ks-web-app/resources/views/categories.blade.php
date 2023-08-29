@extends('layouts.main')

@section('content')
    <div class="row gallery-section justify-content-between mb-4">
        <div class="gallery-cards-head">
            <h2 class="">Content Category</h2>
        </div>

        @foreach ($categories as $category)
            <div class="col-3 category-card mb-4">
                <a href="/gallery?category={{ $category->slug }}">
                    <div class="d-flex align-items-center gallery-card">
                        <div class="">
                            <i class="{{ $category->icon_class }}"></i>
                        </div>
                        <div class="space-card">
                            <h5>{{ $category->category_name }}</h5>
                            <p>{{ $category->total }} videos</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
