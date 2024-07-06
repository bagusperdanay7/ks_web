@extends('errors.layout')

@section('title', __('Too Many Requests'))
@section('illustration')
<img src="{{ asset('img/429.svg') }}" alt="Illustration Too Many Requeste" class="img-fluid">
@endsection
@section('heading', '429 Too Many Requests')
@section('message', __('We appreciate how excited you are to make requests. You have made much too many requests, though. Kindly give it another go later.'))
