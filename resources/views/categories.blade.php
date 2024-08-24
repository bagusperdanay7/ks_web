@extends('layouts.main')

@section('content')
    <section id="categories">
        <div class="row justify-content-between">
            <div class="gallery-cards-head">
                <h2 class="fw-bold text-color-100">Categories</h2>
            </div>
            @forelse ($categories as $cat)
                <div class="col-6 col-xl-3 {{ $loop->last ? '' : 'mb-4' }}">
                    <a href="/gallery?category={{ $cat->category->slug }}" class="text-decoration-none">
                        <div @class([
                            'd-flex',
                            'flex-column',
                            'flex-sm-row',
                            'align-items-center',
                            'category-card',
                            'bg-alert-10' => $cat->category->category_name === 'Album Distribution',
                            'bg-second-10' => $cat->category->category_name === 'Total Line Evolution',
                            'bg-main-10' => $cat->category->category_name === 'Line Distribution',
                            'bg-tertiary-10' => $cat->category->category_name === 'Line Evolution',
                            'bg-cd-10' => $cat->category->category_name === 'Center Distribution',
                            'bg-success-10' => $cat->category->category_name === 'How Should',
                            'bg-hw-10' => $cat->category->category_name === 'How Would',
                            'bg-rb-10' => $cat->category->category_name === 'Ranking Battle',
                            'bg-info-subtle' => $cat->category->category_name === 'Other',
                        ])>
                            <div class="mb-sm-10">
                                <i @class([
                                    $cat->category->icon_class,
                                    'text-color-ad' => $cat->category->category_name === 'Album Distribution',
                                    'text-color-ae' => $cat->category->category_name === 'Total Line Evolution',
                                    'text-color-ld' => $cat->category->category_name === 'Line Distribution',
                                    'text-color-le' => $cat->category->category_name === 'Line Evolution',
                                    'text-color-cd' => $cat->category->category_name === 'Center Distribution',
                                    'text-color-hs' => $cat->category->category_name === 'How Should',
                                    'text-color-hw' => $cat->category->category_name === 'How Would',
                                    'text-color-rb' => $cat->category->category_name === 'Ranking Battle',
                                    'text-info' => $cat->category->category_name === 'Other',
                                ])></i>
                            </div>
                            <div class="ml-sm-0 text-sm-start ml-10 text-center">
                                <h5>{{ $cat->category->category_name }}</h5>
                                <p>{{ $cat->total }}
                                    videos</p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col">
                    <div class="text-color-100 text-center">
                        <i class="las la-icons fs-1"></i>
                        <p class="fw-medium fs-14 mb-0 mt-1">No Category Found!</p>
                    </div>
                </div>
            @endforelse
        </div>
    </section>
@endsection
