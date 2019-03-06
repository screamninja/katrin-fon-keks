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
            @foreach( $recipes as $recipe )
                <div class="list-group">
                    <div class="list-group-item">
                        <h3><a href="{{ url('/'.$recipe->slug) }}">{{ $recipe->title }}</a>
                            @if(!Auth::guest() && ($recipe->author_id === Auth::user()->id || Auth::user()->isAdmin()))
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
                            @if(!Auth::guest() && Auth::user()->canPublish())
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
            {{--Comments--}}
            @if(!empty($comments[0]))
                <h3>Последние комментарии:</h3>
                @foreach($comments as $comment)
                    <div class="list-group-item">
                        <p>{{ $comment->body }}</p>
                        <p>от <b>{{ $comment->author->name }}</b> {{ $comment->created_at->format('d.m.Y в H:i') }} к
                            рецепту <a
                                    href="{{ url('/'.$comment->recipe->slug) }}">{{ $comment->recipe->title }}</a>
                        </p>
                    </div>
                @endforeach
            @elseif(!isset($comments))
                <div hidden></div>
            @else
                <div>
                    <p>Пока никто не оставил комментариев. Последние 5 комментариев будут выведены здесь.</p>
                </div>
            @endif
        </div>
        @include('includes.newitems')
@endsection
