@extends('layouts.main')
@section('content')
    <section id="my-requests" class="mb-50">
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
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" aria-describedby="emailHelp" placeholder="Your Email"
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
                <div class="profile-container border">
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
                                        src="{{ asset('img/google.png') }}" alt="google linked"></p>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="me-3">
                            <button type="button" class="btn btn-upload-picture" data-bs-toggle="modal"
                                data-bs-target="#uploadModal">
                                {{ auth()->user()->profile_picture == null ? 'Upload Picture' : 'Change Picture' }}
                            </button>
                        </div>

                        <div>
                            @if (auth()->user()->profile_picture)
                                <button type="button" class="btn btn-remove-picture" data-bs-toggle="modal"
                                    data-bs-target="#confirmRemoveProfileModal">Remove Profile</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
