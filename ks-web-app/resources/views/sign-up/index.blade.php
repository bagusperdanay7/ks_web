@extends('layouts.main')
@if (session()->has('success'))
    <div class="container">
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast-container top-0 end-0" style="margin-top: 75px">
                <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-success-10 text-color-100">
                        <strong class="me-auto"><i class="las la-check-circle text-success-100 fs-18"></i> Kpop
                            Soulmate</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body bg-success-10 fs-inter-14 text-color-100">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@section('content')
    <section id="sign-up">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 col-xl-6">
                <div class="form-container">
                    <h3 class="text-center fw-bold text-color-100 m-0">Create Account</h3>
                    <div class="row justify-content-center align-items-center m-0">
                        <form action="{{ route('sign-up-post') }}" class="mt-30 col-12 col-md-8 p-0" method="POST">
                            @csrf
                            <div class="mb-15">
                                <label for="email" class="form-label fs-18 fw-medium text-color-100">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" aria-describedby="emailHelp"
                                    placeholder="example@gmail.com" value="{{ old('email') }}" required>
                                @error('email')
                                    <div id="emailValidationFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-15">
                                <label for="username" class="form-label fs-18 fw-medium text-color-100">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    name="username" id="username" placeholder="Enter Your Username"
                                    value="{{ old('username') }}" required>
                                @error('username')
                                    <div id="usernameValidationFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-15">
                                <label for="name" class="form-label fs-18 fw-medium text-color-100">Name</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    placeholder="Enter Your Name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div id="nameValidationFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-15">
                                <label for="password" class="form-label fs-18 fw-medium text-color-100">Password</label>
                                <div class="input-group input-password">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Enter Your Password"
                                        aria-describedby="password-help" required>
                                    <span class="input-group-text"><i class="las la-eye password-icon"></i></span>
                                    @error('password')
                                        <div id="passwordValidationFeedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-30">
                                <label for="confirm-password" class="form-label fs-18 fw-medium text-color-100">Confirm
                                    Password</label>
                                <div class="input-group input-confirm-password">
                                    <input type="password"
                                        class="form-control @error('confirm-password') is-invalid @enderror"
                                        id="confirm-password" name="confirm-password"
                                        placeholder="Enter Your Password Again" aria-describedby="password-confirm-icon"
                                        required>
                                    <span class="input-group-text">
                                        <i class="las la-eye password-confirm-icon"></i>
                                    </span>
                                    @error('confirm-password')
                                        <div id="confirmPasswordValidationFeedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary-form col-12">Sign Up</button>
                            <p class="mt-15 mb-15 text-center text-color-100">or</p>
                            <a href="{{ route('login') }}" class="btn btn-secondary-form col-12">Login</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
