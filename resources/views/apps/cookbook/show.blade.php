@extends('layouts.recipes')
@section('title')
    @if($recipe)
        {{ $recipe->title }}
    @else
        Страница не существует
    @endif
@endsection
@section('header_class', 'page-header')

@section('nav')
    @include('includes.nav')
@endsection

@section('title-meta')
    <p>{{ $recipe->created_at->format('M d,Y \a\t h:i a') }} Автор:
        @if(!Auth::guest())
            <a href="{{ url('/user/'.$recipe->author_id)}}">{{ $recipe->author->name }}</a>
        @else
            <a href="{{ url('/user/'.$recipe->author_id.'/recipes')}}">{{ $recipe->author->name }}</a>
        @endif
    </p>
@endsection

@section('content')
    @if(!Auth::guest() && ($recipe->author_id === Auth::user()->id || Auth::user()->isAdmin()))
        <button class="btn" style="float: right"><a
                    href="{{ url('cookbook/edit/'.$recipe->slug)}}">Редактировать рецепт</a></button>
    @endif
    @if($recipe)
        <div>
            {!! $recipe->body !!}
        </div>
        <div>
            <h2>Комментарии</h2>
        </div>
        @if(Auth::guest())
            <p><a href="/login">Войдите</a> под своей учётной записью, чтобы оставить комментарий</p>
        @else
            <div class="panel-body">
                <form method="post" action="{{ url('cookbook/comment/add') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="on_recipe" value="{{ $recipe->id }}">
                    <input type="hidden" name="slug" value="{{ $recipe->slug }}">
                    <div class="form-group">
                        <textarea required="required" placeholder="Введите свой комментарий" name="body"
                                  class="form-control"></textarea>
                    </div>
                    <input type="submit" name='recipe_comment' class="btn btn-success" value="Опубликовать"/>
                </form>
            </div>
        @endif
        <div>
            @if($comments)
                <ul style="list-style: none; padding: 0">
                    @foreach($comments as $comment)
                        <li class="panel-body">
                            <div class="list-group">
                                <div class="list-group-item">
                                    <h3>{{ $comment->author->name }}</h3>
                                    <p>{{ $comment->created_at->format('d.m.Y в\ H:i') }}</p>
                                </div>
                                <div class="list-group-item">
                                    <p>{{ $comment->body }}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    @else
        Ошибка 404.

        Что-то пошло не так... :(
    @endif
@endsection