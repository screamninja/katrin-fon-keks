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
                <select class="selectpicker" name="themes[]" multiple data-live-search="true">
                    <option value=1>Свадебный</option>
                    <option value=2>На День Рождения</option>
                    <option value=4>Праздничные</option>
                    <option value=8>Мужские</option>
                    <option value=16>Детские</option>
                    <option value=32>Муссовые</option>
                    <option value=64>Чизкейки</option>
                    <option value=128>Корпоротивные</option>
                    <option value=256>Для любимых</option>
                    <option value=0>Без темы</option>
                </select>
            </div>
        </div>

        <p>
            <input type="submit" name='publish' class="btn btn-success" value="Опубликовать"/>
            <input type="submit" name='publish_private' class="btn btn-success" value="Опубликовать приватно"/>
        </p>
    </form>

    <script>
        $('select').selectpicker();

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