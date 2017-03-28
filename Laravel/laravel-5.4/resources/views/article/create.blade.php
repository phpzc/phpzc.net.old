@extends('layouts.main')
@section('head')
    <link rel="stylesheet" href="{{ CUBE('css/libs/datepicker.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ CUBE('css/libs/daterangepicker.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ CUBE('css/libs/bootstrap-timepicker.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ CUBE('css/libs/select2.css') }}" type="text/css" />
    <script type="text/javascript" charset="utf-8" src="{{ UEDITOR('ueditor.config.js')  }}"></script>
    <script type="text/javascript" charset="utf-8" src="{{ UEDITOR('ueditor.all.min.js') }}"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="{{ UEDITOR('lang/zh-cn/zh-cn.js') }}"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box">
                <header class="main-box-header clearfix">
                    <h2>Article create form</h2>
                </header>

                <div class="main-box-body clearfix">
                    <form class="form-horizontal" role="form" action="/article/dealCreate" method="post" id="current_form">
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
                            <div class="col-lg-10">
                                <script id="myEditor" name="form_article" type="text/plain" style="width:99%;height:200px;"></script>
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
    <!-- this page specific scripts -->
    <script>
        var ue = UE.getEditor('myEditor',{
            wordCount:true,          //是否开启字数统计
            maximumWords:500,      //允许的最大字符数
            autoClearinitialContent:true,
            elementPathEnabled:false

        });


    </script>
@endsection