@extends('layouts.main')
@if (session()->has('message'))
    <div class="container">
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast-container top-0 end-0" style="margin-top: 75px">
                <div class="toast show rounded-10" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-warning-subtle rounded-top-8">
                        <strong class="me-auto"> <i class="las la-exclamation-circle text-warning fs-18"></i>
                            Kpop
                            Soulmate</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body bg-warning-subtle fs-14 font-inter text-color-100 rounded-bottom-8">
                        {{ session('message') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if (session()->has('status'))
    <div class="container">
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast-container top-0 end-0" style="margin-top: 75px">
                <div class="toast show rounded-10" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-success-subtle rounded-top-8">
                        <strong class="me-auto"> <i class="las la-check-circle text-success fs-18"></i>
                            Kpop
                            Soulmate</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body bg-success-subtle fs-14 font-inter text-color-100 rounded-bottom-8">
                        {{ session('status') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if (session()->has('loginError'))
    <div class="container">
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast-container top-0 end-0" style="margin-top: 75px">
                <div class="toast show rounded-10" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-warning-subtle rounded-top-8">
                        <strong class="me-auto"> <i class="las la-exclamation-circle text-warning fs-18"></i>
                            Kpop
                            Soulmate</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body bg-warning-subtle fs-14 font-inter text-color-100 rounded-bottom-8">
                        {{ session('loginError') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@section('content')
    <section id="login">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 col-xl-6">
                <div class="form-container">
                    <h3 class="text-center m-0 fw-bold text-color-100">Login</h3>
                    <div class="row justify-content-center align-items-center m-0">
                        <form action="{{ route('login-post') }}" method="POST" class="mt-30 col-12 col-md-8 p-0">
                            @csrf
                            <div class="mb-15">
                                <label for="email" class="form-label fs-18 fw-medium text-color-100">Email</label>
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
                            <div class="mb-15">
                                <label for="password" class="form-label fs-18 fw-medium text-color-100">Password</label>
                                <div class="input-group input-password">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Enter Your Password" required>
                                    <span class="input-group-text"><i class="las la-eye password-icon"></i></span>
                                    @error('password')
                                        <div id="passwordValidationFeedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-30 text-end">
                                <a href="{{ route('password.request') }}"
                                    class="fs-14 text-color-primary fw-medium text-underline-hover">Forgot Password?</a>
                            </div>
                            <button type="submit" class="btn btn-primary-form col-12">Login</button>
                            <p class="mt-15 mb-15 text-center">or</p>
                            <a href="{{ route('google.login') }}" class="btn btn-border-form col-12 mb-15"><i
                                    class="bx bxl-google fs-24 align-middle"></i> Login With Google</a>
                            <a href="{{ route('sign-up') }}" class="btn btn-secondary-form col-12">Sign Up</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
