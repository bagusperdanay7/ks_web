@extends('layouts.main')

@section('content')
    <section id="sign-up">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-lg-8 col-xl-6">
                <div class="verification-container text-center rounded-10">
                    @if (session()->has('success'))
                        <i class="las la-envelope-open fs-1 text-color-100"></i>
                        <h3 class="mt-10 text-color-100 fw-semibold">Verify Your Email</h3>
                        <p class="text-color-100 fs-14">{{ session('success') }}</p>
                        <p class="text-color-100 fs-14">Click the link or button in the email to verify your account</p>
                        <p class="text-color-100 fs-14 fw-medium mb-10">Already checked the email and clicked verify? <a
                                href="{{ route('login') }}" class="text-color-secondary">Please Login</a></p>
                        <form action="{{ route('verification.send') }}" method="post">
                            @csrf
                            <p class="text-color-100 fs-14 fw-medium mb-10">Didn't receive the email yet?</p>
                            <button class="btn btn-main col-12">Resend Email</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-main col-12">Go Back</a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
