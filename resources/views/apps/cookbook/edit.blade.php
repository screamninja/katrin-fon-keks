@extends('layouts.recipes')
@section('title', 'Редактировать рецепт')
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

@section('content')

    <form action='{{ url('/cookbook/update') }}' method="post">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <input type="hidden" name="recipe_id" value="{{ $recipe->id }}{{ old('recipe_id') }}">

        <div class="form-group">
            <input required="required" placeholder="Введите название здесь" type="text" name="title"
                   class="form-control"
                   value="@if(!old('title')){{$recipe->title}}@endif{{ old('title') }}"/>
        </div>

        <div class="form-group">
            <label>
                <textarea name='body' class="form-control" id="editor">@if(!old('body')){!! $recipe->body !!}@endif{!! old('body') !!}</textarea>
            </label><br>
        </div>

        <div class="tags">
            Тема(ы) рецепта:
            @foreach($tags as $tag)
                <span class="tag">{{ $tag['name'] }}</span>
                <span class="tag-id">{{ $tag['id'] }}</span>
            @endforeach
        </div><br>

        <div class="form-group row">
            <label for="colFormLabel" class="col-3 col-form-label">Выберете тему(ы) для рецепта:</label>
            <div class="col-7">
                <select class="selectpicker" name="tags" id="tags" multiple data-live-search="true" data-width="500px">
                    <option value="2">Свадебный</option>
                    <option value="3">На День Рождения</option>
                    <option value="4">Праздничные</option>
                    <option value="5">Мужские</option>
                    <option value="6">Детские</option>
                    <option value="7">Муссовые</option>
                    <option value="8">Чизкейки</option>
                    <option value="9">Корпоротивные</option>
                    <option value="10">Для любимых</option>
                </select>
            </div>
        </div>

        @if($recipe->privacy == 1)
            <input type="submit" name='publish' class="btn btn-success" value="Обновить"/>
            <input type="submit" name='publish_private' class="btn btn-dark" value="Опубликовать приватно"/>
        @else
            <input type="submit" name='publish_private' class="btn btn-success" value="Обновить"/>
            <input type="submit" name='publish' class="btn btn-primary" value="Опубликовать публично"/>
        @endif
        <a href="{{  url('cookbook/delete/'.$recipe->id.'?_token='.csrf_token()) }}" class="btn btn-danger">Удалить</a>

        <script>
            $('select'). selectpicker({
                noneSelectedText: 'Без темы'
            });
            var tags = $('.tag-id').toArray();
            $.each(tags, function(i,e){
                $("select[name=tags]").val('" + e + "');
            });
            $('.selectpicker').selectpicker('refresh');
            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });
        </script>

    </form>
@endsection

@section('script')
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"
            integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o"
            crossorigin="anonymous"></script>
@endsection