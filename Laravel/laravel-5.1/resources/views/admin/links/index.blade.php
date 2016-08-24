@extends('admin.layouts.main')

@section('before_head')

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
                            <th class="no_sort"> Id
                            </th>
                            <th class="no_sort to_hide_phone"> Url </th>
                            <th class="no_sort to_hide_phone"> Name </th>
                            <th class="no_sort"> Email </th>
                            <th class="no_sort"> Status </th>

                            <th class="ms no_sort "> Actions </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($links as $link)


                        <tr>
                            <td>{{ $link->id }}</td>
                            <td > <a href="{{  $link->url }}" title="{{  $link->url }}" target="_blank">{{ mb_substr($link->url,0,50) }} </a></td>
                            <td > {{ $link->name }} </td>
                            <td> {{ $link->email }} </td>
                            <td class="to_hide_phone"> {{ $link->status }} </td>

                            <td class="ms"><div class="btn-group">
                                    <a class="btn btn-small links-edit" rel="tooltip" data-id="{{ $link->id }}" data-placement="left" data-original-title=" edit " href="javascript:;"><i class="gicon-edit"></i></a>
                                    <a class="btn  btn-small delete_article" rel="tooltip" data-placement="bottom" data-original-title="Remove" data-id="{{ $link->id }}"><i class="gicon-remove "></i></a> </div></td>
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
                                    <li><a href="{!! $links->previousPageUrl() !!}">Prev</a></li>
                                    <li><a href="#">{!! $links->currentPage() !!}</a></li>
                                    <li><a href="{!! $links->nextPageUrl() !!}">Next</a></li>
                                    <li><a href="#">Total {!! $links->count() !!}</a></li>
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