@extends('admin.layouts.main')

@section('before_head')
    <link href="{{ WIN8('js/plugins/chosen/chosen/chosen.css') }}" rel="stylesheet">
@endsection
@section('content')

    <div class="row-fluid ">
        <div class="span12">
            <div class="box paint color_18">
                <div class="title">
                    <h4> <i class=" icon-bar-chart"></i><span>Complex table </span> </h4>
                </div>
                <!-- End .title -->
                <div class="content top">
                    <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                        <thead>
                        <tr>
                            <th class="no_sort"> <label class="checkbox ">
                                    <input type="checkbox">
                                </label>
                            </th>
                            <th class="no_sort to_hide_phone"> Title </th>

                            <th class="no_sort"> Time </th>
                            <th class="to_hide_phone ue no_sort"> Views </th>

                            <th class="ms no_sort "> Actions </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($albums as $album)
                            {{ $album->name }}

                            <tr>
                                <td><label class="checkbox ">
                                        <input type="checkbox">
                                    </label></td>
                                <td class="to_hide_phone"> {{ $album->title }} </td>

                                <td> {{ $album->title }} </td>
                                <td class="to_hide_phone"> {{ $album->visit }} </td>

                                <td class="ms"><div class="btn-group">
                                        <a class="btn btn-small" rel="tooltip" data-placement="left" data-original-title=" edit " href="javascript:;"><i class="gicon-edit"></i></a>
                                        <a class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="View" ><i class="gicon-eye-open"></i></a>
                                        <a class="btn  btn-small delete_article" rel="tooltip" data-placement="bottom" data-original-title="Remove" data-id="{{ $album->id }}"><i class="gicon-remove "></i></a> </div></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="row-fluid  control-group mt15">

                        <div class="pull-left span6 visible-desktop" action="#">
                            <div class="row-fluid fluid ">
                                <div class="controls inline input-large pull-left ">
                                    <select data-placeholder="Bulk actions: " class="chzn-select " id="default-select">
                                        <option value=""></option>
                                        <option value="Bender">Edit</option>
                                        <option value="Zoidberg">Regenerate thumbnails</option>
                                        <option value="Kif Kroker">Delete Permanently</option>
                                    </select>
                                </div>
                                <button type="button" class="btn btn-inverse inline">Apply</button>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="pagination pull-right ">
                                <ul>
                                    <li><a href="{!! $albums->previousPageUrl() !!}">Prev</a></li>
                                    <li><a href="#">{!! $albums->currentPage() !!}</a></li>
                                    <li><a href="{!! $albums->nextPageUrl() !!}">Next</a></li>
                                    <li><a href="#">Total {!! $albums->count() !!}</a></li>
                                </ul>
                            </div >
                        </div>


                    </div>
                </div>
                <!-- End row-fluid -->
            </div>
            <!-- End .content -->
        </div>
        <!-- End box -->
    </div>
@endsection

@section('after')
    <script language="javascript" type="text/javascript" src="{{ WIN8('js/plugins/avgrund.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ WIN8('js/plugins/chosen/chosen/chosen.jquery.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Chosen select plugin
            $(".chzn-select").chosen({
                disable_search_threshold: 10
            });

            $('.delete_article').click(function(){
                if( !confirm('确定删除吗?')){
                    return;
                }
                var id = $(this).data('id');
                window.location.href = '/admin/albums/del?id='+id;
            })
        });
    </script>
@endsection