@extends('layouts.main')
{{-- 
    https://www.w3schools.com/tags/tag_meta.asp
    https://getbootstrap.com/docs/5.3/forms/validation/
    https://www.youtube.com/watch?v=Wf7RliwJxj4&list=PLFIM0718LjIWiihbBIq-SWPU6b6x21Q_2&index=14&t=79s
    https://alertifyjs.com/guide.html --}}
@section('container')
    <section id="login">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8 col-xl-6">
                    <div class="form-container">
                        <h3 class="text-center m-0">Login</h3>
                        <div class="row justify-content-center align-items-center m-0">
                            <form class="mt-30 col-12 col-md-8 p-0">
                                <div class="mb-15">
                                    <label for="email" class="form-label text-mdm-18">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        aria-describedby="emailHelp" placeholder="example@gmail.com" required>
                                </div>
                                <div class="mb-30">
                                    <label for="password" class="form-label text-mdm-18">Password</label>
                                    <div class="input-group input-password">
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Enter Your Password" aria-describedby="password-icon" required>
                                        <span class="input-group-text"><i class="las la-eye password-icon"></i></span>
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
        </div>
    </section>
@endsection
