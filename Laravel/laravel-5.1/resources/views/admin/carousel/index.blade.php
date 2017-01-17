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
                Data Tables
                <small>advanced tables</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Tables</a></li>
                <li class="active">Data tables</li>
            </ol>
        </section>


        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Data Table With Full Features</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Link</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($carousels as $item)

                                    <tr>
                                        <td> <img style="width:40%;" src="{{ $item->imgurl }}" /> </td>

                                        <td> <a class="btn btn-danger" href="{{ $item->href }}" target="_blank">A-Link</a> </td>
                                        <td > {{ $item->description }} </td>
                                        <td>
                                            @if ($item->status == 0)
                                                <button class="btn btn-success">Deleted</button>
                                            @else
                                                <button class="btn btn-warning">Active</button>
                                            @endif

                                        </td>
                                        <td>

                                            <a class="btn btn-app  active_item" data-id="{{ $item->id }}" >
                                                <i class="fa fa-refresh"></i> refresh
                                            </a>

                                            <a class="btn btn-app" href="/admin/carousel/update?id={{ $item->id }}" >
                                                <i class="fa fa-edit"></i> Edit
                                            </a>

                                            <a class="btn btn-app delete_article"  data-id="{{ $item->id }}" >
                                                <i class="fa fa-remove"></i> Remove
                                            </a>


                                        </td>
                                    </tr>
                                @endforeach


                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Image</th>
                                    <th>Link</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
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

    <!-- page script -->
    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>

    <script>
        $(document).ready(function() {


            $('.delete_article').click(function(){
                if( !confirm('确定删除吗?')){
                    return;
                }
                var id = $(this).data('id');
                window.location.href = '/admin/carousel/del?id='+id;
            })

            $('.active_item').click(function(){
                if( !confirm('确定激活吗?')){
                    return;
                }
                var id = $(this).data('id');
                window.location.href = '/admin/carousel/active?id='+id;
            })
        });
    </script>
@endsection