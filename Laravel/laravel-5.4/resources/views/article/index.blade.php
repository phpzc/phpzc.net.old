@extends('layouts.main')
@section('head')
    <link rel="stylesheet" type="text/css" href="{{ CUBE('/css/libs/timeline.css') }}">
@endsection

@section('content')

    <div class="row">

        <div class="col-lg-12">
            <div class="main-box clearfix">
                <header class="main-box-header clearfix">
                    <h2>All Articles</h2>
                </header>

                <div class="row">
                    <div class="col-lg-12">
                        <section id="cd-timeline" class="cd-container">

                            <volist name="article_list" id="article_list">

                            @foreach($articles as $article)
                                <div class="cd-timeline-block">
                                    <div class="cd-timeline-img cd-location">
                                        <i class="fa fa-map-marker fa-2x"></i>
                                    </div>

                                    <div class="cd-timeline-content">
                                        <h2><a href="/article/detail?id={{ $article['id'] }}">{{ cut_str( htmlspecialchars_decode($article['title']), 40) }}</a></h2>

                                        <p style="word-break:break-all;word-wrap:break-word ;">{{ cut_str($article['content'],300) }} </p>
                                        <div class="clearfix">
                                            <a class="btn btn-primary pull-right"
                                               href="/article/detail?id={{ $article['id'] }}"
                                               target="_blank">
                                                Read more
                                            </a>
                                        </div>
                                        <span class="cd-date">
                                            {{ date('Y/m/d',$article['time']) }}

									</span>
                                    </div>
                                </div>

                            @endforeach
                        </section>
                    </div>
                </div>
                <div class="main-box-body clearfix">
                    <div style="float:right">{{ $page->links() }}</div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('after')

    <!-- this page specific scripts -->
    <script src="{{ CUBE('/js/modernizr.js') }}"></script>
    <script src="{{ CUBE('js/timeline.js') }}"></script>

@endsection
