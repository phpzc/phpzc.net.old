@extends('admin.layouts.main')
@section('before_tail')

@endsection
@section('content')
    <div class="row-fluid">
        <div class="row">
            <div class="box paint color_7">
                <div class="title">
                    <h4> <i class="icon-book"></i><span>Add Carousel</span>

                    </h4>
                </div>
                <div class="content">
                    <form class="form-horizontal row-fluid" action="/admin/carousel/add" method="post" enctype="multipart/form-data" >

                        <div class="form-row control-group row-fluid">
                            <label class="control-label span3" for="with-placeholder">Title</label>
                            <div class="controls span9">
                                <input type="text" id="with-placeholder" name="title" placeholder="Title" class="row-fluid" value="{{ $data->title }}" />
                            </div>
                        </div>
                        <div class="form-row control-group row-fluid">
                            <label class="control-label span3" for="with-placeholder2">Href</label>
                            <div class="controls span9">
                                <input type="text" id="with-placeholder2" name="href" placeholder="Href" class="row-fluid" value="{{ $data->href }}">
                            </div>
                        </div>
                        <div class="form-row control-group row-fluid">
                            <label class="control-label span3">type</label>
                            <div class="controls span9">
                                <input type="text" name="type" placeholder="Href" class="row-fluid" value="{{ $data->type }}"/>
                            </div>
                        </div>
                        <div class="form-row control-group row-fluid">
                            <label class="control-label span3" for="with-placeholder3">Description</label>

                            <div class="controls span9">
                                <textarea rows="3" class="row-fluid" id="with-placeholder3" name="description" placeholder="Description">{{ $data->description }}</textarea>
                            </div>
                        </div>
                        <div class="form-row control-group row-fluid">
                            <label class="control-label span3" for="search-input">File upload</label>
                            <div class="controls span9">
                                <div class="input-append row-fluid">
                                    <input type="text" name="imgurl" placeholder="imgurl" class="row-fluid" value="{{ $data->imgurl }}"/>
                                </div>

                            </div>
                        </div>

                        <div class="form-actions row-fluid">
                            <div class="span3 visible-desktop"></div>
                            <div class="span7 ">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-secondary">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="hidden" id="hidden">
        <div>
            <a class="example-image-link" href="" title=""> <img class="example-image" src="" alt="plants: image 1 0f 4 thumb" width="150px" height="100px"/></a><input name="" type="text" class="hidden" value="">
            <div class="">
                <i class="fa fa-eye"></i>
                <i class="fa fa-trash-o"></i>
            </div>
        </div>
    </div>
@endsection

@section('after')

@endsection