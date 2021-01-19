@extends('layout')
@section("header")
    @include('header')
@endsection

@section('main_content')
    <h1>Welcome</h1>
    <h1>{{$weather}}</h1>
@endsection