@extends('layouts.main')

@section('content')
    <section id="categories">
        <div class="row justify-content-between">
            <div class="gallery-cards-head">
                <h2 class="fw-bold text-color-100">Categories</h2>
            </div>

            @forelse ($categories as $category)
                <div class="col-6 col-xl-3 {{ $loop->last ? '' : 'mb-4' }}">
                    <a href="/gallery?category={{ $category->slug }}" class="text-decoration-none">
                        <div @class([
                            'd-flex',
                            'flex-column',
                            'flex-sm-row',
                            'align-items-center',
                            'category-card',
                            'bg-alert-10' => $category->category_name === 'Album Distribution',
                            'bg-second-10' => $category->category_name === 'Album Evolution',
                            'bg-main-10' => $category->category_name === 'Line Distribution',
                            'bg-tertiary-10' => $category->category_name === 'Line Evolution',
                            'bg-cd-10' => $category->category_name === 'Center Distribution',
                            'bg-success-10' => $category->category_name === 'How Should',
                            'bg-hw-10' => $category->category_name === 'How Would',
                            'bg-rb-10' => $category->category_name === 'Ranking Battle',
                        ])>
                            <div class="mb-sm-10">
                                <i @class([
                                    $category->icon_class,
                                    'text-color-ad' => $category->category_name === 'Album Distribution',
                                    'text-color-ae' => $category->category_name === 'Album Evolution',
                                    'text-color-ld' => $category->category_name === 'Line Distribution',
                                    'text-color-le' => $category->category_name === 'Line Evolution',
                                    'text-color-cd' => $category->category_name === 'Center Distribution',
                                    'text-color-hs' => $category->category_name === 'How Should',
                                    'text-color-hw' => $category->category_name === 'How Would',
                                    'text-color-rb' => $category->category_name === 'Ranking Battle',
                                ])></i>
                            </div>
                            <div class="ml-10 ml-sm-0 text-center text-sm-start">
                                <h5>{{ $category->category_name }}</h5>
                                <p>{{ $category->projects->where('status', 'Completed')->where('is_exclusive', 'No')->count() }}
                                    videos</p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col">
                    <div class="text-color-100 text-center">
                        <i class="las la-icons fs-1"></i>
                        <p class="fw-medium mt-1 fs-14 mb-0 ">No Category Found!</p>
                    </div>
                </div>
            @endforelse
        </div>
    </section>
@endsection
