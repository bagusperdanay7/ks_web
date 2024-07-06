@extends('errors.layout')

@section('title', __('Payment Required'))
@section('illustration')
    <img src="{{ asset('img/402.svg') }}" alt="Illustration Payment Required" class="img-fluid">
@endsection
@section('heading', '402 Payment Required')
@section('message', __('Payment Required'))
