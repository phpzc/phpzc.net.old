<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <link type="image/x-icon" href="/favicon.png" rel="shortcut icon" />

    <title>{{ $website_title or '' }}  - {{ $WEBSITE['name'] }}</title>

    @yield('head_before')

    <!-- bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{ CUBE('css/bootstrap/bootstrap.min.css') }}" />

    <!-- RTL support - for demo only -->
    <script src="{{ CUBE('js/demo-rtl.js') }}"></script>
    <!-- libraries -->
    <link rel="stylesheet" type="text/css" href="{{ CUBE('css/libs/font-awesome.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ CUBE('css/libs/nanoscroller.css') }}" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="{{ CUBE('css/compiled/theme_styles.css') }}" />



    <!--[if lt IE 9]>
    <script src="{{ CUBE('js/html5shiv.js') }}"></script>
    <script src="{{ CUBE('js/respond.min.js') }}"></script>
    <![endif]-->
    <script src="{{ JS('core/core.js') }}"></script>
    <script src="{{ JS('lib/form.js') }}"></script>

    @yield('head')

</head>
<body class="boxed-layout">
<div id="theme-wrapper">
    <header class="navbar" id="header-navbar">
        <div class="container">
            <a href="/" id="logo" class="navbar-brand">
                <img src="{{ CUBE('img/logo.png') }}" alt="" class="normal-logo logo-white"/>
                <img src="{{ CUBE('img/logo-black.png') }}" alt="" class="normal-logo logo-black"/>
                <img src="{{ CUBE('img/logo-small.png') }}" alt="" class="small-logo hidden-xs hidden-sm hidden"/>
            </a>

            <div class="clearfix">
                <button class="navbar-toggle" data-target=".navbar-ex1-collapse" data-toggle="collapse" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="fa fa-bars"></span>
                </button>

                <div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
                    <ul class="nav navbar-nav pull-left">
                        <li>
                            <a class="btn" id="make-small-nav">
                                <i class="fa fa-bars"></i>
                            </a>
                        </li>


                        @if ( session('id') == 1)

                            <li class="dropdown hidden-xs">
                                <a class="btn dropdown-toggle" data-toggle="dropdown">
                                    UserCenter
                                    <i class="fa fa-caret-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="item">
                                        <a href="/article/mylist">My Articles</a>
                                    </li>
                                    <li class="item">
                                        <a href="/article/create" >Add Article - Use Baidu Editor</a>
                                    </li>
                                    <li class="item">
                                        <a href="/article/create_markdown" >Add Article - Use Markdown</a>
                                    </li>
                                    <if condition="$Think.session.Auth.id == 1">
                                        <li class="item">
                                            <a href="/software/create" >Add software</a>
                                        </li>

                                        <li class="item">
                                            <a href="/album/create_album" >Add Album</a>
                                        </li>

                                        <li class="item">
                                            <a href="/album/create_page" >Add Photo</a>
                                        </li>

                                    </if>
                                </ul>
                            </li>

                        @endif
                    </ul>
                </div>

                <div class="nav-no-collapse pull-right" id="header-nav">
                    <ul class="nav navbar-nav pull-right">
                        <li class="mobile-search">
                            <a class="btn">
                                <i class="fa fa-search"></i>
                            </a>

                            <div class="drowdown-search">
                                <form role="search">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Search..." name="search_word">
                                        <i class="fa fa-search nav-search-icon" onclick="search_word()"></i>
                                    </div>
                                </form>
                            </div>

                        </li>
                        <li class="dropdown profile-dropdown">

                            @if ( session('id') ==  null )
                                <a href="#" class="dropdown-toggle">
                                    <span class="hidden-xs" onclick="window.location='/user/login_page';">Sign up/Sign in</span>
                                </a>
                            @else
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    @if (session('id') == 1)

                                        <img src="https://avatars0.githubusercontent.com/u/3666436?v=3&s=460" alt=""/>
                                        @else

                                        <img src="{{ CUBE('img/samples/scarlet-159.png') }}">
                                        @endif
                                    <span class="hidden-xs">{{ session('name') or '游客' }}</span> <b class="caret"></b>
                                </a>

                            @endif

                            <ul class="dropdown-menu dropdown-menu-right">

                                <li><a href="/user/logout"><i class="fa fa-power-off"></i>Logout</a></li>
                            </ul>


                        </li>

                        @if (session('id') != null)
                            <li class="hidden-xxs">
                                <a class="btn" title="Logout" href="/user/logout">
                                    <i class="fa fa-power-off"></i>
                                </a>
                            </li>

                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div id="page-wrapper" class="container">
        <div class="row">
            <div id="nav-col">
                <section id="col-left" class="col-left-nano">
                    <div id="col-left-inner" class="col-left-nano-content">

                         @if (session('id') != null )
                            <div id="user-left-box" class="clearfix hidden-sm hidden-xs dropdown profile2-dropdown">

                                @if (session('id') == 1)
                                    <img src="https://avatars0.githubusercontent.com/u/3666436?v=3&s=460" alt=""/>
                                @else
                                    <img src="{{ CUBE('img/samples/scarlett-300.jpg') }}">
                                @endif
                                <div class="user-box">
									<span class="name">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ session('name') or '游客' }}
                                            <i class="fa fa-angle-down"></i>
                                        </a>
										<ul class="dropdown-menu">

                                            <li><a href="/user/logout"><i class="fa fa-power-off"></i>Logout</a></li>
                                        </ul>
									</span>
                                    <span class="status">
										<i class="fa fa-circle"></i> Online
									</span>
                                </div>
                            </div>

                        @endif
                        <div class="collapse navbar-collapse navbar-ex1-collapse" id="sidebar-nav">
                            <ul class="nav nav-pills nav-stacked">

                                <li
                                        @if ($THIS_CONTROLLER == 'Index')
                                        class="active"
                                        @endif >
                                <a href="/">
                                    <i class="fa fa-dashboard"></i>
                                    <span>Index</span>
                                </a>
                                </li>

                                <li @if ($THIS_CONTROLLER == 'Article')
                                    class="active"
                                        @endif >
                                <a href="#" class="dropdown-toggle">
                                    <i class="fa fa-file-text-o"></i>
                                    <span>Articles</span>
                                    <i class="fa fa-angle-right drop-icon"></i>
                                </a>
                                <ul class="submenu">
                                    <li>
                                        <a href="/article/index">
                                            All Articles
                                        </a>

                                        @foreach($WebsiteCategory as $v)
                                            <a href="/Article/search/category/{{ $v['id'] or '' }}" title="Articles——{{ $v['name'] or '' }}"
                                            @if ($v['id'] == $this_category)
                                                class="active"
                                            @endif
                                            >
                                            <b>{$WebCategory.name}</b>
                                            </a>
                                        @endforeach
                                    </li>

                                </ul>

                                </li>

                                <li
                                    @if ($THIS_ACTION == 'Other/projects')
                                        class="active"
                                    @endif
                                >
                                <a href="/Other/projects" title="Projects on GitHub">
                                    <i class="fa fa-file-text"></i>
                                    <span>Open-Source</span>
                                </a>
                                </li>

                                <!--添加project文章 -->
                                @foreach ($MENU_PROJECT as $project_data)

                                    <li
                                    @if ($THIS_PROJECT_ID == $project_data['project_id'])
                                        class="active"
                                    @endif
                                    >
                                    <a href="#" class="dropdown-toggle" >
                                        <i class="fa fa-file-text"></i>
                                        <span>{{ $project_data['name'] or '' }}</span>
                                        <i class="fa fa-angle-right drop-icon"></i>
                                    </a>
                                    <ul class="submenu">

                                         @foreach($project_data['summary'] as $summary_data)
                                            <li
                                                @if (isset($summary_data['class_active']) && ($summary_data['class_active'] == '1') )
                                                class="active"
                                                @endif
                                            >
                                            <a href="#" class="dropdown-toggle">

                                                {{ $summary_data['chap_name'] or '' }}
                                                <i class="fa fa-angle-right drop-icon"></i>
                                            </a>

                                            <ul class="submenu">

                                                @foreach ($summary_data['sub_data'] as $article_data)
                                                    <li >
                                                        <a href="/project/detail?id={{ $article_data['id'] or '' }}" class='@if ($this_id == $article_data['id']) active @endif' >
                                                            {$article_data.title}
                                                        </a>
                                                    </li>
                                                 @endforeach
                                            </ul>
                                            </li>
                                        @endforeach

                                    </ul>

                                    </li>
                                @endforeach


                            <?php
                            $get_file = isset($_GET['file']) ? $_GET['file']:'';

                            function fetch_nginx_code_menu(&$data){
                                global $get_file;

                                foreach($data as &$v){


                                    if($v['is_file'] == 0){
                                        echo '<li><a href="#" class="dropdown-toggle" >'.$v['name'].'<i class="fa fa-angle-right drop-icon"></i></a>';
                                        if(!empty($v['next'])){
                                            echo '<ul class="submenu">';
                                            fetch_nginx_code_menu($v['next']);
                                            echo '</ul>';
                                        }
                                        echo '</li>';
                                    }else{
                                        if($get_file == $v['file']){

                                            echo '<li class="active"><a href="/file/cat?file='.$v['file'].'">'.$v['name'].'</a></li>
                            ';
                                        }else{
                                            echo '<li><a href="/file/cat?file='.$v['file'].'">'.$v['name'].'</a></li>
                            ';
                                        }
                                    }
                                }
                            }
                            ?>
                            <!-- nginx源码注释 -->

                                @foreach($WebsiteCacheNginx as $cache_nginx_code)
                                    <li @if($THIS_CONTROLLER == 'File')
                                        class="active"
                                            @endif
                                        >
                                    <a href="#" class="dropdown-toggle" >
                                        <i class="fa fa-file-text"></i>
                                        <span>{{ $cache_nginx_code['name'] or '' }}</span>
                                        <i class="fa fa-angle-right drop-icon"></i>

                                    </a>
                                    <ul class="submenu">
                                        <?php
                                        fetch_nginx_code_menu($cache_nginx_code['next']);
                                        ?>

                                    </ul>
                                    </li>
                                @endforeach



                                <li @if ($THIS_CONTROLLER == 'Document')
                                        class='active'
                                    @endif >
                                <a href="/document">
                                    <i class="fa fa-copy"></i>
                                    <span>Documents</span>
                                </a>
                                </li>


                                <li @if ($THIS_CONTROLLER == 'Album')
                                    class='active'
                                        @endif >
                                <a href="/album">
                                    <i class="fa fa-image"></i>
                                    <span>Pictures</span>

                                </a>
                                </li>



                                <li
                                @if ($THIS_ACTION == 'Other/about')
                                    class='active'
                                @endif
                                >
                                <a href="/Other/about">
                                    <i class="fa fa-copy"></i>
                                    <span>About Me</span>
                                </a>
                                </li>

                                <li
                                @if ($THIS_CONTROLLER == 'Book')
                                    class='active'
                                @endif
                                >
                                <a href="/Book/search">
                                    <i class="fa fa-copy"></i>
                                    <span>FreeStory</span>
                                </a>
                                </li>


                            </ul>

                        </div>
                    </div>
                </section>
                <div id="nav-col-submenu"></div>
            </div>
            <div id="content-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="content-header" class="clearfix">
                            <div class="pull-left">
                                <ol class="breadcrumb">
                                    <li><a href="/">Home</a></li>
                                    <li class="active"><span>
                                        {{ $WEBSITE['CONTROLLER_NAME'] or '' }}
                                        </span></li>
                                </ol>

                                <h1>{{  $bread_crumbs or '' }}</h1>
                            </div>

                        </div>
                    </div>
                </div>

                @yield('content')

                <footer id="footer-bar" class="row" style="height:50px">
                    <p id="footer-copyright" class="col-xs-12">
                        Powered by ZhangCheng - 前台 Use Laravel&nbsp; &nbsp;|&nbsp;
                        后台 Use Laravel&nbsp;<img src="{{ PUBLICS('img/laravel.png') }}" style="height:30px;"/> - 京ICP备14007760-3号

                        <a target="_blank" href="//shang.qq.com/wpa/qunwpa?idkey=b311b1762c5bb3cd033bbb3683ca1fbc8a4f66627d7dcb08e73242db391172b6"><img border="0" src="//pub.idqqimg.com/wpa/images/group.png" alt="C++/PHP开源交流群" title="C++/PHP开源交流群"></a>
                    </p>

                </footer>
            </div>
        </div>
    </div>
</div>

<div id="config-tool" class="closed">
    <a id="config-tool-cog">
        <i class="fa fa-cog"></i>
    </a>

    <div id="config-tool-options">
        <!--
        <h4>Layout Options</h4>
        <ul>
            <li>
                <div class="checkbox-nice">
                    <input type="checkbox" id="config-fixed-header" />
                    <label for="config-fixed-header">
                        Fixed Header
                    </label>
                </div>
            </li>
            <li>
                <div class="checkbox-nice">
                    <input type="checkbox" id="config-fixed-sidebar" />
                    <label for="config-fixed-sidebar">
                        Fixed Left Menu
                    </label>
                </div>
            </li>
            <li>
                <div class="checkbox-nice">
                    <input type="checkbox" id="config-fixed-footer" />
                    <label for="config-fixed-footer">
                        Fixed Footer
                    </label>
                </div>
            </li>
            <li>
                <div class="checkbox-nice">
                    <input type="checkbox" id="config-boxed-layout" />
                    <label for="config-boxed-layout">
                        Boxed Layout
                    </label>
                </div>
            </li>
            <li>
                <div class="checkbox-nice">
                    <input type="checkbox" id="config-rtl-layout" />
                    <label for="config-rtl-layout">
                        Right-to-Left
                    </label>
                </div>
            </li>
        </ul>
        <br/>
        -->
        <h4>Skin Color</h4>
        <ul id="skin-colors" class="clearfix">
            <li>
                <a class="skin-changer" data-skin="" data-toggle="tooltip" title="Default" style="background-color: #34495e;">
                </a>
            </li>
            <li>
                <a class="skin-changer" data-skin="theme-white" data-toggle="tooltip" title="White/Green" style="background-color: #2ecc71;">
                </a>
            </li>
            <li>
                <a class="skin-changer blue-gradient" data-skin="theme-blue-gradient" data-toggle="tooltip" title="Gradient">
                </a>
            </li>
            <li>
                <a class="skin-changer" data-skin="theme-turquoise" data-toggle="tooltip" title="Green Sea" style="background-color: #1abc9c;">
                </a>
            </li>
            <li>
                <a class="skin-changer" data-skin="theme-amethyst" data-toggle="tooltip" title="Amethyst" style="background-color: #9b59b6;">
                </a>
            </li>
            <li>
                <a class="skin-changer" data-skin="theme-blue" data-toggle="tooltip" title="Blue" style="background-color: #2980b9;">
                </a>
            </li>
            <li>
                <a class="skin-changer" data-skin="theme-red" data-toggle="tooltip" title="Red" style="background-color: #e74c3c;">
                </a>
            </li>
            <li>
                <a class="skin-changer" data-skin="theme-whbl" data-toggle="tooltip" title="White/Blue" style="background-color: #3498db;">
                </a>
            </li>
        </ul>
    </div>
</div>


<div style="display: block; background-position: 0px 0px; margin-top: -125px;" id="rocket-to-top">

    <div style="opacity: 0; display: block;" class="level-2"></div>

    <div class="level-3"></div>

</div>


<!-- global scripts -->
<script src="{{ CUBE('js/demo-skin-changer.js') }}"></script> <!-- only for demo -->

<script src="{{ CUBE('js/jquery.js') }}"></script>
<script src="{{ CUBE('js/bootstrap.js') }}"></script>
<script src="{{ CUBE('js/jquery.nanoscroller.min.js') }}"></script>
<script src="{{ CUBE('js/demo.js') }}"></script>

<link href="{{ PUBLICS('good_effect/huojian/style.css') }}" rel="stylesheet" type="text/css">

<script src="{{ PUBLICS('good_effect/huojian/script.js') }}" type="text/javascript"></script>


<!-- theme scripts -->
<script src="{{ CUBE('js/scripts.js') }}"></script>
<script src="{{ CUBE('js/pace.min.js') }}"></script>
<script>
    $('body').addClass('boxed-layout');
    try{
        var storage = window.localStorage

        var boxedLayout = localStorage.getItem('config-boxed-layout');

        if (boxedLayout != 'boxed-layout') {
            writeStorage(storage, 'config-boxed-layout', 'boxed-layout');
        }

    }catch (e){

    }


    function search_word()
    {
        var s = $('input[name=search_word]').val();

        window.open ('{{ $WEBSITE['url'] }}/article/search?category='+s,'newwindow','height=600,width=800,top=100,left=200,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,status=no')
    }



</script>

@yield('after')


<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-89595309-2', 'auto');
    ga('send', 'pageview');

</script>
</body>
</html>