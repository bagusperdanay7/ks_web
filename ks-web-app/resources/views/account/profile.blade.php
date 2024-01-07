@extends('layouts.main')
@if (session()->has('updateSuccess'))
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
                        {{ session('updateSuccess') }}
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
                <div class="toast show rounded-10
                " role="alert" aria-live="assertive"
                    aria-atomic="true">
                    <div class="toast-header bg-alert-10 text-color-100 rounded-top-8">
                        <strong class="me-auto"><i class="las la-exclamation-circle text-color-alert fs-18"></i> Kpop
                            Soulmate</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body bg-alert-10 fs-14 font-inter text-color-100 rounded-bottom-8">
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
                <div class="toast show rounded-10" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-success-10 text-color-100 rounded-top-8">
                        <strong class="me-auto"><i class="las la-check-circle text-color-hs fs-18"></i> Kpop
                            Soulmate</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body bg-success-10 fs-14 font-inter text-color-100 rounded-bottom-8">
                        {{ session('successChangePassword') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if (session()->has('changeProfileSuccess'))
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
                        {{ session('changeProfileSuccess') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if (session()->has('errorSamePassword'))
    <div class="container">
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast-container top-0 end-0 p-0" style="margin-top: 80px">
                <div class="toast show rounded-10" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-warning-10 text-color-100 rounded-top-8">
                        <strong class="me-auto"><i class="las la-exclamation-circle text-color-warning fs-18"></i> Kpop
                            Soulmate</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body bg-warning-10 fs-14 font-inter text-color-100 rounded-bottom-8">
                        {{ session('errorSamePassword') }}
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
                <div class="profile-container">
                    <form action="{{ route('account.update') }}" method="post" class="col-12 p-0">
                        @method('put')
                        @csrf
                        <h3 class="fw-semibold text-color-100 mb-30">Account Information</h3>
                        <div class="mb-15">
                            <label for="name" class="form-label fs-18 fw-medium text-color-100">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" aria-describedby="name_Help" placeholder="Enter your name"
                                value="{{ auth()->user()->name }}" required>
                            @error('name')
                                <div id="name_Help" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-15">
                            <label for="username" class="form-label fs-18 fw-medium text-color-100">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
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
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" aria-describedby="emailHelp" placeholder="Your Email"
                                value="{{ auth()->user()->email }}" readonly>
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
                <div class="profile-container">
                    <div class="d-flex flex-column flex-sm-row align-items-sm-center mb-30">
                        @if (auth()->user()->profile_picture === null)
                            <div class="flex-shrink-0  mb-2 mb-sm-0">
                                <img src="{{ asset('img/user-default.png') }}" class="rounded-circle img-square"
                                    alt="User Profile" width="100px">
                            </div>
                        @elseif (str_starts_with(auth()->user()->profile_picture, 'https://lh3.googleusercontent.com'))
                            <div class="flex-shrink-0  mb-2 mb-sm-0">
                                <img src="{{ auth()->user()->profile_picture }}" class="rounded-circle img-square"
                                    alt="User Profile" width="100px">
                            </div>
                        @else
                            <div class="flex-shrink-0  mb-2 mb-sm-0">
                                <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}"
                                    class="rounded-circle img-square " alt="User Profile" width="100px">
                            </div>
                        @endif

                        <div class="flex-grow-1 ms-0 ms-sm-3">
                            <h4 class="text-color-100 mb5">{{ auth()->user()->name }}</h4>
                            <p class="text-color-80 mb5">{{ auth()->user()->email }}</p>
                            @if (auth()->user()->google_id !== null)
                                <p class="fs-14 m-0 text-color-100">Linked to <img class="img-fluid" width="40px"
                                        src="{{ asset('img/google.png') }}" alt="google linked"> <i class="las la-check text-color-primary"></i></p>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="col">
                            <button type="button" class="btn btn-upload-picture rounded-10 w-100" data-bs-toggle="modal"
                                data-bs-target="#uploadModal">
                                {{ auth()->user()->profile_picture == null ? 'Upload Picture' : 'Change Picture' }}
                            </button>
                        </div>

                        @if (auth()->user()->profile_picture)
                            <div class="col ms-2">
                                <button type="button" class="btn btn-remove-picture rounded-10 w-100"
                                    data-bs-toggle="modal" data-bs-target="#confirmRemoveProfileModal">Remove
                                    Profile</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="password-information">
        <div class="row">
            <div class="col-12 col-lg-7 col-xl-8">
                <div class="profile-container">
                    <form action="{{ route('password.change') }}" method="post" class="col-12 p-0 mb-0">
                        @method('put')
                        @csrf
                        <h3 class="fw-semibold text-color-100 mb-30">Change Password</h3>
                        <div class="mb-15">
                            <label for="old-password" class="form-label fs-18 fw-medium text-color-100">Old
                                Password</label>
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
                            <label for="confirm-password" class="form-label fs-18 fw-medium text-color-100">Confirm New
                                Password</label>
                            <div class="input-group input-password">
                                <input type="password"
                                    class="form-control @error('confirm-password') is-invalid @enderror"
                                    id="confirm-password" name="confirm-password"
                                    placeholder="Enter Your Confirm New password" required>
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

    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('account.profile.update') }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="modal-content bg-second">
                    <div class="modal-header">
                        <h3 class="modal-title text-color-100 fw-semibold" id="uploadModalLabel">Upload Profile</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-15">
                            <label for="profile_picture" class="form-label fw-medium text-color-100">Profile
                                Picture</label>
                            <input class="form-control mb5 @error('profile_picture') is-invalid @enderror" type="file"
                                id="profile_picture" name="profile_picture" accept="image/*"
                                onchange="previewPicture()">
                            @error('profile_picture')
                                <div id="profilePictureFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <span class="text-color-50 fs-14">File format must be JPEG, PNG, or GIF. Max Size 250 KB.
                                Recommended Aspect
                                ratio of picture is 1:1</span>
                        </div>
                        <div class="">
                            <label for="preview_picture" class="form-label fw-medium text-color-100">Preview</label>
                            <img class="d-block img-square rounded-circle img-fluid profile-preview m-top-5"
                                id="preview_picture">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-border" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-main fw-medium fs-14">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="confirmRemoveProfileModal" tabindex="-1"
        aria-labelledby="confirmDRemoveProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-second">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column align-items-center">
                        <i class="las la-trash-alt fs-4 text-color-ad rounded-circle p-2 bg-alert-10 mb-15"></i>
                        <h5 class="fw-semibold text-color-100 m-bottom-5">Remove Profile Picture</h5>
                        <p class="fs-14 text-color-80">Are you sure you want to remove the profile picture?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-border" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('account.profile.remove') }}" method="post" id="deleteForm">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-alert-color">Yes, Remove</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewPicture() {
            const profilePicture = document.querySelector('#profile_picture');
            const picturePreview = document.querySelector('.profile-preview');
            const blob = URL.createObjectURL(profilePicture.files[0]);
            picturePreview.src = blob;
        }
    </script>
@endsection
