@extends('layouts.main')
@section('head')

@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box">
                <header class="main-box-header clearfix">
                    <h2>Album create form</h2>
                </header>

                <div class="main-box-body clearfix">
                    <form action="/document/dealCreate" method="post" id="current_form" enctype="multipart/form-data" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label  class="col-lg-2 control-label">分类：</label>
                            <div class="col-lg-10">
                                <select class="form-control" name="form_category">

                                    @foreach($WebsiteCategory as $v)
                                        <option value="{{ $v['id'] }}">{{ $v['name'] }}</option>

                                    @endforeach

                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="form_title" class="col-lg-2 control-label">标题 (100个字限制)：</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control"  placeholder="Title" name="form_title" />
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="form_title" class="col-lg-2 control-label">作者 (100个字限制)：</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control"  placeholder="Author" name="form_author" />
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="form_title" class="col-lg-2 control-label">上传资料封面(280 X 280[jpg,png,jpeg], &lt;10M ) </label>
                            <div class="col-lg-10">
                                <input type="file" class="form-control" name="upload"  class="form_control" />
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="form_title" class="col-lg-2 control-label">网盘地址(200个字限制)：</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control"  placeholder="Url" name="url" />
                            </div>

                        </div>


                        <div class="form-group">
                            <label  class="col-lg-2 control-label">网盘类型：</label>
                            <div class="col-lg-10">
                                <select class="form-control" name="urltype">
                                    <option value="1">百度网盘</option>
                                    <option value="2">360云盘</option>
                                    <option value="3">华为网盘</option>
                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <label  class="col-lg-2 control-label">资料类型：</label>
                            <div class="col-lg-10">
                                <select class="form-control" name="doctype">
                                    <option value="1">Pdf</option>
                                    <option value="2">Word</option>
                                    <option value="3">Excel</option>
                                    <option value="4">Video</option>
                                    <option value="5">Zip</option>
                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="form_title" class="col-lg-2 control-label">说明：</label>
                            <div class="col-lg-10">
                                <textarea name="content" class="form-control"></textarea>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="form_title" class="col-lg-2 control-label">资料标签：</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control"  placeholder="Tag" name="form_tag" />（最多添加5个标签，多个标签之间用“,”分隔,单个标签最多20个字）
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

@endsection