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
                            <th class="no_sort to_hide_phone"> Image </th>

                            <th class="no_sort"> Link </th>
                            <th class="to_hide_phone ue no_sort"> Description </th>
                            <th class="no_sort"> Status </th>
                            <th class="ms no_sort "> Actions </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($carousels as $item)


                            <tr>
                                <td><label class="checkbox ">
                                        <input type="checkbox">
                                    </label></td>
                                <td class="to_hide_phone"> <img style="width:40%;" src="{{ $item->imgurl }}" /> </td>

                                <td> <a class="btn btn-danger" href="{{ $item->href }}" target="_blank">A-Link</a> </td>
                                <td > {{ $item->description }} </td>
                                <td>
                                    @if ($item->status == 0)
                                        <button class="btn btn-success">Deleted</button>
                                    @else
                                        <button class="btn btn-warning">Active</button>
                                    @endif

                                </td>
                                <td class="ms"><div class="btn-group">
                                        <a class="btn btn-small" rel="tooltip" data-placement="left" data-original-title=" edit " href="/admin/carousel/update?id={{ $item->id }}"><i class="gicon-edit"></i></a>
                                        <a class="btn btn-small active_item" rel="tooltip" data-placement="top" data-original-title="Active" data-id="{{ $item->id }}" ><i class="gicon-eye-open"></i></a>
                                        <a class="btn  btn-small delete_article" rel="tooltip" data-placement="bottom" data-original-title="Remove" data-id="{{ $item->id }}"><i class="gicon-remove "></i></a> </div></td>
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
                                    <li><a href="{!! $carousels->previousPageUrl() !!}">Prev</a></li>
                                    <li><a href="#">{!! $carousels->currentPage() !!}</a></li>
                                    <li><a href="{!! $carousels->nextPageUrl() !!}">Next</a></li>
                                    <li><a href="#">Total {!! $carousels->count() !!}</a></li>
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