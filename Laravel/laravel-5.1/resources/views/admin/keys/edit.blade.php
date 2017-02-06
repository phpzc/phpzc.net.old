@extends('admin.layouts.main')

@section('head')
    <style>
        .example-modal .modal {
            position: relative;
            top: auto;
            bottom: auto;
            right: auto;
            left: auto;
            display: block;
            z-index: 1;
        }

        .example-modal .modal {
            background: transparent !important;
        }
    </style>
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Edit Keys
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Keys</li>
            </ol>
        </section>


        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="example-modal">
                <div class="modal ">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Key</h4>
                            </div>
                            <div class="modal-body">
                                <form action="/admin/keys/create" method="post" id="key-create-form">
                                    <div class="row">
                                    <!-- Input addon -->
                                    <div class="box box-info">

                                        <div class="box-body">
                                            <div class="input-group">
                                                <span class="input-group-addon">@</span>
                                                <input type="text" class="form-control" placeholder="name" name="name" value="{{ $key->name }}">
                                                <input type="hidden" name="id" value="{{ $key->id }}">
                                            </div>
                                            <br>
                                            <div class="input-group">
                                                <span class="input-group-addon">@</span>
                                                <input type="text" class="form-control" placeholder="username" name="username" value="{{ $key->username }}">
                                            </div>
                                            <br>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                <input type="text" class="form-control" placeholder="password" name="password" value="{{ $key->password }}">
                                            </div>
                                            <br>

                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ $key->email }}">
                                            </div>
                                            <br>


                                            <div class="input-group">
                                                <span class="input-group-addon">Url</span>
                                                <input type="text" class="form-control" placeholder="url" name="url" value="{{ $key->url }}">
                                            </div>
                                            <br>

                                            <!-- /input-group -->
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="key-create-btn">Save</button>

                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                </div>
            </div>

        </section>

    </div>



@endsection

@section('after')

    <script>
        $(function(){


            $('#key-create-btn').click(function(){
                $('#key-create-form').submit();
            })
        })

    </script>
@endsection
