@extends('errors.layout')

@section('title', __('Page Expired'))
@section('illustration')
<img src="{{ asset('img/419.svg') }}" alt="Illustration Page Expired" class="img-fluid">
@endsection
@section('heading', '419 Page Expired')
@section('message', __('Page Expired'))
