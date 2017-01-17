@extends('admin.layouts.main')
@section('before_tail')

@endsection
@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Update Carousel
                <small>Preview</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Update Carousel</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Update Carousel</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" action="/admin/carousel/update" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Title</label>

                                    <div class="col-sm-10">

                                        <input type="hidden" name="id" value="{{ $data->id }}" />
                                        <input type="text" id="with-placeholder" name="title" placeholder="Title" class="form-control" value="{{ $data->title }}" />

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Href</label>

                                    <div class="col-sm-10">

                                        <input type="text" id="with-placeholder2" name="href" placeholder="Href" class="form-control" value="{{ $data->href }}">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Type</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="type" placeholder="Href" class="form-control" value="{{ $data->type }}"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea rows="3" class="form-control" id="with-placeholder3" name="description" placeholder="Description">{{ $data->description }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">File Upload</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="imgurl" placeholder="imgurl" class="form-control" value="{{ $data->imgurl }}"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Sort</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="sort" placeholder="sort num" class="form-control" value="{{ $data->sort }}"/>
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

@endsection