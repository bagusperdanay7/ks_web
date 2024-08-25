@extends('layouts.main')

@section('content')
    <section id="product-info" class="mb-50">
        <div class="row mb-3">
            <div class="col">
                <h1 class="fw-bold text-color-100 text-center">About Us</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6 mb-15 mb-0-md text-center">
                <img class="img-fluid rounded-circle" src="{{ asset('img/logo.png') }}" alt="Logo Kpop Soulmate"
                    width="200px">
            </div>
            <div class="col-12 col-md-6 align-self-center">
                <h4 class="fw-semibold text-color-100 text-md-start text-center">What Is Kpop Soulmate?</h4>
                <p class="fs-14 fw-medium text-color-100 lh-lg mb-0">Kpop Soulmate is a YouTube channel dedicated to K-pop
                    videos;
                    the
                    channel's
                    beginnings consist of the
                    line distribution of a K-pop group. This channel was inspired by the work of <a
                        href="https://www.youtube.com/@WatasyWahyo" class="text-color-secondary"
                        target="_blank">WatasyWahyo</a>. He
                    demonstrated me how to make videos for the first time. On <strong class="text-color-100">December
                        28,
                        2016,</strong> the debut video on this
                    channel was <strong class="text-color-100">Hello Venus - Runway (Line Distribution)</strong>. This
                    channel was formerly called BGK
                    Funtastic,
                    subsequently BGK Diamond Hour, and finally Kpop Soulmate. Aside from Line Distribution, this channel
                    currently contains more content.</p>
            </div>
        </div>
    </section>

    <section id="information-youtube" class="mb-50">
        <div class="row text-center">
            <div class="col-12 col-sm-6 col-md-4 mb-15 mb-sm-0">
                <h1 class="fw-bold text-color-100">{{ $subscriberCount }}</h1>
                <p class="fs-18 text-color-100 fw-medium mb-0">subscribers on YouTube</p>
            </div>
            <div class="col-12 col-sm-6 col-md-4 mb-15 mb-md-0">
                <h1 class="fw-bold text-color-100">{{ $totalVideo }}</h1>
                <p class="fs-18 text-color-100 fw-medium mb-0">videos on YouTube</p>
            </div>
            <div class="col-12 col-md-4">
                <h1 class="fw-bold text-color-100">{{ number_format($totalView, 0, '', ',') }}</h1>
                <p class="fs-18 text-color-100 fw-medium mb-0">views count on YouTube</p>
            </div>
        </div>
    </section>

    <section id="videos" class="mb-50">
        <div class="row">
            <div class="col-12 col-lg-6 mb-lg-0 mb-3">
                <h3 class="fw-semibold text-color-100">Our First Video</h3>
                <div class="ratio ratio-16x9">
                    <iframe class="rounded-10" src="https://www.youtube.com/embed/Vm5dJvx4V90"
                        title="HELLOVENUS (헬로비너스 ) - Runway (아니길) (Line Distribution)"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <h3 class="fw-semibold text-color-100">Our Latest Video</h3>
                <div class="ratio ratio-16x9">
                    <iframe class="rounded-10" src="https://www.youtube.com/embed/{{ $latestVideo }}"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>

    <section id="faq">
        <div class="row">
            <div class="col">
                <h2 class="fw-bold text-color-100 mb-15 text-center">FAQ</h2>
                <div class="accordion accordion-flush" id="accordionFlushFAQ">
                    <div class="accordion-item rounded-10 fs-sm-14">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-medium text-color-100 bg-second fs-sm-14"
                                type="button" data-bs-toggle="collapse" data-bs-target="#flush-first-faq"
                                aria-expanded="false" aria-controls="flush-first-faq">
                                What software do we use For Editing Video?
                            </button>
                        </h2>
                        <div id="flush-first-faq" class="accordion-collapse collapse" data-bs-parent="#accordionFlushFAQ">
                            <div class="accordion-body text-color-100 bg-second fs-sm-14"><strong>Magix Vegas Pro
                                    18</strong> to edit video bars and time, and insert the lyrics.
                                <strong>Adobe Photoshop</strong> to edit member images, create layouts, lyrics, and
                                thumbnails. <strong>Figma</strong> for editing
                                intro layouts. <strong>Adobe After Effects</strong> to create animation effects and
                                transitions in the video and
                                outro along with the charts.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-medium text-color-100 bg-second fs-sm-14"
                                type="button" data-bs-toggle="collapse" data-bs-target="#flush-timezone"
                                aria-expanded="false" aria-controls="flush-collapseTwo">
                                What timezone do we use?
                            </button>
                        </h2>
                        <div id="flush-timezone" class="accordion-collapse collapse" data-bs-parent="#accordionFlushFAQ">
                            <div class="accordion-body text-color-100 bg-second fs-sm-14">
                                We use Korea Standard Time <strong>(KST)</strong>, since its related to K-Pop.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-medium text-color-100 bg-second fs-sm-14"
                                type="button" data-bs-toggle="collapse" data-bs-target="#flush-date-format"
                                aria-expanded="false" aria-controls="flush-collapseTwo">
                                What date format do we use?
                            </button>
                        </h2>
                        <div id="flush-date-format" class="accordion-collapse collapse" data-bs-parent="#accordionFlushFAQ">
                            <div class="accordion-body text-color-100 bg-second fs-sm-14">
                                We use British Date Format <strong>(D M Y)</strong>, since its the same date format as My
                                Country (Indonesia).
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
