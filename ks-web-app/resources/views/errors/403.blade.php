@extends('errors.layout')

@section('title', __('Forbidden'))
@section('illustration')
<img src="{{ asset('img/403.svg') }}" alt="Illustration Forbidden" class="img-fluid">
@endsection
@section('heading', '403 Forbidden')
@section('message', __($exception->getMessage() ?: 'Forbidden'))

