@extends('errors.layout')

@php
$error_number = 404;
@endphp

@section('title')
Page not found.
@endsection

@section('description')
@php
$default_error_message = "Please <a href='javascript:history.back()''>go back</a> or return to <a href='".url('')."'>our homepage</a>.";
  @endphp
  {!! $default_error_message !!}
@endsection