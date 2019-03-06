@extends('layouts.recipes')
@section('title')
    {{ $user->name }}
@endsection
@section('header_class', 'page-header')

@section('nav')
    @include('includes.nav')
@endsection
@section('content')
    <div class="container">
        <ul class="list-group">
            <li class="list-group-item">
                Присоеденился {{$user->created_at->format('d.m.Y в H:i') }}
            </li>
            <li class="list-group-item panel-body">
                <table class="table-padding">
                    <style>.table-padding td { padding: 3px 8px; }</style>
                    <tr>
                        <td>Всего рецептов</td>
                        <td> {{$recipes_count}}</td>
                        @if($author && $recipes_count)
                            <td><a href="{{ url('cookbook/all-recipes')}}">Показать все</a></td>
                        @endif
                    </tr>
                    <tr>
                        <td>Опубликованные рецепт</td>
                        <td>{{$recipes_privacy_count}}</td>
                        @if($recipes_privacy_count)
                            <td><a href="{{ url('/user/'.$user->id.'/recipes')}}">Показать все</a></td>
                        @endif
                    </tr>
                    <tr>
                        <td>Приватных рецептов</td>
                        <td>{{$recipes_draft_count}}</td>
                        @if($author && $recipes_draft_count)
                            <td><a href="{{ url('cookbook/my-private-recipes')}}">Показать все</a></td>
                        @endif
                    </tr>
                    <tr>
                        <td>Всего комментариев</td>
                        <td>{{$comments_count}}</td>
                    </tr>
                </table>
            </li>
        </ul>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><h3>Мои последние рецепты</h3></div>
        <div class="panel-body">
            @if(!empty($latest_recipes[0]))
                @foreach($latest_recipes as $latest_recipe)
                    <p>
                        <strong><a href="{{ url('/'.$latest_recipe->slug) }}">{{ $latest_recipe->title }}</a></strong>
                        <span class="well-sm">от {{ $latest_recipe->created_at->format('d.m.Y в H:i') }}</span>
                    </p>
                @endforeach
            @else
                <p>У Вас ещё нет рецептов</p>
            @endif
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><h3>Мои последние комментарии</h3></div>
        <div class="list-group">
            @if(!empty($latest_comments[0]))
                @foreach($latest_comments as $latest_comment)
                    <div class="list-group-item">
                        <p>{{ $latest_comment->body }}</p>
                        <p>от {{ $latest_comment->created_at->format('d.m.Y в H:i') }} к рецепту <a
                                    href="{{ url('/'.$latest_comment->recipe->slug) }}">{{ $latest_comment->recipe->title }}</a>
                        </p>
                    </div>
                @endforeach
            @else
                <div class="list-group-item">
                    <p>У Вас нет комментариев. Ваши последние 5 комментариев будут выведены здесь.</p>
                </div>
            @endif
        </div>
    </div>
@endsection