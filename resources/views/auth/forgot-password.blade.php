@extends('layouts.main')

@if (session()->has('status'))
    <div class="container">
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast-container top-0 end-0" style="margin-top: 75px">
                <div class="toast show rounded-10" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-success-10 rounded-top-8">
                        <strong class="me-auto"> <i class="las la-check-circle text-success fs-18"></i>
                            Kpop
                            Soulmate</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body bg-success-10 fs-14 font-inter text-color-100 rounded-bottom-8">
                        {{ session('status') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@section('content')
    <section id="forgot-password">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 col-xl-6">
                <div class="form-container">
                    <h3 class="text-center m-0 fw-bold text-color-100">Reset Password</h3>
                    <div class="row justify-content-center align-items-center m-0">
                        <form action="{{ route('password.email') }}" method="POST" class="mt-30 col-12 col-md-8 p-0">
                            @csrf
                            <div class="mb-30">
                                <label for="email" class="form-label fs-14 text-color-100">Please enter your email
                                    address to proceed. We'll send you an email to reset your password. If your account is <strong>Linked to Google</strong>. Please return to the <a href="{{ route('login') }}" class="text-decoration-none text-color-secondary">login page</a>, and click Login with Google instead.</label>
                                <input type="email"
                                    class="form-control @error('email') is-invalid @enderror @error('password') is-invalid @enderror"
                                    id="email" name="email" aria-describedby="emailHelp"
                                    placeholder="example@gmail.com" value="{{ old('email') }}" required autofocus>
                                @error('email')
                                    <div id="emailValidationFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary-form col-12">Send Link</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
