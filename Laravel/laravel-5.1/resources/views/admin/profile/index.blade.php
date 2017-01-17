@extends('admin.layouts.main')
@section('before_tail')

@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Update Profile
                <small>Preview</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Update Profile</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Update Profile</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" action="/admin/profile/index" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Name</label>

                                    <div class="col-sm-10">

                                        <input type="text" id="with-placeholder" name="name" placeholder="Name" class="form-control" value="{{ $user->name }}" />

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">English Name</label>

                                    <div class="col-sm-10">

                                        <input type="text" id="with-placeholder2" name="foreign_name" placeholder="English Name" class="form-control" value="{{ $user->foreign_name }}">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Begin Code Time</label>


                                    <div class="col-sm-10 ">
                                        <input type="text" class="form-control" id="datepicker" name="begin_time" placeholder="Begin Code Time" value="{{ date('Y-m',$user->begin_time) }}" readonly>
                                    </div>
                                </div>





                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">qq</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="qq" placeholder="qq" class="form-control" value="{{ $user->qq }}"/>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="mail" placeholder="Email" class="form-control" value="{{ $user->mail }}"/>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">GitHub</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="github" placeholder="GitHub" class="form-control" value="{{ $user->github }}"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Face Url</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="avator_url" placeholder="Face Url" class="form-control" value="{{ $user->avator_url }}"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Weibo</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="weibo" placeholder="Weibo" class="form-control" value="{{ $user->weibo }}"/>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea rows="3" class="form-control" id="with-placeholder3" name="description" placeholder="Description">{{ $user->description }}</textarea>
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-default">Cancel</button>
                                <button type="submit" class="btn btn-info pull-right">Save</button>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>

                </div>
            </div>

        </section>
    </div>


@endsection

@section('after')
    <script src="{{ ADMIN('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ ADMIN('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ ADMIN('plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
    <!-- bootstrap time picker -->
    <script src="{{ ADMIN('plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>


    <script>
        $('#datepicker').datepicker({
            autoclose: true,
            format:'yyyy-mm'
        });

    </script>
@endsection