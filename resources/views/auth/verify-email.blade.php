@extends('layouts.main')
@if (session()->has('message'))
    <div class="container">
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast-container top-0 end-0 p-0" style="margin-top: 80px">
                <div class="toast show rounded-10" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-success-10 text-color-100 rounded-top-8">
                        <strong class="me-auto"><i class="las la-check-circle text-color-hs fs-18"></i> Kpop
                            Soulmate</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body bg-success-10 fs-14 font-inter text-color-100 rounded-bottom-8">
                        {{ session('message') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@section('content')
    <section id="verify-email">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-lg-8 col-xl-6">
                <div class="verification-container rounded-10">
                    <i class="las la-envelope-open fs-1 text-color-100 text-center d-block"></i>
                    <h3 class="mt-10 text-color-100 fw-semibold text-center">Resend Verification Email</h3>
                    <div class="mb-2">
                        <label for="email" class="form-label fs-18 fw-medium text-color-100">Email</label>
                        <input type="email" class="form-control {{ Auth::user()->hasVerifiedEmail() === true ? 'is-valid' : 'is-invalid'}}" id="email"
                            name="email" aria-describedby="emailHelp" placeholder="Your Email"
                            value="{{ auth()->user()->email }}" readonly>
                    </div>
                    @if (Auth::user()->hasVerifiedEmail() === false)
                        <p class="text-color-alert fs-14"><i class="las la-exclamation-triangle"></i> Your account needs verification. If our letter isn't seen in your spam or inbox. Please click the "Resend Email" button to initiate the verification process</p>
                    @else
                        <p class="text-color-100 fs-14">Your account has been verified</p>
                    @endif
                    
                    <form action="{{ route('verification.send') }}" method="post">
                        @csrf
                        <button class="btn btn-main fs-14 col-12" {{ Auth::user()->hasVerifiedEmail() === true ? 'disabled' : ''}}>Resend Email</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
