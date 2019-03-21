@extends('layouts.master')
@section('title')
    {{ $title }}
@endsection
@section('header_class', 'page-header')
@section('nav')
    @include('includes.nav')
@endsection
@section('content')
    {{--Recipes--}}
    @if ( !$recipes->count() )
        <div class="container content">Рецептов пока нет...</div>
    @else
        <div class="container content">
            <h2 style="text-align: center">Рецепты от Катрин фон Кекс</h2>
            @foreach( $recipes as $recipe )
                <div class="list-group">
                    <div class="list-group-item">
                        <h3><a href="{{ url('/'.$recipe->slug) }}">{{ $recipe->title }}</a>
                            @if(!Auth::guest())
                                @if($recipe->active === '1')
                                    <button class="btn" style="float: right"><a
                                                href="{{ url('cookbook/edit/'.$recipe->slug)}}">Редактировать
                                            рецепт</a></button>
                                @else
                                    <button class="btn" style="float: right"><a
                                                href="{{ url('cookbook/edit/'.$recipe->slug)}}">Редактировать
                                            рецепт</a></button>
                                @endif
                            @endif
                        </h3>
                        <p>{{ $recipe->created_at->format('d.m.Y в\ H:i') }} - Автор:
                            @if(!Auth::guest())
                                <a href="{{ url('/user/'.$recipe->author_id)}}">{{ $recipe->author->name }}</a>
                            @else
                                <a href="{{ url('/user/'.$recipe->author_id.'/recipes')}}">{{ $recipe->author->name }}</a>
                            @endif
                        </p>
                    </div>
                    <div class="list-group-item">
                        <article>
                            {!! str_limit($recipe->body, $limit = 1500, $end = '....... <a href='.url('cookbook/'.$recipe->slug).'>Подробнее</a>') !!}
                        </article>
                    </div>
                </div>
            @endforeach
            @endif
                {{ $recipes->links() }}
        </div>
        @include('includes.newitems')
@endsection
