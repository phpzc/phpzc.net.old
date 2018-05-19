@extends('layouts.main')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ CUBE('/css/libs/jquery.nouislider.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="main-box clearfix">

            <header class="main-box-header clearfix">
                <h2>{{ $project['name'] or '' }}</h2>
            </header>

            <div class="col-lg-12">
                <div class="main-box clearfix">
                    <header class="main-box-header clearfix">
                        <h2>Project name</h2>
                    </header>

                    <div class="main-box-body clearfix">
                        <div class="panel-group accordion" id="accordion">

                            <volist name="summary" id="result">
                            @foreach($summary as $result)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $result['id'] or '' }}">
                                                {{ $result['chap_name'] or '' }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse{{ $result['id'] or ''}}" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <p>Child Chap</p>
                                            <p><a href="/project/add_article?project_id={{ $result['project_id'] or '' }}&id={{ $result['id'] or ''}}">Add Article</a></p>
                                            <div class="table-responsive">
                                                <table class="table user-list table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th><span>Article Name</span></th>
                                                        <th><span>Action</span></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach($result['sub_data'] as $v)
                                                        <tr>
                                                            <td>
                                                                <span class="user-subhead">{{ $v['title'] }}</span>
                                                            </td>
                                                            <td>
                                                                <a href="/article/detail?id={{ encodeId($v['id']) }}" class="table-link">
																	<span class="fa-stack">
																		<i class="fa fa-square fa-stack-2x"></i>
																		<i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
																	</span>
                                                                </a>

                                                                <a href="/project/project_remove_subject?id={{ $result['id'] or '' }}&aid={{ $v['id'] or ''}}" class="table-link" title="delete">
																	<span class="fa-stack">
																		<i class="fa fa-edit fa-stack-2x"></i>
																		<i class="fa  fa-stack-1x fa-remove"></i>
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

                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('after')
    <script src="{{ CUBE('/js/jquery.nouislider.js') }}"></script>

@endsection