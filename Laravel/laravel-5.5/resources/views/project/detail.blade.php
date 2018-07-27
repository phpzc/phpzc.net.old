@extends('layouts.layout2')

@section('content_title')
@endsection

@section('content')
    <script type="text/javascript" charset="utf-8" src="{{ UEDITOR('/third-party/SyntaxHighlighter/shCore.js') }}"></script>

    @if ($article['type'] == 0)

        <link rel="stylesheet" type="text/css" href="{{ UEDITOR('/third-party/SyntaxHighlighter/shCoreDefault.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ CUBE('/css/libs/magnific-popup.css') }}">

        <script type="text/javascript" charset="utf-8" src="{{ UEDITOR('ueditor.config.js')  }}"></script>
        <script type="text/javascript" charset="utf-8" src="{{ UEDITOR('ueditor.all.min.js') }}"> </script>
        <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
        <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
        <script type="text/javascript" charset="utf-8" src="{{ UEDITOR('lang/zh-cn/zh-cn.js') }}"></script>


        <!--公式插件 -->
        <script type="text/javascript" charset="utf-8" src="/Public/baidu/UEditor/kityformula-plugin/addKityFormulaDialog.js"></script>
        <script type="text/javascript" charset="utf-8" src="/Public/baidu/UEditor/kityformula-plugin/getKfContent.js"></script>
        <script type="text/javascript" charset="utf-8" src="/Public/baidu/UEditor/kityformula-plugin/defaultFilterFix.js"></script>


    @endif

    <link rel="stylesheet" href="{{ MD('/css/editormd.preview.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/social-share.js/1.0.15/css/share.min.css" />





    <div class="row" id="article_show">

        @component('article.right',['top'=>$top,'links'=>$links])

        @endcomponent

        <div class="col-lg-8" id="article_list" >
            <div class="card">
                <div class="card-body">


                    <div class="main-box clearfix">


                        <h3>{{ $article['title'] }}</h3>

                        <div class="d-flex align-items-center px-2">
                            <div class="avatar avatar-md mr-3" style="background-image: url(https://avatars0.githubusercontent.com/u/3666436?v=3&s=460)"></div>
                            <div>
                                <div>{{ $article['name'] }}</div>
                                <small class="d-block text-muted"> {{ $article['year'] }}/{{ $article['month'] }}</small>
                            </div>
                            <div class="ml-auto text-muted">
                                <a href="javascript:void(0)" class="icon"><i class="fe fe-eye mr-1"></i>  {{ $article['visit'] }}</a>

                            </div>

                            @if (session('id') == $article['uid'])
                                <div class="story-time" style="float:right;padding-right:20px">
                                    <a href="/article/edit?id={{ $article['id'] }}">修改</a>
                                </div>
                            @endif

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


                        </div>

                    </div>

                    @if ($article['type'] == 0)
                        <script>
                            SyntaxHighlighter.highlight();
                        </script>

                @endif

                <!--PC版-->
                    <div id="SOHUCS" sid="{{ $article['id'] }}"></div>
                    <script charset="utf-8" type="text/javascript" src="https://changyan.sohu.com/upload/changyan.js" ></script>
                    <script type="text/javascript">
                        window.changyan.api.config({
                            appid: 'cyt9FQgps',
                            conf: 'prod_e3220b887fd745b0f30b968992ed5a02'
                        });
                    </script>
                </div>
            </div>
        </div>


    </div>


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

