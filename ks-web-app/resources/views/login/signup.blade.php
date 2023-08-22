@extends('layouts.main')
@section('container')
    <section id="sign-up">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8 col-xl-6">
                    <div class="form-container">
                        <h3 class="text-center m-0">Create Account</h3>
                        <div class="row justify-content-center align-items-center m-0">
                            <form class="mt-30 col-12 col-md-8 p-0">
                                <div class="mb-15">
                                    <label for="email" class="form-label text-mdm-18">Email</label>
                                    <input type="email" class="form-control" id="email" name="text"
                                        aria-describedby="emailHelp" placeholder="example@gmail.com" required>
                                </div>
                                <div class="mb-15">
                                    <label for="username" class="form-label text-mdm-18">Username</label>
                                    <input type="text" class="form-control" id="username"
                                        placeholder="Enter Your Username" required>
                                </div>
                                <div class="mb-15">
                                    <label for="name" class="form-label text-mdm-18">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter Your Name"
                                        required>
                                </div>
                                <div class="mb-15">
                                    <label for="password" class="form-label text-mdm-18">Password</label>
                                    <div class="input-group input-password">
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Enter Your Password" aria-describedby="password-icon" required>
                                        <span class="input-group-text"><i class="las la-eye password-icon"></i></span>
                                    </div>
                                </div>
                                <div class="mb-30">
                                    <label for="confirm-password" class="form-label text-mdm-18">Confirm Password</label>
                                    <div class="input-group input-confirm-password">
                                        <input type="password" class="form-control" id="confirm-password"
                                            name="confirm-password" placeholder="Enter Your Password Again"
                                            aria-describedby="password-confirm-icon" required>
                                        <span class="input-group-text">
                                            <i class="las la-eye password-confirm-icon"></i>
                                        </span>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary-form col-12">Sign Up</button>
                                <p class="mt-15 mb-15 text-center">or</p>
                                <a href="{{ route('login') }}" class="btn btn-secondary-form col-12">Login</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
