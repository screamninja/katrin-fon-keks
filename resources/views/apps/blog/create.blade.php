@extends('app')
@section('title')
    Добавить новый пост
@endsection
@section('content')
    <script type="text/javascript" src="{{ asset('https://cloud.tinymce.com/5/tinymce.min.js') }}"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea",
            plugins: ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });
    </script>
    <form action="/new-post" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <input required="required" value="{{ old('title') }}" placeholder="Введите название" type="text"
                   name="title" class="form-control"/>
        </div>
        <div class="form-group">
            <label>
                <textarea name='body' class="form-control">{{ old('body') }}</textarea>
            </label>
        </div>
        <input type="submit" name='publish' class="btn btn-success" value="Опубликовать"/>
        <input type="submit" name='save' class="btn btn-default" value="Сохранить черновик"/>
    </form>
@endsection