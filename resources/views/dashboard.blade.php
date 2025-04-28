@extends('adminlte::page')

@section('title', 'DIET, CHAMPHAI')

@section('content_header')
    <h1>Dashboard : {{ Auth::user()->role }}</h1>
@stop

@section('content')
    <p>Welcome to DIET, Champhai App</p>
    <hr>
    @include('layout.alert')
    <div class="container">
        <div class="row">

        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("DIET, Champhai"); </script>
@stop
