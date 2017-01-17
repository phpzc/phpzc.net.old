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
                Links
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
                                    <th > Url </th>
                                    <th > Name </th>
                                    <th > Email </th>
                                    <th > Status </th>
                                    <th> Actions </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($links as $link)


                                    <tr>
                                        <td>{{ $link->id }}</td>
                                        <td > <a href="{{  $link->url }}" title="{{  $link->url }}" target="_blank">{{ mb_substr($link->url,0,50) }} </a></td>
                                        <td > {{ $link->name }} </td>
                                        <td> {{ $link->email }} </td>
                                        <td > {{ $link->status }} </td>

                                        <td>


                                            <a class="btn btn-app links-edit"  data-id="{{ $link->id }}">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>

                                            <a class="btn btn-app delete_article"  data-id="{{ $link->id }}" >
                                                <i class="fa fa-remove"></i> Remove
                                            </a>


                                        </td>
                                    </tr>
                                @endforeach


                                </tbody>
                                <tfoot>
                                <tr>
                                    <th >Id</th>
                                    <th > Url </th>
                                    <th > Name </th>
                                    <th > Email </th>
                                    <th > Status </th>
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
                window.location.href = '/admin/links/active?id='+id;
            })

            $('.delete_article').click(function(){

                var id= $(this).data('id');
                window.location.href = '/admin/links/del?id='+id;
            })
        })

    </script>
@endsection