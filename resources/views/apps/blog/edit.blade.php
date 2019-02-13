@extends('layouts.master')
@section('title')
    Редактировать пост
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
    <form method="post" action='{{ url('/blog/update') }}'>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="post_id" value="{{ $post->id }}{{ old('post_id') }}">
        <div class="form-group">
            <input required="required" placeholder="Enter title here" type="text" name="title" class="form-control"
                   value="@if(!old('title')){{$post->title}}@endif{{ old('title') }}"/>
        </div>
        <div class="form-group">
            <label>
<textarea name='body' class="form-control">
@if(!old('body'))
        {!! $post->body !!}
    @endif
    {!! old('body') !!}
</textarea>
            </label>
        </div>
        @if($post->active === '1')
            <input type="submit" name='publish' class="btn btn-success" value="Обновить"/>
        @else
            <input type="submit" name='publish' class="btn btn-success" value="Опубликовать"/>
        @endif
        <input type="submit" name='save' class="btn btn-default" value="Сохранить как черновик"/>
        <a href="{{  url('blog/delete/'.$post->id.'?_token='.csrf_token()) }}" class="btn btn-danger">Удалить</a>
    </form>
@endsection