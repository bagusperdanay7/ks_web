@extends('layouts.main')

@section('content')
    <section id="verification information">
        @if (session()->has('success'))
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-lg-8 col-xl-6">
                    <div class="verification-container text-center rounded-10">
                        <i class="las la-envelope-open fs-1 text-color-100"></i>
                        <h3 class="mt-10 text-color-100 fw-semibold">Verify Your Email</h3>
                        <p class="text-color-100 fs-14">{{ session('success') }}</p>
                        <p class="text-color-100 fs-14">Click the link or button in the email to verify your account</p>
                        <p class="text-color-100 fs-14 fw-medium mb-10">Already checked the email and clicked verify?
                            <a href="{{ route('login') }}" class="text-color-secondary">Please Login</a>
                        </p>
                    </div>
                </div>
            </div>
        @else
            <div class="row justify-content-center">
                <div class="col-6">
                    <a href="{{ route('login') }}" class="btn btn-outline-main col-12">Go Back</a>
                </div>
            </div>
        @endif
    </section>
@endsection
