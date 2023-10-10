@extends('layouts.main')

@section('content')
    <section id="product-info" class="mb-50">
        <div class="row mb-3">
            <div class="col">
                <h1 class="fw-bold text-center text-color-100">About Us</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6 text-center mb-15 mb-0-md">
                <img class="img-fluid rounded-circle" src="{{ asset('img/logo.png') }}" alt="Logo Kpop Soulmate"
                    width="200px">
            </div>
            <div class="col-12 col-md-6 align-self-center">
                <h4 class="fw-semibold text-color-100 text-center text-md-start">What Is Kpop Soulmate?</h4>
                <p class="fs-14 fw-medium text-color-100 mb-0">Kpop Soulmate is a YouTube channel dedicated to K-pop videos;
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

    {{-- TODO: Inspirasi https://www.gojek.com/id-id/ dan https://www.gojek.com/id-id/products/ --}}
    <section id="content" class="mb-50">
        <div class="row text-center">
            <div class="col">
                <h2 class="fw-bold text-color-100">Our Content</h2>
            </div>
        </div>
    </section>

    <section id="faq" class="mb-50">
        <div class="row">
            <div class="col">
                <h2 class="fw-bold text-color-100 text-center mb-15">FAQ</h2>
                <div class="accordion accordion-flush" id="accordionFlushFAQ">
                    <div class="accordion-item rounded-all-5">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-medium" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-first-faq" aria-expanded="false" aria-controls="flush-first-faq">
                                What software do we use For Editing Video?
                            </button>
                        </h2>
                        <div id="flush-first-faq" class="accordion-collapse collapse" data-bs-parent="#accordionFlushFAQ">
                            <div class="accordion-body">Sony Vegas Pro to edit video bars and time, and insert the lyrics.
                                Photoshop to edit member images, create layouts, lyrics, and thumbnails. Figma for editing
                                intro layouts. After Effects to create animation effects and transitions in the video and
                                outro along with the charts. </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-medium" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                What timezone do we use?
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushFAQ">
                            <div class="accordion-body">
                                We use Korea Standard Time (KST), since its related to K-Pop.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseThree" aria-expanded="false"
                                aria-controls="flush-collapseThree">
                                Accordion Item #3
                            </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse"
                            data-bs-parent="#accordionFlushFAQ">
                            <div class="accordion-body">Placeholder content for this accordion, which is intended to
                                demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion
                                body. Nothing more exciting happening here in terms of content, but just filling up the
                                space to make it look, at least at first glance, a bit more representative of how this would
                                look in a real-world application.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="videos">
        <div class="row">
            <div class="col-12 col-lg-6">
                <h3 class="fw-semibold text-color-100">First Video</h3>
                <div class="ratio ratio-16x9">
                    <iframe class="rounded-all-10" src="https://www.youtube.com/embed/Vm5dJvx4V90"
                        title="Hello Venus (헬로비너스) - &#39;Runway (아니길)&#39; (Line Distribution)"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen>
                    </iframe>
                </div>

            </div>
            <div class="col-12 col-lg-6">
                <h3 class="fw-semibold text-color-100">Latest Video</h3>
                <div class="ratio ratio-16x9">
                    <iframe class="rounded-all-10" src="https://www.youtube.com/embed/EZXp-Gj8iP8"
                        title="Dreamcatcher - July 7th (약속해 우리) (Line Distribution)"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>
@endsection