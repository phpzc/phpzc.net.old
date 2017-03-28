@extends('layouts.main')

@section('head')
    <script type="text/javascript" charset="utf-8" src="{{ UEDITOR('/third-party/SyntaxHighlighter/shCore.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="{{ UEDITOR('/third-party/SyntaxHighlighter/shCoreDefault.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ CUBE('/css/libs/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ MD('/css/editormd.preview.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/social-share.js/1.0.15/css/share.min.css" />
@endsection

@section('content')
    <div class="row" id="article_show">
        <div class="col-lg-12" id="article_list" >
            <div class="main-box clearfix">

                <header class="main-box-header" >
                    <h2>源码分析:{{ $title }}</h2>
                </header>
                <div class="story-content clearfix">
                </div>
                <style>
                    .main-box-body img{
                        max-width: 100%;
                    }
                </style>
                <hr>
                <div class="main-box-body " id="test-editormd">

                    <textarea id="append-test" style="display:none;">```
                        {{ $content }}
                    ```
                    </textarea>

                </div>



                <div class="main-box-body ">
                    <div class="row" >
                        <div class="social-share" style="margin-left: 4em;margin-top: 4em;"></div>
                    </div>
                    <hr>
                </div>

            </div>

            {//评论功能}

            <!-- 多说评论框 start -->
            <div class="ds-thread" data-thread-key="{{ $file }}" data-title="源码分析:{{ $file }}" data-url="<?php echo get_site_url();?>/file/cat?file={{ $file }}">

            </div>
            <!-- 多说评论框 end -->
            <!-- 多说公共JS代码 start (一个网页只需插入一次) -->
            <script type="text/javascript">
                var duoshuoQuery = {short_name:"peakpointer"};
                (function() {
                    var ds = document.createElement('script');
                    ds.type = 'text/javascript';ds.async = true;
                    ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
                    ds.charset = 'UTF-8';
                    (document.getElementsByTagName('head')[0]
                    || document.getElementsByTagName('body')[0]).appendChild(ds);
                })();
            </script>
            <!-- 多说公共JS代码 end -->

        </div>


    </div>


@endsection


@section('after')


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


    <script type="text/javascript" charset="utf-8" src="https://cdnjs.cloudflare.com/ajax/libs/social-share.js/1.0.15/js/social-share.min.js"></script>

@endsection