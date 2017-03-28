@extends('layouts.main')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ CUBE('/css/libs/jquery.nouislider.css') }}">

@endsection

@section('content')
    <div class="row">
        <div class="main-box clearfix">

            <header class="main-box-header clearfix">
                <h2>All Projects</h2>
            </header>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">
                    <div class="main-box-body clearfix">
                        <div class="table-responsive">
                            <table class="table user-list table-hover">
                                <thead>
                                <tr>
                                    <th><span>Project Name</span></th>
                                    <th><span>Action</span></th>
                                </tr>
                                </thead>
                                <tbody>

                                    @foreach($project as $v)
                                    <tr>
                                        <td>
                                            <span class="user-subhead">{{ $v['name'] or '' }}</span>
                                        </td>
                                        <td>
                                            <a href="/project/project_index?id={{ $v['project_id'] }}" class="table-link">
																	<span class="fa-stack">
																		<i class="fa fa-square fa-stack-2x"></i>
																		<i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
																	</span>
                                            </a>

                                            <a href="/project/project_add_subject?id={{ $v['project_id'] }}" class="table-link" title="delete">
																	<span class="fa-stack">
																		<i class="fa fa-edit fa-stack-2x"></i>
																		<i class="fa  fa-stack-1x fa-edit"></i>
																	</span>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection
