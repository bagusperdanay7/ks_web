@extends('layouts.main')

@section('container')
    <section id="hero-landing-page">
        <div class="row">
            <div class="col-12 col-lg order-2 order-lg-1 align-self-center">
                <h1 class="hero-welcome">Welcome to <p>KPOP SOULMATE</p>
                </h1>
                <h2 class="hero-h2">Kpop Line Distribution & More</h2>
                <p class="welcome-text">Hello, Welcome to Our Website it’s Good to see you here. Explore the video & Enjoy
                    Your Journey on Our Website
                </p>
                <a href="{{ route('gallery') }}" class="btn btn-main btn-lg">Explore</a>
            </div>
            <div class="col-12 col-lg order-1 order-lg-2">
                <div id="carouselHeroAutoplaying" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner shadow rounded-4">
                        <div class="carousel-item active">
                            <img src="{{ asset('img/hero_img1.jpg') }}" class="d-block w-100" alt="hero image">
                        </div>
                        <div class="carousel-item">
                            <img src="img/hero_img2.png" class="d-block w-100" alt="hero image 2">
                        </div>
                        <div class="carousel-item">
                            <img src="img/hero_img3.png" class="d-block w-100" alt="hero image 3">
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
                    <box-icon type='logo' name='youtube' size='48px' color='#FF0000'></box-icon>
                    <p class="socmed-home-text">SUBSCRIBE</p>
                </a>
            </div>
            <div class="col-12 col-sm mb-sm-30">
                <a href="">
                    <box-icon type='logo' name='paypal' size='48px' color='#009CDE'></box-icon>
                    <p class="socmed-home-text">SUPPORT</p>
                </a>
            </div>
            <div class="col-12 col-sm mb-sm-30">
                <a href="">
                    <box-icon type='logo' name='discord' size='48px' color="#8A9CFE"></box-icon>
                    <p class="socmed-home-text">JOIN US</p>
                </a>
            </div>
        </div>
    </section>

    <section id="our-content-lp">
        <div class="row">
            <h3 class="text-center mb-30">OUR CONTENT</h3>
            <div class="col-sm-6 col-12 col-md-4 col-lg-3 mb-3">
                <div class="content-card-lp text-center">
                    <i class='bx bxs-doughnut-chart bx-xlg'></i>
                    <p class="text-sb-18 m-vertical-10">Line Distribution</p>
                    <p class="inter-regular-14">This content is provided about how many parts each member sings in a song
                    </p>
                </div>
            </div>
            <div class="col-sm-6 col-12 col-md-4 col-lg-3 mb-3">
                <div class="content-card-lp text-center">
                    <i class='bx bxs-bar-chart-alt-2 bx-xlg'></i>
                    <p class="text-sb-18 m-vertical-10">Line Evolution</p>
                    <p class="inter-regular-14">This content is provided how many parts a member sings in the group's title
                        track
                    </p>
                </div>
            </div>
            <div class="col-sm-6 col-12 col-md-4 col-lg-3 mb-3">
                <div class="content-card-lp text-center">
                    <i class='bx bxs-album bx-xlg'></i>
                    <p class="text-sb-18 m-vertical-10">Album Distribution</p>
                    <p class="inter-regular-14">This content is provided about how many parts each member sings in an album
                    </p>
                </div>
            </div>
            <div class="col-sm-6 col-12 col-md-4 col-lg-3 mb-3">
                <div class="content-card-lp text-center">
                    <i class='bx bxs-user-voice bx-xlg'></i>
                    <p class="text-sb-18 m-vertical-10">How Would</p>
                    <p class="inter-regular-14">This content is provided about what if a certain group sings another group's
                        song
                    </p>
                </div>
            </div>
            <a href="{{ route('categories') }}"
                class="link-show-all-lp text-decoration-none text-mdm-14 text-center mt-3">Show All Content <i
                    class="las la-arrow-right"></i>
            </a>
        </div>
    </section>

    <section id="upcoming-schedule-lp">
        <div class="row">
            <h3 class="text-center mb-30">UPCOMING SCHEDULE</h3>
            <div class="col-12" id="upcoming-display-desktop">
                <div class="upcoming-schedule-card-lp">
                    <div class="row fw-semibold header-table-upcoming">
                        <div class="col-3">Project Title</div>
                        <div class="col">Category</div>
                        <div class="col">Date</div>
                        <div class="col">Class</div>
                        <div class="col">Requester</div>
                        <div class="col">Status</div>
                        <div class="col">Vote</div>
                    </div>
                    @foreach ($schedules as $schedule_date => $schedule_items)
                        <div class="row mt-3">
                            <div class="col-3">
                                <div class="d-flex justify-content-between">
                                    <p class="m-0 text-sb-14">{{ $schedule_items->project_title }}</p>
                                    <span class="text-sb-14">{{ $schedule_items->progress }}%</span>
                                </div>
                                <div class="progress" role="progressbar" aria-label="progress project"
                                    aria-valuenow="{{ $schedule_items->progress }}" aria-valuemin="0"
                                    aria-valuemax="100">
                                    <div class="progress-bar bg-second rounded-pill"
                                        style="width: {{ $schedule_items->progress }}%;"></div>
                                </div>
                            </div>
                            <div class="col align-self-center text-mdm-14 text-tertiary">
                                {{ $schedule_items->content_category->name }}</div>
                            <div class="col align-self-center text-regular-14"><i class="lar la-calendar"></i>
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $schedule_items->project_date)->format('d F Y') }}
                            </div>
                            <div class="col align-self-center text-regular-14">
                                {{ $schedule_items->project_class }}
                            </div>
                            <div class="col align-self-center text-regular-14">
                                <i class="las la-user-alt"></i> {{ $schedule_items->project_requester }}
                            </div>
                            <td class="align-middle">
                            </td>
                            <div class="col align-self-center">
                                @if ($schedule_items->project_status == 'Completed')
                                    <span class="btn btn-complete">{{ $schedule_items->project_status }}</span>
                                @elseif ($schedule_items->project_status == 'On Process')
                                    <span class="btn btn-onprocess">{{ $schedule_items->project_status }}</span>
                                @elseif ($schedule_items->project_status == 'Pending')
                                    <span class="btn btn-pending">{{ $schedule_items->project_status }}</span>
                                @elseif ($schedule_items->project_status == 'Rejected')
                                    <span class="btn btn-rejected">{{ $schedule_items->project_status }}</span>
                                @else
                                    <span class="btn btn-onprocess">{{ $schedule_items->project_status }}</span>
                                @endif
                            </div>
                            <div class="col align-self-center text-regular-14">{{ $schedule_items->votes }}
                                Votes
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @foreach ($schedules as $schedule_date => $schedule_items)
                <div class="col-12 col-md-6" id="upcoming-display-mobile">
                    <div class="upcoming-schedule-card-lp mb-3">
                        <div class="row">
                            <div class="d-flex flex-column">
                                <div class="text-regular-14"><i class="lar la-calendar"></i>
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d', $schedule_items->project_date)->format('d F Y') }}
                                </div>
                                <div class="mt-0 mb-1">
                                    @if ($schedule_items->project_status == 'Completed')
                                        <span class="btn btn-complete">{{ $schedule_items->project_status }}</span>
                                    @elseif ($schedule_items->project_status == 'On Process')
                                        <span class="btn btn-onprocess">{{ $schedule_items->project_status }}</span>
                                    @elseif ($schedule_items->project_status == 'Pending')
                                        <span class="btn btn-pending">{{ $schedule_items->project_status }}</span>
                                    @elseif ($schedule_items->project_status == 'Rejected')
                                        <span class="btn btn-rejected">{{ $schedule_items->project_status }}</span>
                                    @else
                                        <span class="btn btn-onprocess">{{ $schedule_items->project_status }}</span>
                                    @endif
                                </div>
                                <div class="mb-1">
                                    <p class="text-sb-14 m-0">{{ $schedule_items->project_title }}</p>
                                </div>
                                <div class="text-mdm-14 mb-1">
                                    <span class="text-tertiary">
                                        {{ $schedule_items->content_category->name }}
                                    </span> •
                                    <span class="text-black">{{ $schedule_items->project_class }}</span>
                                </div>
                                <div class="text-regular-14 mb-1">
                                    <i class="las la-user-alt"></i> {{ $schedule_items->project_requester }} |
                                    {{ $schedule_items->votes }}
                                    Votes
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="m-0 text-md-14">Progress</p>
                                    <span class="text-sb-14">{{ $schedule_items->progress }}%</span>
                                </div>
                                <div class="progress" role="progressbar" aria-label="progress project"
                                    aria-valuenow="{{ $schedule_items->progress }}" aria-valuemin="0"
                                    aria-valuemax="100">
                                    <div class="progress-bar bg-second rounded-pill"
                                        style="width: {{ $schedule_items->progress }}%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <a href="{{ route('projects') }}"
                class="link-show-all-lp text-decoration-none text-mdm-14 text-center mt-30">Show All Projects <i
                    class="las la-arrow-right"></i>
            </a>
        </div>
    </section>
@endsection
