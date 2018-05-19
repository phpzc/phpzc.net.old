@extends('layouts.main')
@section('head')
    <link rel="stylesheet" href="{{ CUBE('/css/libs/select2.css') }}" type="text/css" />
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box">
                <header class="main-box-header clearfix">
                    <h2>Album create form</h2>
                </header>

                <div class="main-box-body clearfix">
                    <form class="form-horizontal" role="form" action="/album/create_album" method="post" id="current_form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="form_title" class="col-lg-2 control-label">相册名称：</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="form_title" placeholder="Title" name="title" />
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">相册描述：</label>
                            <div class="col-lg-10">
                                <textarea class="form-control" name="content">
                                </textarea>
                            </div>

                        </div>

                        <div class="form-group">
                            <label  class="col-lg-2 control-label">可见性：</label>
                            <div class="col-lg-10">
                                <div class="radio">
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="0" checked>
                                    <label for="optionsRadios1">
                                        不可见
                                    </label>
                                </div>
                                <div class="radio">
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="1">
                                    <label for="optionsRadios2">
                                        可见
                                    </label>
                                </div>
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
