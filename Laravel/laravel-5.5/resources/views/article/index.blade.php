@extends('layouts.layout')


@section('content')
    <link rel="stylesheet" href="{{ tabler_assets('css/bootstrap_pagination.css') }}">

    <div class="row">

        @component('article.right',['top'=>$top,'links'=>$links])

        @endcomponent

        <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12">

                            @foreach($articles as $article)
                                <div class="row">


                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title"><a href="/article/detail?id={{ $article['id'] }}">{{ cut_str( htmlspecialchars_decode($article['title']), 40) }}</a></h3>
                                        </div>

                                        <div class="card-body">
                                        <p style="word-break:break-all;word-wrap:break-word ;">{{ cut_str($article['content'],300) }} </p>
                                        </div>
                                        <div class="card-footer">
                                            <div class="d-flex align-items-center px-2">
                                            <div class="avatar avatar-md mr-3" style="background-image: url(https://avatars0.githubusercontent.com/u/3666436?v=3&s=460)"></div>
                                            <div>
                                                <div>张成</div>
                                                <small class="d-block text-muted">{{ date('Y/m/d',$article['time']) }}</small>
                                            </div>
                                            <div class="ml-auto text-muted">
                                                <a href="javascript:void(0)" class="icon"><i class="fe fe-eye mr-1"></i> {{ $article['visit'] }}</a>
                                                <a href="/article/detail?id={{ $article['id'] }}" class="btn btn-primary" style="margin-left: 1em;">Read</a>
                                            </div>

                                        </div>
                                        </div>

                                    </div>
                                </div>

                            @endforeach

                    </div>
                </div>
                <div class="main-box-body clearfix">
                    <div class="pull-right">{{ $page->links() }}</div>
                </div>
        </div>

    </div>

@endsection


