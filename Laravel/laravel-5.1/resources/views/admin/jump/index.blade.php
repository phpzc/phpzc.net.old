@extends('admin.layouts.main')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Message
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Message</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">

                <div class="col-md-6">
                    <div class="box box-default">
                        <div class="box-body">
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-check"></i> Message!</h4>
                                {{ $message }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection


@section('after')

    <script>

        $(function(){
            setTimeout(function () {
                window.location.href = '{{ $url }}';
            },3000);
        })
    </script>
@endsection