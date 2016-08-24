@extends('admin.layouts.main')
@section('before_tail')

    <link rel="stylesheet" href="{{ CUBE('/css/libs/lightbox.css') }}" media="screen"/>
    <!-- 表单验证样式文件 -->
    <link rel="stylesheet" type="text/css" href="{{ CUBE('/css/libs/bootstrapValidator.min.css') }}">

    <!--select 样式-->
    <link rel="stylesheet" href="{{ CUBE('/css/libs/select2.css') }}" type="text/css" />
    <!-- 图片预览 -->
    <link rel="stylesheet" href="{{ CUBE('/css/libs/lightbox.css') }}" media="screen"/>

@endsection

@section('content')
    <div class="row-fluid">
        <div class="row">
            <div class="box paint color_7">
                <div class="title">
                    <h4> <i class="icon-book"></i><span>Add Carousel</span>

                    </h4>
                </div>
                <div class="content">
                    <form class="form-horizontal row-fluid" action="/admin/profile/index" method="post" enctype="multipart/form-data" >

                        <div class="form-row control-group row-fluid">
                            <label class="control-label span3" for="with-placeholder">中文名字</label>
                            <div class="controls span9">
                                <input type="text" id="with-placeholder" name="name" placeholder="中文名字" class="row-fluid" value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="form-row control-group row-fluid">
                            <label class="control-label span3" for="with-placeholder2">英文名字</label>
                            <div class="controls span9">
                                <input type="text" id="with-placeholder2" name="foreign_name" placeholder="英文名字" class="row-fluid" value="{{ $user->foreign_name }}">
                            </div>
                        </div>
                        <div class="form-row control-group row-fluid">
                            <label class="control-label span3">编程开始时间</label>
                            <div class="controls span9">
                                <input type="text" name="begin_time" placeholder="编程开始时间" class="row-fluid" value="{{ $user->begin_time }}" />
                            </div>
                        </div>
                        <div class="form-row control-group row-fluid">
                            <label class="control-label span3" for="with-placeholder3">qq</label>

                            <div class="controls span9">
                                <input type="text" name="qq" placeholder="qq" class="row-fluid" value="{{ $user->qq }}" />
                            </div>
                        </div>

                        <div class="form-row control-group row-fluid">
                            <label class="control-label span3" for="with-placeholder3">邮箱</label>

                            <div class="controls span9">
                                <input type="text" name="mail" placeholder="邮箱" class="row-fluid" value="{{ $user->mail }}" />
                            </div>
                        </div>

                        <div class="form-row control-group row-fluid">
                            <label class="control-label span3" for="with-placeholder3">github</label>

                            <div class="controls span9">
                                <input type="text" name="github" placeholder="github" class="row-fluid" value="{{ $user->github }}" />
                            </div>
                        </div>

                        <div class="form-row control-group row-fluid">
                            <label class="control-label span3" for="with-placeholder3">头像地址</label>

                            <div class="controls span9">
                                <input type="text" name="avator_url" placeholder="头像地址" class="row-fluid" value="{{ $user->avator_url }}" />
                            </div>
                        </div>

                        <div class="form-row control-group row-fluid">
                            <label class="control-label span3" for="with-placeholder3">新浪微博地址</label>

                            <div class="controls span9">
                                <input type="text" name="weibo" placeholder="新浪微博地址" class="row-fluid" value="{{ $user->weibo }}" />
                            </div>
                        </div>

                        <div class="form-row control-group row-fluid">
                            <label class="control-label span3" for="with-placeholder3">个人介绍</label>

                            <div class="controls span9">
                                <textarea rows="3" class="row-fluid" id="with-placeholder3" name="description" placeholder="个人介绍">{{ htmlspecialchars_decode($user->description) }}"</textarea>
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