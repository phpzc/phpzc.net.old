@extends('layouts.main')
@section('head')
    <link rel="stylesheet" href="{{ CUBE('css/libs/datepicker.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ CUBE('css/libs/daterangepicker.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ CUBE('css/libs/bootstrap-timepicker.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ CUBE('css/libs/select2.css') }}" type="text/css" />

    <link rel="stylesheet" href="{{ MD() }}css/editormd.css" />

@endsection


@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box">
                <header class="main-box-header clearfix">
                    <h2>Article create form</h2>
                </header>

                <div class="main-box-body clearfix">
                    <form class="form-horizontal" role="form" action="/article/dealCreateMarkdown" method="post" id="current_form">
                        <div class="form-group">
                            <label for="form_title" class="col-lg-2 control-label">Title</label>
                            <div class="col-lg-10">
                                {{ csrf_field() }}
                                <input type="text" class="form-control" id="form_title" placeholder="Title" name="form_title" />
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Category</label>
                            <div class="col-lg-10">
                                <select class="form-control" name="form_category">
                                    @foreach($WebsiteCategory as $v)
                                        <option value="{{ $v['id'] }}">{{ $v['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="myEditor" class="col-lg-2 control-label">Content</label>
                            <div class="col-lg-10" id="test-editormd" style="width:99%;height:200px;">
                                <textarea class="editormd-markdown-textarea" name="id-markdown-doc"></textarea>

                                <textarea class="editormd-html-textarea" name="id-html-code"></textarea>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="form_tag" class="col-lg-2 control-label">Labels,use , as delimiter</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="form_tag" placeholder="Labels" name="form_tag" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button  type="button" onclick="document.getElementById('current_form').submit()" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('after')
    <script src="{{ MD() }}examples/js/jquery.min.js"></script>
    <script src="{{ MD() }}editormd.js"></script>
    <!-- this page specific scripts -->
    <script>

        var testEditor;

        $(function() {
            testEditor = editormd("test-editormd", {
                width   : "99%",
                height  : 400,
                syncScrolling : "single",
                path    : "{{ MD() }}lib/",
                tocm            : true,
                saveHTMLToTextarea : true,
                emoji : true,
                taskList : true,
                searchReplace : true,
                codeFold : true,
                imageUpload : true,
                imageFormats : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
                imageUploadURL : "{{ MD() }}examples/php/upload.php",

            });

        });
    </script>

@endsection