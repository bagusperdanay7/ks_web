@extends('errors.layout')

@section('title', __('Server Error'))
@section('illustration')
    <img src="{{ asset('img/500.svg') }}" alt="Illustration Server Error" class="img-fluid">
@endsection
@section('heading', '500 Server Error')
@section('message', __('Server Error'))
