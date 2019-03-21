@extends('layouts.recipes')
@section('title', 'Добавить новый рецепт')
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

    <form action="/cookbook/new-recipe" method="post">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <input required="required" value="{{ old('title') }}" placeholder="Введите название" type="text"
                   name="title" class="form-control"/>
        </div>


        <div class="form-group">
            <label>
                <textarea name="body" class="form-control" id="editor">{{ old('body') }}</textarea>
            </label><br>
        </div>

        <div class="form-group row">
            <label for="colFormLabel" class="col-3 col-form-label">Выберете тему(ы) для рецепта:</label>
            <div class="col-7">
                <select class="selectpicker" name="tags[]" multiple data-live-search="true" data-width="500px">
                    <option value="Свадебный">Свадебный</option>
                    <option value="На День Рождения">На День Рождения</option>
                    <option value="Праздничные">Праздничные</option>
                    <option value="Мужские">Мужские</option>
                    <option value="Детские">Детские</option>
                    <option value="Муссовые">Муссовые</option>
                    <option value="Чизкейки">Чизкейки</option>
                    <option value="Корпоротивные">Корпоротивные</option>
                    <option value="Для любимых">Для любимых</option>
                </select>
            </div>
        </div>

        <p>
            <input type="submit" name='publish' class="btn btn-primary" value="Опубликовать"/>
            <input type="submit" name='publish_private' class="btn btn-dark" value="Опубликовать приватно"/>
        </p>
    </form>

    <script>
        $('select'). selectpicker({
            noneSelectedText: 'Без темы'
        });
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