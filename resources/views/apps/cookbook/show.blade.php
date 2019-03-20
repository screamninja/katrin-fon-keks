@extends('layouts.recipes')
@section('title')
    @if($recipe)
        {{ $recipe->title }}
    @else
        Страница не существует
    @endif
@endsection
@section('header_class', 'page-header')

@section('link')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>
@endsection

@section('nav')
    @include('includes.nav')
@endsection

@section('title-meta')
    <p>{{ $recipe->created_at->format('M d,Y \a\t h:i a') }} Автор:
        @if(!Auth::guest() && Auth::user()->canPublish())
            <a href="{{ url('/user/'.$recipe->author_id)}}" class="badge badge-light">{{ $recipe->author->name }}</a>
        @else
            <a href="{{ url('/user/'.$recipe->author_id.'/recipes')}}"
               class="badge badge-light">{{ $recipe->author->name }}</a>
        @endif
    </p>
@endsection

@section('content')

    @if($recipe)
        <div>
            {!! $recipe->body !!}
        </div><br>
        <div class="tags">
            Тема(ы) рецепта:
            @foreach($tags as $tag)
                <span class="tag">{{ $tag }}</span>
            @endforeach
        </div>
        @if(!Auth::guest() && ($recipe->author_id === Auth::user()->id || Auth::user()->isAdmin()))
            <button class="btn"><a
                        href="{{ url('cookbook/edit/'.$recipe->slug)}}" class="btn btn-info">Редактировать
                    рецепт</a>
            </button>
        @endif
        <div>
            <h2>Комментарии</h2><br>
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

@section('script')
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"
            integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o"
            crossorigin="anonymous"></script>
@endsection