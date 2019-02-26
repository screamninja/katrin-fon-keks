@extends('layouts.master')
@section('title', 'О нас')
@section('header_class', 'page-header')

@section('nav')

    @include('includes.nav')

@endsection

@section('content')

    <div class="container">
        <div class="content">
            <div class="content-text">
                <p class="content-top-p">Новинка</p>
                <p class="content-large-text">О нас</p>
                <p class="content-info">Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст
                    Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст
                    Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст
                    Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст
                    Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст Текст</p>
                <p class="content-info">FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
                    FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
                    FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFfFFf</p>
            </div>
        </div>
    </div>

    @include('includes.newitems')

@endsection
