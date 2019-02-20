@extends('layouts.master')
@section('title')
    {{ $user->name }}
@endsection
@section('content')
    <div>
        <ul class="list-group">
            <li class="list-group-item">
                Joined on {{$user->created_at->format('M d,Y \a\t h:i a') }}
            </li>
            <li class="list-group-item panel-body">
                <table class="table-padding">
                    <style>.table-padding td { padding: 3px 8px; }</style>
                    <tr>
                        <td>Всего рецептов</td>
                        <td> {{$recipes_count}}</td>
                        @if($author && $recipes_count)
                            <td><a href="{{ url('/my-all-recipes')}}">Показать все</a></td>
                        @endif
                    </tr>
                    <tr>
                        <td>Опубликованные рецепт</td>
                        <td>{{$recipes_active_count}}</td>
                        @if($recipes_active_count)
                            <td><a href="{{ url('/user/'.$user->id.'/recipes')}}">Показать все</a></td>
                        @endif
                    </tr>
                    <tr>
                        <td>Приватных рецептов</td>
                        <td>{{$recipes_draft_count}}</td>
                        @if($author && $recipes_draft_count)
                            <td><a href="{{ url('my-private-recipes')}}">Показать все</a></td>
                        @endif
                    </tr>
                </table>
            </li>
            <li class="list-group-item">
                Всего комментариев {{$comments_count}}
            </li>
        </ul>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><h3>Последние рецепты</h3></div>
        <div class="panel-body">
            @if(!empty($latest_recipe[0]))
                @foreach($latest_recipes as $latest_recipe)
                    <p>
                        <strong><a href="{{ url('/'.$latest_recipe->slug) }}">{{ $latest_recipe->title }}</a></strong>
                        <span class="well-sm">От {{ $latest_recipe->created_at->format('M d,Y \a\t h:i a') }}</span>
                    </p>
                @endforeach
            @else
                <p>У вас ещё нет рецептов.</p>
            @endif
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><h3>Последние комментарии</h3></div>
        <div class="list-group">
            @if(!empty($latest_comments[0]))
                @foreach($latest_comments as $latest_comment)
                    <div class="list-group-item">
                        <p>{{ $latest_comment->body }}</p>
                        <p>{{ $latest_comment->created_at->format('M d,Y \a\t h:i a') }}</p>
                        <p>в рецепте <a
                                    href="{{ url('/'.$latest_comment->recipe->slug) }}">{{ $latest_comment->recipe->title }}</a>
                        </p>
                    </div>
                @endforeach
            @else
                <div class="list-group-item">
                    <p>У вас нет комментариев. Ваши последние 5 комментариев будут выведены здесь.</p>
                </div>
            @endif
        </div>
    </div>
@endsection