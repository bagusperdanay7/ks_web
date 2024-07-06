@extends('errors.layout')

@section('title', __('Service Unavailable'))
@section('illustration')
    <img src="{{ asset('img/503.svg') }}" alt="Illustration Unavailable" class="img-fluid">
@endsection
@section('heading', __('503 Service Unavailable'))
@section('message', __('Service Unavailable'))
