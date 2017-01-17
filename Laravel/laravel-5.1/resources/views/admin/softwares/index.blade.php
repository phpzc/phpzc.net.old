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
                Software
                <small>advanced tables</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Software</li>
            </ol>
        </section>


        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Software</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th> Title </th>
                                    <th> Type </th>
                                    <th> Actions </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($softwares as $software)

                                    <tr>
                                        <td> {{ $software->title }} </td>

                                        <td >                                 @if ($software->type == 0)
                                                <button class="btn btn-success">Gui</button>
                                            @else
                                                <button class="btn btn-warning">Game</button>
                                            @endif</td>
                                        <td>


                                            <a class="btn btn-app" href="/admin/ablums/update?id={{ $software->id }}" >
                                                <i class="fa fa-edit"></i> Edit
                                            </a>

                                            <a class="btn btn-app delete_article"  data-id="{{ $software->id }}" >
                                                <i class="fa fa-remove"></i> Remove
                                            </a>


                                        </td>
                                    </tr>
                                @endforeach


                                </tbody>
                                <tfoot>
                                <tr>
                                    <th> Title </th>
                                    <th> Type </th>
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
        $(document).ready(function() {

            $('.delete_article').click(function(){
                if( !confirm('确定删除吗?')){
                    return;
                }
                var id = $(this).data('id');
                window.location.href = '/admin/softwares/del?id='+id;
            })
        });
    </script>
@endsection