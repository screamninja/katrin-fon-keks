@extends('layouts.recipes')
@section('title')
    {{ $title }}
@endsection
@include('includes.header')
@section('content')
    @if ( !$recipes->count() )
        Рецептов пока нет...
    @else
        <div class="">
            @foreach( $recipes as $recipe )
                <div class="list-group">
                    <div class="list-group-item">
                        <h3><a href="{{ url('/cookbook/'.$recipe->slug) }}">{{ $recipe->title }}</a>
                            @if(!Auth::guest() && ($recipe->author_id === Auth::user()->id || Auth::user()->isAdmin()))
                                @if($recipe->active === '1')
                                    <button class="btn" style="float: right"><a href="{{ url('cookbook/edit/'.$recipe->slug)}}">Редактировать
                                            рецепт</a></button>
                                @else
                                    <button class="btn" style="float: right"><a href="{{ url('сщщлищщл/edit/'.$post->slug)}}">Редактировать
                                            черновик</a></button>
                                @endif
                            @endif
                        </h3>
                        <p>{{ $post->created_at->format('d.m.Y в\ H:i') }} - Автор: <a href="{{ url('/user/'.$recipe->author_id)}}">{{ $recipe->users->name }}</a></p>
                    </div>
                    <div class="list-group-item">
                        <article>
                            {!! str_limit($recipe->body, $limit = 1500, $end = '....... <a href='.url('cookbook/'.$recipe->slug).'>Подробнее</a>') !!}
                        </article>
                    </div>
                </div>
            @endforeach
            {!! $recipe->render() !!}
        </div>
    @endif
@endsection
