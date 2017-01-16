@extends('app')
@section('title','ISpace Community')
@section('header-css')
    <link rel="stylesheet" href="/css/favorite.css">
    <style>
        body {
            background: #f5f5f1;
        }
    </style>
@endsection
@section('content')
    @include('common.favorites_nav_header')
    <div class="favorite-section-content"></div>
@endsection
@section('footer-js')
    <script>
        $(document).ready(function () {
            $('#favorite-articles-link').addClass('active');
        });
    </script>
@endsection