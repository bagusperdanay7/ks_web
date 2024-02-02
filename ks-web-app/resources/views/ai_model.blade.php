@extends('layouts.main')

@section('content')
    <section id="info-model" class="mb-30">
        <div class="row">
            <div class="col">
                <h2 class="text-color-100 fw-bold mb-10">AI Model</h2>
                <p class="font-inter fs-4 fs-md-18 text-color-100 mb-0">This AI model is provided for creators who want to
                    create AI
                    covers using their favorite artists.</p>
            </div>
        </div>
    </section>

    <section id="list-ai" class="mb-50">
        <div class="row">
            <div class="col">
                <div class="ai-models-container">
                    <h3 class="text-color-100 fw-semibold mb-15">List AI Model</h3>
                    @forelse ($models as $model)
                        <div class="row align-items-center list-ai-model {{ $loop->last ? '' : 'mb-4' }}">
                            <div class="col-12 col-lg-6 col-xxl-7 mb-lg-0 mb-10">
                                <div class="d-flex align-items-xl-center align-items-start">
                                    <div class="mr-10">
                                        <img src="{{ asset('storage/' . $model->cover_model) }}"
                                            alt="{{ $model->model_name }} cover" class="rounded-10 img-square">
                                    </div>
                                    <div class="mb-0">
                                        <h5 class="text-color-100">{{ $model->model_name }}</h5>
                                        <p class="fs-12 text-color-100 mb-0 ">{{ $model->description }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 mb-10 mb-lg-0">
                                <audio src="{{ asset('storage/' . $model->sample) }}" class="col-12" controls></audio>
                            </div>
                            <div class="col-12 col-lg-2 col-xxl-1 text-end">
                                <button type="button" class="btn p-0 me-3 text-color-100 btn-copy" data-url="{{ $model->url }}"
                                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Copy to clipboard" role="button" aria-label="Copy {{ $model->model_name }} url to clipboard">
                                    <i class="las la-clipboard fs-4"></i>
                                </button>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download Model" href="{{ $model->url }}" class="btn p-0 text-decoration-none text-color-100" aria-label="Download {{ $model->model_name }} model">
                                    <i class="las la-download fs-4"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="text-color-100 text-center">
                            <i class="las la-user-slash fs-1"></i>
                            <p class="mb-0 mt-1 fw-medium fs-14">No AI Models Found!</p>
                        </div>
                    @endforelse
                    <div class="pagination-container mt-3">
                        {{ $models->onEachSide(0)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="faq-model-ai">
        <div class="row">
            <div class="col">
                <div class="accordion accordion-flush" id="accordionFAQModel">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-medium text-color-100" type="button"
                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                                aria-controls="flush-collapseOne">
                                How to Use the Model?
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFAQModel">
                            <div class="accordion-body">
                                Visit this <a
                                    href=" https://docs.google.com/document/d/13ebnzmeEBc6uzYCMt-QVFQk-whVrK4zw8k7_Lw3Bv_A/edit#heading=h.bjzhhhcn3f69"
                                    target="_blank" class="text-color-secondary">link</a> to see details on how to use the
                                model!
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-medium text-color-100" type="button"
                                data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                aria-controls="flush-collapseTwo">
                                Is there another model than these?
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFAQModel">
                            <div class="accordion-body">Yes, you can check this <a
                                    href="https://docs.google.com/spreadsheets/d/1tAUaQrEHYgRsm1Lvrnj14HFHDwJWl0Bd9x0QePewNco/edit?usp=sharing"
                                    target="_blank" class="text-color-secondary">link</a>. But the models are trained by
                                someone and not trained by us.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="toastLiveCopy" class="toast rounded-10" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header rounded-top-8 bg-main-10">
                <strong class="me-auto">Kpop Soulmate</strong>
                <small>just now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body bg-main-10 rounded-bottom-8">
                Link Copied
            </div>
        </div>
    </div>

    <script>
        var buttonCopy = document.querySelectorAll(".btn-copy");
        let toastContainer = document.getElementById("toastLiveCopy")

        for (var i = 0; i < buttonCopy.length; i++) {

            var buttons = buttonCopy[i];
            buttons.addEventListener('click', function() {
<<<<<<< HEAD
                navigator.clipboard.writeText(this.attributes[2].value);
=======
                navigator.clipboard.writeText(this.attributes[1].value);
>>>>>>> f18853d370fd6012683fb0fcdcc189fe71f044e4

                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastContainer);
                toastBootstrap.show()

            }, false);
        }
    </script>
@endsection
