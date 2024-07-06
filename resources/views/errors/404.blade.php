@extends('errors.layout')

@section('title', __("Page Doesn't Exist"))
@section('illustration')
    <img src="{{ asset('img/404.svg') }}" alt="Illustration Not Found" class="img-fluid">
@endsection
@section('heading', '404 Not Found')
@section('message', __("The page you are looking for doesn't exist!"))
