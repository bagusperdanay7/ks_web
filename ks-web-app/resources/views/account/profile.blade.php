@extends('layouts.main')
@if (session()->has('success'))
    <div class="container">
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast-container top-0 end-0 p-0" style="margin-top: 80px">
                <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-success-10 text-color-100">
                        <strong class="me-auto"><i class="las la-check-circle text-color-hs fs-18"></i> Kpop
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

@if (session()->has('errorOldpassword'))
    <div class="container">
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast-container top-0 end-0 p-0" style="margin-top: 80px">
                <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-alert-10 text-color-100">
                        <strong class="me-auto"><i class="las la-exclamation-circle text-color-alert fs-18"></i> Kpop
                            Soulmate</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body bg-alert-10 fs-inter-14 text-color-100">
                        {{ session('errorOldpassword') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if (session()->has('successChangePassword'))
    <div class="container">
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast-container top-0 end-0 p-0" style="margin-top: 80px">
                <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-success-10 text-color-100">
                        <strong class="me-auto"><i class="las la-check-circle text-color-hs fs-18"></i> Kpop
                            Soulmate</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body bg-success-10 fs-inter-14 text-color-100">
                        {{ session('successChangePassword') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@section('content')
    <section id="profile" class="mb-50">
        <h2 class="mb-15 fw-bold text-color-100">My Profile</h2>
        <div class="row">
            <div class="col-12 col-lg-7 col-xl-8 order-2 order-lg-1">
                <div class="profile-container border">
                    <form action="{{ route('account.update') }}" method="post" class="col-12 p-0">
                        @method('put')
                        @csrf
                        <h3 class="fw-semibold text-color-100 mb-30">Account Information</h3>
                        <div class="mb-15">
                            <label for="name" class="form-label fs-18 fw-medium text-color-100">Name</label>
                            <input type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" aria-describedby="name_Help"
                                placeholder="Enter your name" value="{{ auth()->user()->name }}" required>
                            @error('name')
                                <div id="name_Help" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-15">
                            <label for="username" class="form-label fs-18 fw-medium text-color-100">Username</label>
                            <input type="text"
                                class="form-control @error('username') is-invalid @enderror"
                                id="username" name="username" aria-describedby="usernameHelp"
                                placeholder="Enter your Username" value="{{ auth()->user()->username }}" required>
                            @error('username')
                                <div id="usernameHelp" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-30">
                            <label for="email" class="form-label fs-18 fw-medium text-color-100">Email</label>
                            <input type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" aria-describedby="emailHelp"
                                placeholder="Your Email" value="{{ auth()->user()->email }}" disabled readonly>
                            @error('email')
                                <div id="emailHelp" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-main px-4">Save Profile</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-lg-5 col-xl-4 order-1 order-lg-2 mb-0 mb-4 mb-lg-0">
                <div class="profile-container border">
                    <div class="d-flex flex-column flex-sm-row align-items-sm-center mb-15">
                        @if (auth()->user()->profile_picture === null)
                            <div class="flex-shrink-0  mb-2 mb-sm-0">
                                <img src="{{ asset('img/user-default.png') }}" class="rounded-circle"
                                    alt="User Profile Picture" width="100px">
                            </div>
                        @elseif (str_starts_with(auth()->user()->profile_picture, 'https://lh3.googleusercontent.com'))
                            <div class="flex-shrink-0  mb-2 mb-sm-0">
                                <img src="{{ auth()->user()->profile_picture }}" class="rounded-circle "
                                    alt="User Profile Picture" width="100px">
                            </div>
                        @else
                            <div class="flex-shrink-0  mb-2 mb-sm-0">
                                <img src="{{ asset('img/user/') }} {{ auth()->user()->profile_picture }}"
                                    class="rounded-circle " alt="User Profile Picture" width="100px">
                            </div>
                        @endif

                        <div class="flex-grow-1 ms-0 ms-sm-3">
                            <h4 class="text-color-100 mb5">{{ auth()->user()->name }}</h4>
                            <p class="text-color-80 mb5">{{ auth()->user()->email }}</p>
                            @if (auth()->user()->google_id !== null)
                                <p class="fs-14 m-0 text-color-100">Linked to <img class="img-fluid" width="40px" src="{{ asset('img/google.png') }}" alt="google linked"></p>
                            @endif
                        </div>
                    </div>
                    <input class="form-control-file" type="file" id="picture_profile"
                                accept="image/*" name="picture_profile">
                    <span class="d-block mt-2 fw-medium text-color-100 fs-14">JPEG, PNG, or GIF. Max Size 1 MB</span>
                </div>
            </div>
        </div>
    </section>

    <section id="password-information">
        <div class="row">
            <div class="col-12 col-lg-7 col-xl-8">
                <div class="profile-container border">
                    <form action="{{ route('password.change') }}" method="post" class="col-12 p-0">
                        @method('put')
                        @csrf
                        <h3 class="fw-semibold text-color-100 mb-30">Change Password</h3>
                        <div class="mb-15">
                            <label for="old-password" class="form-label fs-18 fw-medium text-color-100">Old Password</label>
                            <div class="input-group input-old-password">
                                <input type="password" class="form-control @error('old-password') is-invalid @enderror"
                                    id="old-password" name="old-password" placeholder="Enter Your old password" required>
                                <span class="input-group-text"><i class="las la-eye old-password-icon"></i></span>
                                @error('old-password')
                                    <div id="oldPasswordValidationFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-15">
                            <label for="password" class="form-label fs-18 fw-medium text-color-100">New Password</label>
                            <div class="input-group input-confirm-password">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Enter Your New password" required>
                                <span class="input-group-text"><i class="las la-eye password-confirm-icon"></i></span>
                                @error('password')
                                    <div id="passwordValidationFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-30">
                            <label for="confirm-password" class="form-label fs-18 fw-medium text-color-100">Confirm New Password</label>
                            <div class="input-group input-password">
                                <input type="password" class="form-control @error('confirm-password') is-invalid @enderror"
                                    id="confirm-password" name="confirm-password" placeholder="Enter Your Confirm New password" required>
                                <span class="input-group-text"><i class="las la-eye password-icon"></i></span>
                                @error('confirm-password')
                                    <div id="confirmPasswordValidationFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-main px-4">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection