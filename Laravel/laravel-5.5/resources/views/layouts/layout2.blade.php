<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />

    <title>{{ $website_title or '' }}  - {{ $WEBSITE['name'] }}</title>

    <link rel="stylesheet" href="{{ tabler_assets('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ tabler_assets('css/googleapis-css-family.css') }}">


    <!-- Dashboard Core -->
    <link href="{{ tabler_assets('css/dashboard.css') }}" rel="stylesheet" />


    <script src="{{ MD() }}examples/js/jquery.min.js"></script>
</head>
<body class="">
<div class="page">
    <div class="page-main">
        <div class="header py-4">
            <div class="container">
                <div class="d-flex">
                    <a class="header-brand" href="/">
                        <img src="{{ tabler_assets('images/logo.png') }}" class="header-brand-img" alt="tabler logo">
                    </a>
                    <div class="d-flex order-lg-2 ml-auto">

                        @if ( session('id') ==  null )
                            <div class="nav-item d-none d-md-flex">
                                <a href="/user/login_page" class="btn btn-sm btn-outline-primary" target="_blank">Login</a>
                            </div>
                        @else

                        <div class="dropdown">

                            <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                                <span class="avatar" style="background-image: url(https://avatars0.githubusercontent.com/u/3666436?v=3&s=460)"></span>
                                <span class="ml-2 d-none d-lg-block">
                      <span class="text-default">张成</span>
                      <small class="text-muted d-block mt-1">Administrator</small>
                    </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                @if ( session('id') ==  1 )
                                    <a class="dropdown-item" href="/article/crete_markdown">
                                        Create Article
                                    </a>

                                    <a class="dropdown-item" href="/article/crete_markdown">
                                        Create MarkDown Article
                                    </a>
                                @else

                                @endif


                                <a class="dropdown-item" href="/user/logout">
                                    <i class="dropdown-icon fe fe-log-out"></i> Sign out
                                </a>
                            </div>
                        </div>
                        @endif


                    </div>
                    <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                        <span class="header-toggler-icon"></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 ml-auto">
                        <form class="input-icon my-3 my-lg-0">
                            <input type="search" class="form-control header-search" placeholder="Search&hellip;" tabindex="1">
                            <div class="input-icon-addon">
                                <i class="fe fe-search"></i>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg order-lg-first">
                        <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                            <li class="nav-item">
                                <a href="/" class="nav-link
                                        @if ($THIS_CONTROLLER == 'Index')
                                            active
                                        @endif
                                        "><i class="fe fe-home"></i> Home</a>
                            </li>

                            <li class="nav-item">
                                <a href="/article/index" class="nav-link
                                @if ($THIS_CONTROLLER == 'Article')
                                        active
                                @endif
                                " {{-- data-toggle="dropdown" --}}><i class="fe  fe-file-text"></i> Articles</a>
                                {{--
                                <div class="dropdown-menu dropdown-menu-arrow">

                                    <a href="/article/index" class="dropdown-item ">All Articles</a>
                                    @foreach($WebsiteCategory as $v)
                                        <a href="/article/search?category={{ $v['id'] or '' }}" title="Articles——{{ $v['name'] or '' }}"  class="dropdown-item
                                           @if ($v['id'] == $this_category)
                                            active
                                           @endif
                                        ">
                                            <b>{{ $v['name'] }}</b>
                                        </a>
                                    @endforeach
                                </div>
                                --}}
                            </li>

                            <li class="nav-item dropdown">
                                <a href="/other/projects" class="nav-link
                                @if ($THIS_ACTION == 'Other/projects')
                                        active
                                @endif
"><i class="fe  fe-box"></i>Open-Source</a>
                            </li>


                            <li class="nav-item dropdown">
                                <a href="/album/index" class="nav-link
                                        @if ($THIS_CONTROLLER == 'Album')
                                                active
                                        @endif
                                        "><i class="fe fe-check-square"></i> Pictures</a>
                            </li>
                            <li class="nav-item">
                                <a href="/other/about" class="nav-link
                                @if ($THIS_ACTION == 'Other/about')
                                        active
                                @endif
                                    "><i class="fe fe-image"></i> About Me</a>
                            </li>
                            <li class="nav-item">
                                <a href="/document/index" class="nav-link
                                        @if ($THIS_CONTROLLER == 'Document')
                                            active
                                        @endif
                                        "><i class="fe fe-file-text"></i> Documents</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-3 my-md-5">
            <div class="container">

                @section('content_title')
                    <div class="page-header">
                        <h1 class="page-title">
                            {{ $WEBSITE['CONTROLLER_NAME'] or 'Index' }}
                        </h1>
                    </div>
                @show


                @yield('content')

            </div>
        </div>
    </div>


    @yield('footer')

    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-auto ml-lg-auto">
                    <div class="row align-items-center">

                        <div class="col-auto">
                            <a href="https://github.com/phpzc/phpzc.net" class="btn btn-outline-primary btn-sm">Source code</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                    Copyright © 2018 <a href="https://www.phpzc.net" target="_blank">phpzc.net</a> All rights reserved.
                </div>
            </div>
        </div>
    </footer>
</div>
</body>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-89595309-2', 'auto');
    ga('send', 'pageview');

</script>
</html>