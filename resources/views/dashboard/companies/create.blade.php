@extends('dashboard.layouts.main')
@section('content')
    <section id="company-single-dashboard">
        <div class="row m-bottom-25 justify-content-center">
            <div class="col-md-8 col-12">
                <div class="form-container ">
                    <h4 class="fw-bold m-bottom-30 text-center text-color-100">Create Company Form</h4>
                    <form method="post" action="{{ route('companies.store') }}">
                        @csrf
                        <div class="m-bottom-15">
                            <label for="name" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" placeholder="Enter Company name" value="{{ old('name') }}">
                            @error('name')
                                <div id="nameFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="button-grouping text-end">
                            <a href="{{ route('companies.index') }}" class="btn btn-light-border m-right-15">Cancel</a>
                            <button type="submit" class="btn btn-primary-color px-4">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
