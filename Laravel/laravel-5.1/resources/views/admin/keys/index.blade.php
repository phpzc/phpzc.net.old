@extends('admin.layouts.main')

@section('head')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ ADMIN('plugins/datatables/dataTables.bootstrap.css') }}">
@endsection


@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Keys
                <small>advanced tables</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Links</li>
            </ol>
        </section>


        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="row" style="padding-left: 3em">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Add Key</button>

                </div>
                <div class="modal bs-example-modal-lg">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Create Key</h4>
                            </div>
                            <div class="modal-body">
                                <form action="/admin/keys/create" method="post" id="key-create-form">
                                    <div class="row">
                                    <!-- Input addon -->
                                    <div class="box box-info">

                                        <div class="box-body">
                                            <div class="input-group">
                                                <span class="input-group-addon">@</span>
                                                <input type="text" class="form-control" placeholder="name" name="name">
                                            </div>
                                            <br>
                                            <div class="input-group">
                                                <span class="input-group-addon">@</span>
                                                <input type="text" class="form-control" placeholder="username" name="username">
                                            </div>
                                            <br>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                <input type="text" class="form-control" placeholder="password" name="password">
                                            </div>
                                            <br>

                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                <input type="email" class="form-control" placeholder="Email" name="email">
                                            </div>
                                            <br>


                                            <div class="input-group">
                                                <span class="input-group-addon">Url</span>
                                                <input type="text" class="form-control" placeholder="url" name="url">
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


                <div class="col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Links</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th >Id</th>
                                    <th > Name </th>
                                    <th > username </th>
                                    <th > password </th>
                                    <th > email </th>
                                    <th > url </th>
                                    <th> Actions </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($keys as $key)


                                    <tr>
                                        <td>{{ $key->id }}</td>
                                        <td >{{  $key->name }}</td>
                                        <td > {{ $key->username }} </td>
                                        <td> {{ $key->password }} </td>
                                        <td > {{ $key->email }} </td>
                                        <td > {{ $key->url }} </td>
                                        <td>


                                            <a class="btn btn-app links-edit"  data-id="{{ $key->id }}">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>

                                            <a class="btn btn-app delete_article"  data-id="{{ $key->id }}" >
                                                <i class="fa fa-remove"></i> Remove
                                            </a>


                                        </td>
                                    </tr>
                                @endforeach


                                </tbody>
                                <tfoot>
                                <tr>
                                    <th >Id</th>
                                    <th > Name </th>
                                    <th > username </th>
                                    <th > password </th>
                                    <th > email </th>
                                    <th > url </th>
                                    <th> Actions </th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>
            </div>

        </section>

    </div>



@endsection

@section('after')

    <!-- DataTables -->
    <script src="{{ ADMIN('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ ADMIN('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

    <script>
        $(function(){

            $('.links-edit').click(function(){

                var id= $(this).data('id');
                window.location.href = '/admin/keys/edit?id='+id;
            })

            $('.delete_article').click(function(){

                var id= $(this).data('id');
                window.location.href = '/admin/keys/del?id='+id;
            })

            $('#key-create-btn').click(function(){
                $('#key-create-form').submit();
            })
        })

    </script>
@endsection
