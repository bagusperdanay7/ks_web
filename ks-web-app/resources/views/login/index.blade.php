@extends('layouts.main')
{{-- 
    https://getbootstrap.com/docs/5.3/forms/validation/
    https://alertifyjs.com/guide.html --}}
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
                            <div class="mb-30">
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
                            <button type="submit" class="btn btn-primary-form col-12">Login</button>
                            <p class="mt-15 mb-15 text-center">or</p>
                            <a href="" class="btn btn-border-form col-12 mb-15">Login With Google</a>
                            <a href="{{ route('sign-up') }}" class="btn btn-secondary-form col-12">Sign Up</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
