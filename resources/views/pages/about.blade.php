@extends('layouts.master')
@section('title', 'О нас')
@section('header_class', 'page-header')

@section('nav')

    @include('includes.nav')

@endsection

@section('content')

    <div class="about">
        <h3>О нас</h3>
        <p class="discription">
            Здесь пока ничего нет...
        </p>
    </div>

    @include('includes.newitems')

@endsection
