@extends('layouts.main')
@if (session()->has('message'))
    <div class="container">
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast-container top-0 end-0" style="margin-top: 75px">
                <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-warning-10">
                        <strong class="me-auto"> <i class="las la-exclamation-circle text-warning fs-18"></i>
                            Kpop
                            Soulmate</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body bg-warning-10 fs-inter-14 text-color-100">
                        {{ session('message') }}
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
                    <h3 class="text-center m-0 fw-bold text-color-100">Create New Password</h3>
                    <div class="row justify-content-center align-items-center m-0">
                        <form action="{{ route('password.update') }}" method="POST" class="mt-30 col-12 col-md-8 p-0">
                            @csrf
                            <div class="mb-0">
                                <input type="hidden"
                                    class="form-control @error('token') is-invalid @enderror"
                                    id="token" name="token" aria-describedby="tokenHelp" value="{{ $token }}" required>
                                @error('token')
                                    <div id="tokenValidationFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-15">
                                <label for="email" class="form-label fs-18 fw-medium text-color-100">Email</label>
                                <input type="email"
                                    class="form-control @error('email') is-invalid @enderror"
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
                            <div class="mb-30">
                                <label for="password_confirmation" class="form-label fs-18 fw-medium text-color-100">Confirm
                                    Password</label>
                                <div class="input-group input-confirm-password">
                                    <input type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        id="password_confirmation" name="password_confirmation"
                                        placeholder="Enter Your Password Again" aria-describedby="password-confirm-icon"
                                        required>
                                    <span class="input-group-text">
                                        <i class="las la-eye password-confirm-icon"></i>
                                    </span>
                                    @error('password_confirmation')
                                        <div id="confirmPasswordValidationFeedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary-form col-12">Reset Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
