@extends('layouts.master')
@section('title', 'Катрин фон Кекс')
@section('header_class', 'page-header home-header')

@section('nav')
    @include('includes.nav')
@endsection

@section('front')
    @include('includes.front')
@endsection

@section('content')
    @include('includes.advantages')
    @include('includes.banners')
    @include('includes.newitems')
@endsection
