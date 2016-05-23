@extends('admin.layouts.main')
@section('before_tail')



    <style>
        .form-control{width:300px !important;}
        #autoreqmark{display:none;}
        .form-group{margin-bottom:0px;padding-top:20px;}
        .input-group{line-height:30px;}
        .input-group-addon{word-break:normal;width:250px;}
        .form-group .btn-info{margin-left:20px;}
        .img1,.img2{visibility:hidden !important;}
        .fa-eye,.fa-pencil,.fa-trash-o{cursor:pointer;}
        .project-img-div,.mortgaged-img-div{position:absolute;width:100%;height:100%;top:0;display:none;background:#eee;}
        .fa-eye{position:absolute;top:48%;left:27%;}
        .fa-trash-o{position:absolute;top:48%;left:67%;}
        .project-img-list,.mortgaged-img-list{display:inline-block;position:relative;margin:5px;}
        #project-img-list,#mortgaged-img-list{display:inline-block;}
        label{width:120px;text-align:right;}
        .radio input[type=radio] + label:before, .radio input[type=radio]:hover + label:before{border-color:#03a9f4;}
        .radio label{text-align:center;}

        .upload_btn{float:left;}
    </style>
    <link rel="stylesheet" href="{{ CUBE('/css/libs/lightbox.css') }}" media="screen"/>
    <!-- 表单验证样式文件 -->
    <link rel="stylesheet" type="text/css" href="{{ CUBE('/css/libs/bootstrapValidator.min.css') }}">
    <!-- 提醒框样式 -->
    <link rel="stylesheet" type="text/css" href="{{ CUBE('/css/libs/ns-default.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ CUBE('/css/libs/ns-style-bar.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ CUBE('/css/libs/ns-style-theme.css') }}"/>
    <!--select 样式-->
    <link rel="stylesheet" href="{{ CUBE('/css/libs/select2.css') }}" type="text/css" />
    <!-- 图片预览 -->
    <link rel="stylesheet" href="{{ CUBE('/css/libs/lightbox.css') }}" media="screen"/>
    <!-- 提示 -->
    <link rel="stylesheet" type="text/css" href="{{ CUBE('/css/libs/ns-default.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ CUBE('/css/libs/ns-style-growl.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ CUBE('/css/libs/ns-style-bar.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ CUBE('/css/libs/ns-style-attached.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ CUBE('/css/libs/ns-style-other.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ CUBE('/css/libs/ns-style-theme.css') }}"/>


    <link rel="stylesheet" href="{{ KINDEDITOR('/themes/default/default.css') }}" />
    <script src="{{ KINDEDITOR('/kindeditor-all-min.js') }}"></script>
    <script charset="utf-8" src="{{ KINDEDITOR('/lang/zh-CN.js') }}"></script>
@endsection

@section('content')
    <div class="row-fluid">
        <div class="row">
            <div class="box paint color_7">
                <div class="title">
                    <h4> <i class="icon-book"></i><span>Add Carousel</span> </h4>
                </div>
                <div class="content">
                    <form class="form-horizontal row-fluid" action="" method="post" enctype="multipart/form-data" >

                        <div class="form-row control-group row-fluid">
                            <label class="control-label span3" for="with-placeholder">Title</label>
                            <div class="controls span9">
                                <input type="text" id="with-placeholder" name="title" placeholder="Title" class="row-fluid">
                            </div>
                        </div>
                        <div class="form-row control-group row-fluid">
                            <label class="control-label span3" for="with-placeholder2">Href</label>
                            <div class="controls span9">
                                <input type="text" id="with-placeholder2" name="href" placeholder="Href" class="row-fluid">
                            </div>
                        </div>
                        <div class="form-row control-group row-fluid">
                            <label class="control-label span3" for="search-input">File upload</label>
                            <div class="controls span9">
                                <div class="input-append row-fluid">
                                    <!--for upload image-->
                                    <div id="mortgaged-img-list" class="input-append row-fluid"></div>
                                    <br/>
                                    <button type="button" id="upload_btn" class="btn btn-secondary  up-mortgaged">Upload</button>

                                </div>
                                <script>
                                    function mortgageddel(thi){}
                                    function eye(thi){}
                                    KindEditor.ready(function(K) {
                                        var editor = K.editor({
                                            allowFileManager : true
                                        });
                                        K('.up-mortgaged').click(function() {
                                            editor.loadPlugin('image', function() {
                                                editor.plugin.imageDialog({
                                                    imageUrl : K('#mortgaged-img').val(),
                                                    clickFn : function(url, title, width, height, border, align) {
                                                        $('#hidden').children('div').addClass('mortgaged-img-list');
                                                        $('#hidden').find('div').find('a').attr('data-lightbox','example-set');
                                                        $('#hidden').find('div').find('a').attr('href',url);
                                                        $('#hidden').find('div').find('a').find('img').attr('src',url);
                                                        $('#hidden').find('div').find('div').addClass('mortgaged-img-div');
                                                        $('#hidden').find('div').find('div').find('.fa-eye').addClass('mortgaged-img-edit');
                                                        $('#hidden').find('div').find('div').find('.fa-eye').attr('onclick','eye(this)');
                                                        $('#hidden').find('div').find('div').find('.fa-trash-o').addClass('mortgaged-img-del');
                                                        $('#hidden').find('div').find('div').find('.fa-trash-o').attr('onclick','mortgageddel(this)');
                                                        $('#hidden').find('div').find('input').attr('name','mortgaged-img-url[]');
                                                        $('#hidden').find('div').find('input').attr('value',url);
                                                        var html = $('#hidden').html();
                                                        $('#mortgaged-img-list').append(html);
                                                        $('#mortgaged-img').siblings('*:last').hide();
                                                        $('button.btn-info').prop('disabled',false);
                                                        $('#hidden').children('div').removeClass('mortgaged-img-list');
                                                        $('#hidden').find('div').find('a').attr('data-lightbox','');
                                                        $('#hidden').find('div').find('a').attr('href','');
                                                        $('#hidden').find('div').find('a').find('img').attr('src','');
                                                        $('#hidden').find('div').find('div').removeClass('mortgaged-img-div');
                                                        $('#hidden').find('div').find('div').find('.fa-eye').removeClass('mortgaged-img-edit');
                                                        $('#hidden').find('div').find('div').find('.fa-eye').attr('onclick','');
                                                        $('#hidden').find('div').find('div').find('.fa-trash-o').removeClass('mortgaged-img-del');
                                                        $('#hidden').find('div').find('div').find('.fa-trash-o').attr('onclick','');
                                                        $('#hidden').find('div').find('input').attr('value','');
                                                        editor.hideDialog();
                                                    }
                                                });
                                            });
                                        });
                                    });
                                </script>
                            </div>
                        </div>

                        <div class="form-actions row-fluid">
                            <div class="span3 visible-desktop"></div>
                            <div class="span7 ">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-secondary">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="hidden" id="hidden">
        <div>
            <a class="example-image-link" href="" title=""> <img class="example-image" src="" alt="plants: image 1 0f 4 thumb" width="150px" height="100px"/></a><input name="" type="text" class="hidden" value="">
            <div class="">
                <i class="fa fa-eye"></i>
                <i class="fa fa-trash-o"></i>
            </div>
        </div>
    </div>
@endsection

@section('after')

@endsection