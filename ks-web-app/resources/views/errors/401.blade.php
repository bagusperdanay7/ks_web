@extends('errors.layout')

@section('title', __('Unauthorized'))
@section('illustration')
<img src="{{ asset('img/401.svg') }}" alt="Illustration UnAthorized" class="img-fluid">
@endsection
@section('heading', '401 Unauthorized')
@section('message', __('Unauthorized'))