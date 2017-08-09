@extends('layouts.main')

@section('head')
    <script type="text/javascript" charset="utf-8" src="{{ UEDITOR('/third-party/SyntaxHighlighter/shCore.js') }}"></script>

    @if ($article['type'] == 0)

    <link rel="stylesheet" type="text/css" href="{{ UEDITOR('/third-party/SyntaxHighlighter/shCoreDefault.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ CUBE('/css/libs/magnific-popup.css') }}">

   @endif

    <link rel="stylesheet" href="{{ MD('/css/editormd.preview.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/social-share.js/1.0.15/css/share.min.css" />

@endsection



@section('content')
    <div class="row" id="article_show">
        <div class="col-lg-12" id="article_list" >
            <div class="main-box clearfix">

                <header class="main-box-header" >
                    <h2>{{ $article['title'] }}</h2>
                </header>
                <div class="story-content clearfix">
                    <div class="story-author" style="float:left;padding-left:20px">
                        <a href="#">{{ $article['name'] }}</a>
                    </div>


                    @if (session('id') == $article['uid'])
                    <div class="story-time" style="float:right;padding-right:20px">
                        <a href="/article/edit?id={{ $article['id'] }}">修改</a>
                    </div>
                    @endif

                    <div class="story-time" style="float:right;padding-right:20px">
                        <i class="fa fa-clock-o"></i> {{ $article['year'] }}/{{ $article['month'] }}
                    </div>

                </div>
                <style>
                    .main-box-body img{
                        max-width: 100%;
                    }

                </style>
                <hr>
                <div class="main-box-body " id="test-editormd">
                    @if ($article['type'] == 1)

                    <textarea id="append-test" style="display:none;">{!! $article['markdown']  !!}</textarea>
                    @else
                    {!! $article['content'] !!}
                    @endif
                </div>


                <div class="main-box-body ">
                    <div class="row" >
                        <div class="social-share" style="margin-left: 4em;margin-top: 4em;"></div>
                    </div>
                    <hr>
                    <div class="pre_page">上一篇：

                        @if (!isset($article_pre['id']))
                            没有了
                        @else
                            <a href="/article/detail?id={{ $article_pre['id'] }}"><button type="button" class="btn btn-success">{{ $article_pre['title'] }}</button></a>
                        @endif
                    </div>
                    <hr>
                    <div class="next_page">下一篇：

                        @if (!isset($article_next['id']))
                            没有了
                        @else
                            <a href="/article/detail?id={{ $article_next['id'] }}"><button type="button" class="btn btn-success">{{ $article_next['title'] }}</button></a>
                        @endif
                    </div>
                </div>

            </div>

            <script>
                SyntaxHighlighter.highlight();
            </script>

            <!-- UY BEGIN -->
            <div id="uyan_frame"></div>
            <script type="text/javascript" src="/article/youyan"></script>
            <!-- UY END -->


        </div>


    </div>
@endsection


@section('after')

    @if ($article['type'] == 1)

    <script src="{{ MD() }}examples/js/jquery.min.js"></script>

    <script src="{{ MD() }}lib/marked.min.js"></script>
    <script src="{{ MD() }}lib/prettify.min.js"></script>

    <script src="{{ MD() }}lib/raphael.min.js"></script>
    <script src="{{ MD() }}lib/underscore.min.js"></script>
    <script src="{{ MD() }}lib/sequence-diagram.min.js"></script>
    <script src="{{ MD() }}lib/flowchart.min.js"></script>
    <script src="{{ MD() }}lib/jquery.flowchart.min.js"></script>

    <script src="{{ MD() }}editormd.js"></script>
    <script>

        var  testEditormdView2;

        $(function() {
            testEditormdView2 = editormd.markdownToHTML("test-editormd", {
                //markdown        : markdown ,//+ "\r\n" + $("#append-test").text(),
                //htmlDecode      : true,       // 开启 HTML 标签解析，为了安全性，默认不开启
                htmlDecode      : "style,script,iframe",  // you can filter tags decode
                //toc             : false,
                tocm            : true,    // Using [TOCM]
                //tocContainer    : "#custom-toc-container", // 自定义 ToC 容器层
                //gfm             : false,
                //tocDropdown     : true,
                // markdownSourceCode : true, // 是否保留 Markdown 源码，即是否删除保存源码的 Textarea 标签
                emoji           : true,
                taskList        : true,
                tex             : true,  // 默认不解析
                flowChart       : true,  // 默认不解析
                sequenceDiagram : true,  // 默认不解析
            });
        });


    </script>

    @endif

    <script type="text/javascript" charset="utf-8" src="https://cdnjs.cloudflare.com/ajax/libs/social-share.js/1.0.15/js/social-share.min.js"></script>

@endsection
