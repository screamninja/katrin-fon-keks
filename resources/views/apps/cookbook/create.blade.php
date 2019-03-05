@extends('layouts.recipes')
@section('title')
    Добавить новый рецепт
@endsection
@section('content')
    <script type="text/javascript" src="{{ asset('https://cloud.tinymce.com/5/tinymce.min.js') }}"></script>
    <script type="text/javascript">
        var editor_config = ({
            path_absolute: "/",
            selector: "textarea",
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste",
                "emoticons template paste textcolor colorpicker textpattern",
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            relative_urls: false,
            file_browser_callback : function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no"
                });
            }
        });
        tinymce.init(editor_config);
    </script>
    <form action="/cookbook/new-recipe" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <input required="required" value="{{ old('title') }}" placeholder="Введите название" type="text"
                   name="title" class="form-control"/>
        </div>
        <div class="form-group">
            <label>
                <textarea name='body' class="form-control">{{ old('body') }}</textarea>
            </label><br>
            {{ Form::select('city_bldg_id', array(
                0b0000000001 => 'Свадебный',
                0b0000000010 => 'На День Рождения',
                0b0000000100 => 'Праздничные',
                0b0000001000 => 'Мужские',
                0b0000010000 => 'Детские',
                0b0000100000 => 'Муссовые',
                0b0001000000 => 'Чизкейки',
                0b0010000000 => 'Корпоротивные',
                0b0100000000 => 'Для любимых',
                0b1000000000 => '', // Без темы
            )) }}
        </div><br><br>
        <input type="submit" name='publish' class="btn btn-success" value="Опубликовать"/>
        <input type="submit" name='publish_private' class="btn btn-default" value="Опубликовать приватно"/>
    </form>
@endsection