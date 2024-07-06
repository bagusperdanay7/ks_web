@extends('layouts.main')

@section('content')
    <section id="tutorials">
        <div class="row mb-4">
            <div class="col">
                <h2 class="mb-0 fw-bold text-color-100">Tutorials</h2>
            </div>
        </div>
        <a href="" class="tutorial-link">
            <div class="row align-items-center mb-4">
                <div class="col-sm-6 col-md-5 col-lg-4 mb-10 mb-sm-0">
                    <img src="{{ asset('img/no_thumbnail.jpg') }}" alt="Tutorial Example" class="img-fluid rounded-10">
                </div>
                <div class="col">
                    <h3 class="fw-semibold text-color-100 mb-10 fs-md-18">How To Login With Google</h3>
                    <p class="text-truncate-2-line text-truncate text-color-80 fw-medium fs-14 mb-20">Lorem ipsum dolor sit
                        amet consectetur adipisicing elit. Repudiandae eligendi rem debitis mollitia quia doloremque minus
                        numquam sint vero aliquam a, iure similique iste veniam vitae distinctio libero? Blanditiis eveniet,
                        autem officia cumque illo minima nostrum error voluptas delectus temporibus eum quae omnis debitis
                        quis a eaque corporis odio unde.</p>
                    <p class="mb-0 fw-medium fs-12"><span class="p-2 bg-tertiary-10 text-color-tertiary rounded-10">Required
                            Login</span></p>
                </div>
            </div>
        </a>
        <a href="" class="tutorial-link">
            <div class="row align-items-center mb-4">
                <div class="col-sm-6 col-md-5 col-lg-4 mb-10 mb-sm-0">
                    <img src="{{ asset('img/no_thumbnail.jpg') }}" alt="Tutorial Example" class="img-fluid rounded-10">
                </div>
                <div class="col">
                    <h3 class="fw-semibold text-color-100 mb-10 fs-md-18">How To Make a Request</h3>
                    <p class="text-truncate-2-line text-truncate text-color-80 fw-medium fs-14 mb-20">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dignissimos, rem? Corrupti architecto fuga commodi magnam non dignissimos nihil nemo tempora ea mollitia, vitae expedita sunt temporibus ipsam, saepe aspernatur ratione?</p>
                    <p class="mb-0 fw-medium fs-12"><span class="p-2 bg-tertiary-10 text-color-tertiary rounded-10">Required
                            Login</span></p>
                </div>
            </div>
        </a>
        <a href="" class="tutorial-link">
            <div class="row align-items-center">
                <div class="col-sm-6 col-md-5 col-lg-4 mb-10 mb-sm-0">
                    <img src="{{ asset('img/no_thumbnail.jpg') }}" alt="Tutorial Example" class="img-fluid rounded-10">
                </div>
                <div class="col">
                    <h3 class="fw-semibold text-color-100 mb-10 fs-md-18">How to Explore Gallery</h3>
                    <p class="text-truncate-2-line text-truncate text-color-80 fw-medium fs-14 mb-20">Lorem ipsum dolor sit
                        amet consectetur adipisicing elit. Repudiandae eligendi rem debitis mollitia quia doloremque minus
                        numquam sint vero aliquam a, iure similique iste veniam vitae distinctio libero? Blanditiis eveniet,
                        autem officia cumque illo minima nostrum error voluptas delectus temporibus eum quae omnis debitis
                        quis a eaque corporis odio unde.</p>
                    <p class="mb-0 fw-medium fs-12"><span class="p-2 bg-second-10 text-color-secondary rounded-10">Basic</span></p>
                </div>
            </div>
        </a>
    </section>
@endsection
