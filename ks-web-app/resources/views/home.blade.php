@extends('layouts.main')
@if (session()->has('validationSuccess'))
    <div class="container">
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast-container top-0 end-0 p-0" style="margin-top: 80px">
                <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-success-10 text-color-100">
                        <strong class="me-auto"><i class="las la-check-circle text-color-hs fs-18"></i> Kpop
                            Soulmate</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body bg-success-10 fs-14 font-inter text-color-100">
                        {{ session('validationSuccess') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if (session()->has('success'))
    <div class="container">
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast-container top-0 end-0 p-0" style="margin-top: 80px">
                <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-success-10 text-color-100">
                        <strong class="me-auto"><i class="las la-check-circle text-color-hs fs-18"></i> Kpop
                            Soulmate</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body bg-success-10 fs-14 font-inter text-color-100">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@section('content')
    <section id="hero-landing-page">
        <div class="row">
            <div class="col-12 col-lg order-2 order-lg-1 align-self-center">
                <h1 class="hero-welcome">Welcome to <strong>KPOP SOULMATE</strong>
                </h1>
                <h2 class="hero-h2">Kpop Line Distribution & More</h2>
                <p class="hero-text">Hello, Welcome to Our Website it’s Good to see you here. Explore the video &
                    Enjoy
                    Your Journey on Our Website
                </p>
                <a href="{{ route('gallery') }}" class="btn btn-hero">Explore</a>
            </div>
            <div class="col-12 col-lg order-1 order-lg-2">
                <div id="carouselHeroAutoplaying" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner shadow rounded-4">
                        <div class="carousel-item active">
                            <img src="{{ asset('img/hero_img1.jpg') }}" class="d-block img-hero img-fluid" alt="hero image">
                        </div>
                        <div class="carousel-item">
                            <img src="img/hero_img2.png" class="d-block img-hero img-fluid" alt="hero image 2">
                        </div>
                        <div class="carousel-item">
                            <img src="img/hero_img3.png" class="d-block img-hero img-fluid" alt="hero image 3">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselHeroAutoplaying"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselHeroAutoplaying"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </section>
    <section id="socmed-landing-page">
        <div class="row text-center">
            <div class="col-12 col-sm mb-sm-30">
                <a href="https://www.youtube.com/@KpopSoulmate" target="_blank">
                    <i class='bx bxl-youtube bx-lg' style="color: #FF0000;"></i>
                    <p class="socmed-home-text">SUBSCRIBE</p>
                </a>
            </div>
            <div class="col-12 col-sm mb-sm-30">
                <a href="https://paypal.me/bagusperdanq" target="_blank">
                    <i class='bx bxl-paypal bx-lg' style="color: #009CDE;"></i>
                    <p class="socmed-home-text">SUPPORT</p>
                </a>
            </div>
            <div class="col-12 col-sm mb-sm-30">
                <a href="">
                    <i class='bx bxl-discord-alt bx-lg' style="color: #8A9CFE;"></i>
                    <p class="socmed-home-text">JOIN US</p>
                </a>
            </div>
        </div>
    </section>

    <section id="our-content-lp">
        <div class="row">
            <h3 class="text-center mb-30 fs-24 fw-bold text-color-100">OUR CONTENT</h3>
            <div class="col-sm-6 col-12 col-md-4 col-lg-3 mb-3">
                <div class="border-card text-center">
                    <i class='bx bxs-doughnut-chart fs-72 text-color-80'></i>
                    <p class="fs-18 fw-semibold text-color-100 my-10">Line Distribution</p>
                    <p class="fs-14 font-inter fw-normal m-0 text-color-80">This content is provided about how many parts
                        each
                        member
                        sings in a song
                    </p>
                </div>
            </div>
            <div class="col-sm-6 col-12 col-md-4 col-lg-3 mb-3">
                <div class="border-card text-center">
                    <i class='bx bxs-bar-chart-alt-2 fs-72 text-color-80'></i>
                    <p class="fs-18 fw-semibold text-color-100 my-10">Line Evolution</p>
                    <p class="fs-14 font-inter fw-normal m-0 text-color-80">This content is provided how many parts a
                        member
                        sings
                        in
                        the group's title
                        track
                    </p>
                </div>
            </div>
            <div class="col-sm-6 col-12 col-md-4 col-lg-3 mb-3">
                <div class="border-card text-center">
                    <i class='bx bxs-album fs-72 text-color-80'></i>
                    <p class="fs-18 fw-semibold text-color-100 my-10">Album Distribution</p>
                    <p class="fs-14 font-inter fw-normal m-0 text-color-80">This content is provided about how many parts
                        each
                        member
                        sings in an album
                    </p>
                </div>
            </div>
            <div class="col-sm-6 col-12 col-md-4 col-lg-3 mb-3">
                <div class="border-card text-center">
                    <i class='bx bxs-user-voice fs-72 text-color-80'></i>
                    <p class="fs-18 fw-semibold text-color-100 my-10">How Would</p>
                    <p class="fs-14 font-inter fw-normal m-0 text-color-80">This content is provided about what if a
                        certain
                        group
                        sings another group's
                        song
                    </p>
                </div>
            </div>
            <a href="{{ route('categories') }}" class="link-show-all mt-30">Show
                All Content <i class="las la-arrow-right"></i>
            </a>
        </div>
    </section>

    <section id="upcoming-schedule-lp">
        <div class="row">
            <h3 class="text-center mb-30 fw-bold text-color-100">UPCOMING SCHEDULE</h3>
            <div class="col-12" id="upcoming-display-desktop">
                <div class="border-card">
                    <div class="row fw-semibold fs-14 text-color-100 header-table-upcoming">
                        <div class="col-3">Project Title</div>
                        <div class="col">Category</div>
                        <div class="col">Date</div>
                        <div class="col">Type</div>
                        <div class="col">Requester</div>
                        <div class="col">Status</div>
                        <div class="col">Vote</div>
                    </div>
                    @forelse ($schedules as $scheduleDate => $scheduleItems)
                        <div class="row mt-3">
                            <div class="col-3">
                                <div class="d-flex justify-content-between">
                                    <p class="m-0 fs-14 fw-semibold text-color-100">{{ $scheduleItems->project_title }}</p>
                                    <span class="fs-14 fw-semibold text-color-100">{{ $scheduleItems->progress }}%</span>
                                </div>
                                <div class="progress bg-main-20" role="progressbar" style="height: 10px"
                                    aria-label="progress project" aria-valuenow="{{ $scheduleItems->progress }}"
                                    aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-main rounded-pill"
                                        style="width: {{ $scheduleItems->progress }}%;"></div>
                                </div>
                            </div>
                            <div @class([
                                'col',
                                'align-self-center',
                                'fs-14',
                                'fw-medium',
                                'text-color-ld' =>
                                    $scheduleItems->category->category_name === 'Line Distribution',
                                'text-color-le' =>
                                    $scheduleItems->category->category_name === 'Line Evolution',
                                'text-color-ad' =>
                                    $scheduleItems->category->category_name === 'Album Distribution',
                                'text-color-ae' =>
                                    $scheduleItems->category->category_name === 'Album Evolution',
                                'text-color-rb' =>
                                    $scheduleItems->category->category_name === 'Ranking Battle',
                                'text-color-hs' => $scheduleItems->category->category_name === 'How Should',
                                'text-color-hw' => $scheduleItems->category->category_name === 'How Would',
                                'text-color-cd' =>
                                    $scheduleItems->category->category_name === 'Center Distribution',
                            ])> {{ $scheduleItems->category->category_name }}
                            </div>
                            @if ($scheduleItems->date)
                                <div class="col align-self-center fw-medium fs-14 text-color-80"><i
                                        class="lar la-calendar"></i>
                                    {{ \Carbon\Carbon::parse($scheduleItems->date)->format('j F Y, G:i T') }}
                                </div>
                            @else
                                <div class="col align-self-center fw-medium fs-14 text-color-80"><i
                                        class="lar la-calendar"></i>
                                    Coming Soon
                                </div>
                            @endif
                            <div class="col align-self-center text-color-100 fs-14 fw-normal">
                                {{ $scheduleItems->type->type_name }}
                            </div>
                            <div class="col align-self-center text-color-100 fs-14 fw-normal">
                                <i class="las la-user-alt"></i> {{ $scheduleItems->requester }}
                            </div>
                            <div class="col align-self-center">
                                <span @class([
                                    'btn',
                                    'btn-complete' => $scheduleItems->status === 'Completed',
                                    'btn-onprocess' => $scheduleItems->status === 'On Process',
                                    'btn-pending' => $scheduleItems->status === 'Pending',
                                    'btn-rejected' => $scheduleItems->status === 'Rejected',
                                ])> {{ $scheduleItems->status }}</span>
                            </div>
                            <div class="col align-self-center text-color-100 fs-14 fw-normal">{{ $scheduleItems->votes }}
                                Votes
                            </div>
                        </div>
                    @empty
                        <div class="row">
                            <div class="col mt-3 text-center ">
                                <svg width="48" height="48" viewBox="0 0 84 84" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                        fill="#EA8887" />
                                    <path
                                        d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                        fill="#787878" />
                                </svg>
                                <p class="fs-14 fw-medium mt-2 mb-0">No Data found!</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
            @forelse ($schedules as $scheduleDate => $scheduleItems)
                <div class="col-12 col-md-6" id="upcoming-display-mobile">
                    <div class="border-card {{ $loop->last ? '' : 'mb-3' }}">
                        <div class="row">
                            <div class="d-flex flex-column">
                                @if ($scheduleItems->date)
                                    <div class="fs-14 fw-medium text-color-80 mb-10"><i class="lar la-calendar"></i>
                                        {{ \Carbon\Carbon::parse($scheduleItems->date)->format('j F Y, G:i T') }}
                                    </div>
                                @else
                                    <div class="fs-14 fw-medium text-color-80 mb-10"><i class="lar la-calendar"></i>
                                        Coming Soon
                                    </div>
                                @endif
                                <div class="mt-0 mb5">
                                    <span @class([
                                        'btn',
                                        'btn-complete' => $scheduleItems->status === 'Completed',
                                        'btn-onprocess' => $scheduleItems->status === 'On Process',
                                        'btn-pending' => $scheduleItems->status === 'Pending',
                                        'btn-rejected' => $scheduleItems->status === 'Rejected',
                                    ])> {{ $scheduleItems->status }}</span>
                                </div>
                                <div class="mb5">
                                    <p class="fs-14 fw-semibold text-color-100 m-0">{{ $scheduleItems->project_title }}
                                    </p>
                                </div>
                                <div class="fs-14 fw-medium mb5">
                                    <span @class([
                                        'text-color-ld' =>
                                            $scheduleItems->category->category_name === 'Line Distribution',
                                        'text-color-le' =>
                                            $scheduleItems->category->category_name === 'Line Evolution',
                                        'text-color-ad' =>
                                            $scheduleItems->category->category_name === 'Album Distribution',
                                        'text-color-ae' =>
                                            $scheduleItems->category->category_name === 'Album Evolution',
                                        'text-color-rb' =>
                                            $scheduleItems->category->category_name === 'Ranking Battle',
                                        'text-color-hs' => $scheduleItems->category->category_name === 'How Should',
                                        'text-color-hw' => $scheduleItems->category->category_name === 'How Would',
                                        'text-color-cd' =>
                                            $scheduleItems->category->category_name === 'Center Distribution',
                                    ])>
                                        {{ $scheduleItems->category->category_name }}</span> •
                                    <span class="text-color-100">{{ $scheduleItems->type->type_name }}</span>
                                </div>
                                <div class="text-color-100 fs-14 fw-normal mb5">
                                    <i class="las la-user-alt"></i> {{ $scheduleItems->requester }} |
                                    {{ $scheduleItems->votes }}
                                    Votes
                                </div>
                                <div class="d-flex justify-content-between fs-14">
                                    <p class="m-0 fs-14">Progress</p>
                                    <span class="fs-14 fw-semibold text-color-100">{{ $scheduleItems->progress }}%</span>
                                </div>
                                <div class="progress bg-main-20 h-5" role="progressbar" style="height: 10px"
                                    aria-label="progress project" aria-valuenow="{{ $scheduleItems->progress }}"
                                    aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-main rounded-pill"
                                        style="width: {{ $scheduleItems->progress }}%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 col-md-6 mt-3 text-center" id="upcoming-display-mobile">
                    <div class="border-card mb-3">
                        <div class="row">
                            <svg width="48" height="48" viewBox="0 0 84 84" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                    fill="#EA8887" />
                                <path
                                    d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                    fill="#787878" />
                            </svg>
                            <p class="fs-14 fw-medium mb-0 mt-2">No Data found!</p>
                        </div>
                    </div>
                </div>
            @endforelse
            <a href="{{ route('projects') }}" class="link-show-all mt-30">Show All Projects <i
                    class="las la-arrow-right"></i>
            </a>
        </div>
    </section>
@endsection
