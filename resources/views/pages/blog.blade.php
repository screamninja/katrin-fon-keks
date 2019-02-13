@extends('layouts.posts')
@section('title')
    {{ $title }}
@endsection
@include('includes.header')
@section('content')
    @if ( !$posts->count() )
        Ещё нет постов. Ввойдите и напишите новый пост!
    @else
        <div class="">
            @foreach( $posts as $post )
                <div class="list-group">
                    <div class="list-group-item">
                        <h3><a href="{{ url('/blog/'.$post->slug) }}">{{ $post->title }}</a>
                            @if(!Auth::guest() && ($post->author_id === Auth::user()->id || Auth::user()->isAdmin()))
                                @if($post->active === '1')
                                    <button class="btn" style="float: right"><a href="{{ url('blog/edit/'.$post->slug)}}">Редактировать
                                            пост</a></button>
                                @else
                                    <button class="btn" style="float: right"><a href="{{ url('blog/edit/'.$post->slug)}}">Редактировать
                                            черновик</a></button>
                                @endif
                            @endif
                        </h3>
                        <p>{{ $post->created_at->format('d.m.Y в\ H:i') }} - Автор: <a href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->name }}</a></p>
                    </div>
                    <div class="list-group-item">
                        <article>
                            {!! str_limit($post->body, $limit = 1500, $end = '....... <a href='.url("blog/".$post->slug).'>Подробнее</a>') !!}
                        </article>
                    </div>
                </div>
            @endforeach
            {!! $posts->render() !!}
        </div>
    @endif
@endsection
