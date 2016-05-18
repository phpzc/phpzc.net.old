<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {# 标题 #}
        {{  tag.getTitle() }}

        {{ javascript_include('213') }}
        {{ stylesheetLink('2131') }}



        <!-- bootstrap -->
        <link rel="stylesheet" type="text/css" href="{{ CUBE() }}/css/bootstrap/bootstrap.min.css" />

        <!-- RTL support - for demo only -->
        <script src="{{ CUBE() }}/js/demo-rtl.js"></script>
        <!-- libraries -->
        <link rel="stylesheet" type="text/css" href="{{ CUBE() }}/css/libs/font-awesome.css" />
        <link rel="stylesheet" type="text/css" href="{{ CUBE() }}/css/libs/nanoscroller.css" />

        <!-- global styles -->
        <link rel="stylesheet" type="text/css" href="{{ CUBE() }}/css/compiled/theme_styles.css" />


        <!-- Favicon -->
        <link type="image/x-icon" href="favicon.png" rel="shortcut icon" />


        <!--[if lt IE 9]>
        <script src="{{ CUBE() }}/js/html5shiv.js"></script>
        <script src="{{ CUBE() }}/js/respond.min.js"></script>
        <![endif]-->
        <script src="{{ JS() }}/js/core/core.js"></script>
        <script src="{{ JS() }}/js/lib/form.js"></script>

        {# 头部 css js加载 #}
        {% block head %}

        {% endblock %}
    </head>
    <body>
    <body class="boxed-layout">
    <div id="theme-wrapper">
        <header class="navbar" id="header-navbar">
            <div class="container">
                <a href="/index.html" id="logo" class="navbar-brand">
                    <img src="{{ CUBE() }}/img/logo.png" alt="" class="normal-logo logo-white"/>
                    <img src="{{ CUBE() }}/img/logo-black.png" alt="" class="normal-logo logo-black"/>
                    <img src="{{ CUBE() }}/img/logo-small.png" alt="" class="small-logo hidden-xs hidden-sm hidden"/>
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
                            <!--
                            <li class="dropdown hidden-xs">
                                <a class="btn dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell"></i>
                                    <span class="count">8</span>
                                </a>
                                <ul class="dropdown-menu notifications-list">
                                    <li class="pointer">
                                        <div class="pointer-inner">
                                            <div class="arrow"></div>
                                        </div>
                                    </li>
                                    <li class="item-header">You have 6 new notifications</li>
                                    <li class="item">
                                        <a href="#">
                                            <i class="fa fa-comment"></i>
                                            <span class="content">New comment on 窶連wesome P...</span>
                                            <span class="time"><i class="fa fa-clock-o"></i>13 min.</span>
                                        </a>
                                    </li>
                                    <li class="item">
                                        <a href="#">
                                            <i class="fa fa-plus"></i>
                                            <span class="content">New user registration</span>
                                            <span class="time"><i class="fa fa-clock-o"></i>13 min.</span>
                                        </a>
                                    </li>
                                    <li class="item">
                                        <a href="#">
                                            <i class="fa fa-envelope"></i>
                                            <span class="content">New Message from George</span>
                                            <span class="time"><i class="fa fa-clock-o"></i>13 min.</span>
                                        </a>
                                    </li>
                                    <li class="item">
                                        <a href="#">
                                            <i class="fa fa-shopping-cart"></i>
                                            <span class="content">New purchase</span>
                                            <span class="time"><i class="fa fa-clock-o"></i>13 min.</span>
                                        </a>
                                    </li>
                                    <li class="item">
                                        <a href="#">
                                            <i class="fa fa-eye"></i>
                                            <span class="content">New order</span>
                                            <span class="time"><i class="fa fa-clock-o"></i>13 min.</span>
                                        </a>
                                    </li>
                                    <li class="item-footer">
                                        <a href="#">
                                            View all notifications
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown hidden-xs">
                                <a class="btn dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="count">16</span>
                                </a>
                                <ul class="dropdown-menu notifications-list messages-list">
                                    <li class="pointer">
                                        <div class="pointer-inner">
                                            <div class="arrow"></div>
                                        </div>
                                    </li>
                                    <li class="item first-item">
                                        <a href="#">
                                            <img src="__CUBE__/img/samples/messages-photo-1.png" alt=""/>
                                            <span class="content">
                                                <span class="content-headline">
                                                    George Clooney
                                                </span>
                                                <span class="content-text">
                                                    Look, just because I don't be givin' no man a foot massage don't make it
                                                    right for Marsellus to throw...
                                                </span>
                                            </span>
                                            <span class="time"><i class="fa fa-clock-o"></i>13 min.</span>
                                        </a>
                                    </li>
                                    <li class="item">
                                        <a href="#">
                                            <img src="__CUBE__/img/samples/messages-photo-2.png" alt=""/>
                                            <span class="content">
                                                <span class="content-headline">
                                                    Emma Watson
                                                </span>
                                                <span class="content-text">
                                                    Look, just because I don't be givin' no man a foot massage don't make it
                                                    right for Marsellus to throw...
                                                </span>
                                            </span>
                                            <span class="time"><i class="fa fa-clock-o"></i>13 min.</span>
                                        </a>
                                    </li>
                                    <li class="item">
                                        <a href="#">
                                            <img src="__CUBE__/img/samples/messages-photo-3.png" alt=""/>
                                            <span class="content">
                                                <span class="content-headline">
                                                    Robert Downey Jr.
                                                </span>
                                                <span class="content-text">
                                                    Look, just because I don't be givin' no man a foot massage don't make it
                                                    right for Marsellus to throw...
                                                </span>
                                            </span>
                                            <span class="time"><i class="fa fa-clock-o"></i>13 min.</span>
                                        </a>
                                    </li>
                                    <li class="item-footer">
                                        <a href="#">
                                            View all messages
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown hidden-xs">
                                <a class="btn dropdown-toggle" data-toggle="dropdown">
                                    New Item
                                    <i class="fa fa-caret-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="item">
                                        <a href="#">
                                            <i class="fa fa-archive"></i>
                                            New Product
                                        </a>
                                    </li>
                                    <li class="item">
                                        <a href="#">
                                            <i class="fa fa-shopping-cart"></i>
                                            New Order
                                        </a>
                                    </li>
                                    <li class="item">
                                        <a href="#">
                                            <i class="fa fa-sitemap"></i>
                                            New Category
                                        </a>
                                    </li>
                                    <li class="item">
                                        <a href="#">
                                            <i class="fa fa-file-text"></i>
                                            New Page
                                        </a>
                                    </li>
                                </ul>
                            </li>
    -->
                            {% if session.get('Auth.id') != '' %}
                                <li class="dropdown hidden-xs">
                                    <a class="btn dropdown-toggle" data-toggle="dropdown">
                                        UserCenter
                                        <i class="fa fa-caret-down"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="item">
                                            <a href="#">My Articles</a>
                                        </li>
                                        <li class="item">
                                            <a href="/article/create" >Add Article</a>
                                        </li>
                                        {% if session.get('Auth.id') == 1 %}
                                            <li class="item">
                                                <a href="/software/create" >Add software</a>
                                            </li>

                                            <li class="item">
                                                <a href="/album/create_album" >Add Album</a>
                                            </li>

                                            <li class="item">
                                                <a href="/album/create_page" >Add Photo</a>
                                            </li>

                                        {% endif %}
                                    </ul>
                                </li>

                            {% endif %}
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
                                {% if session.get('Auth.id') != '' %}
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        {% if session.get('Auth.id') == 1 %}
                                            <img src="https://avatars0.githubusercontent.com/u/3666436?v=3&s=460" alt=""/>
                                        {% else %}
                                            <img src="{{ CUBE() }}/img/samples/scarlet-159.png">
                                        {% endif %}
                                        <span class="hidden-xs">{{  session.get('Auth.name')|default('游客') }}</span> <b class="caret"></b>
                                    </a>
                                {% else %}
                                    <a href="#" class="dropdown-toggle">
                                        <span class="hidden-xs" onclick="window.location='/user/login_page';">Sign up/Sign in</span>
                                    </a>
                                {% endif %}


                                <ul class="dropdown-menu dropdown-menu-right">
                                    <!--<li><a href="user-profile.html"><i class="fa fa-user"></i>Profile</a></li>
                                    <li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
                                    <li><a href="#"><i class="fa fa-envelope-o"></i>Messages</a></li>-->
                                    <li><a href="/user/logout"><i class="fa fa-power-off"></i>Logout</a></li>
                                </ul>


                            </li>
                            {% if session.get('Auth.id') != '' %}
                                <li class="hidden-xxs">
                                    <a class="btn" title="Logout" href="/user/logout">
                                        <i class="fa fa-power-off"></i>
                                    </a>
                                </li>
                            {% endif %}
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
                            {% if session.has('Auth.id')  %}
                                <div id="user-left-box" class="clearfix hidden-sm hidden-xs dropdown profile2-dropdown">
                                    {% if session.get('Auth.id') == 1 %}
                                        <img src="https://avatars0.githubusercontent.com/u/3666436?v=3&s=460" alt=""/>
                                    {% else %}
                                        <img src="{{ CUBE() }}/img/samples/scarlett-300.jpg">
                                    {% endif %}
                                    <div class="user-box">
									<span class="name">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            {{ session.get('Auth.name')|default('游客') }}
                                            <i class="fa fa-angle-down"></i>
                                        </a>
										<ul class="dropdown-menu">
                                            <!--
                                            <li><a href="user-profile.html"><i class="fa fa-user"></i>Profile</a></li>
                                            <li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
                                            <li><a href="#"><i class="fa fa-envelope-o"></i>Messages</a></li>-->
                                            <li><a href="/user/logout"><i class="fa fa-power-off"></i>Logout</a></li>
                                        </ul>
									</span>
									<span class="status">
										<i class="fa fa-circle"></i> Online
									</span>
                                    </div>
                                </div>
                            {% endif %}
                            <div class="collapse navbar-collapse navbar-ex1-collapse" id="sidebar-nav">
                                <ul class="nav nav-pills nav-stacked">
                                    <!--
                                    <li class="nav-header nav-header-first hidden-sm hidden-xs">
                                        Navigation
                                    </li>
                                    -->
                                    <li {% if THIS_CONTROLLER == "Index" %}class="active" {% endif %} >
                                    <a href="/">
                                        <i class="fa fa-dashboard"></i>
                                        <span>{{ L._('menu_index') }}</span>
                                        <!--<span class="label label-primary label-circle pull-right">28</span>-->
                                    </a>
                                    </li>
                                    <li {% if THIS_CONTROLLER == "Article" %}class="active" {% endif %} >
                                    <a href="#" class="dropdown-toggle">
                                        <i class="fa fa-file-text-o"></i>
                                        <span>{{ L._('menu_articles') }}</span>
                                        <i class="fa fa-angle-right drop-icon"></i>
                                    </a>
                                    <ul class="submenu">
                                        <li>
                                            <a href="/article/index">
                                                {{ L._('menu_all_articles') }}
                                            </a>

                                            {% for WebCategory in WebsiteCategory %}
                                                <a href="/Article/search/category/{{ WebCategory['id'] }}" title="Articles——{{ WebCategory['name'] }}" {% if WebCategory['id'] == this_category %} class="active" {% endif %}  >
                                                <b>{{ WebCategory['name'] }}</b>
                                                </a>
                                            {% endfor %}
                                        </li>

                                    </ul>

                                    </li>

                                    <li  {% if THIS_CONTROLLER == "Document" %}class="active" {% endif %} >
                                    <a href="/document">
                                        <i class="fa fa-copy"></i>
                                        <span>{{ L._('menu_documents') }}</span>
                                        <!--<span class="label label-primary label-circle pull-right">28</span>-->
                                    </a>
                                    </li>


                                    <li {% if THIS_CONTROLLER == "Album" %}class="active" {% endif %} >
                                    <a href="/album">
                                        <i class="fa fa-image"></i>
                                        <span>{{ L._('menu_pictures') }}</span>

                                    </a>
                                    </li>


                                    <li {% if THIS_CONTROLLER == "Software" %}class="active" {% endif %} >

                                    <a href="#" class="dropdown-toggle">
                                        <i class="fa fa-desktop"></i>
                                        <span>{{ L._('menu_software') }}</span>
                                        <i class="fa fa-angle-right drop-icon"></i>
                                        <ul class="submenu">
                                            <li>
                                                <a href="/software/gui" {% if soft_type == 'gui' %} class="active" {% endif %} >
                                                GUI
                                    </a>

                                    <a href="/software/game" {% if soft_type == 'game' %} class="active" {% endif %}>
                                    Game
                                    </a>
                                    </li>
                                </ul>
                                </a>
                                </li>

                                <li {% if THIS_CONTROLLER == "Other" %}class="active" {% endif %} >
                                <a href="/Other/about">
                                    <i class="fa fa-copy"></i>
                                    <span>{{ L._('menu_about') }}</span>
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
                                        <li class="active"><span>{{ WEBSITE['CONTROLLER_NAME'] }}</span></li>
                                    </ol>

                                    <h1>{{ bread_crumbs }}</h1>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{ content() }}


                    {# footer block #}
                    <footer id="footer-bar" class="row">
                        <p id="footer-copyright" class="col-xs-12">
                            Powered by ZhangCheng - <?php echo date('Y');?>.京ICP备14007760-2号 <a href="http://webscan.360.cn/index/checkwebsite/url/vipzhangcheng.cn" name="130db645b9c9e2f21d67bcbae32dfa74" >360网站安全检测平台</a>
                        </p>
                        {% block footer %} {% endblock %}
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


        <!-- global scripts -->
        <script src="{{ CUBE() }}/js/demo-skin-changer.js"></script> <!-- only for demo -->

        <script src="{{ CUBE() }}/js/jquery.js"></script>
        <script src="{{ CUBE() }}/js/bootstrap.js"></script>
        <script src="{{ CUBE() }}/js/jquery.nanoscroller.min.js"></script>
        <script src="{{ CUBE() }}/js/demo.js"></script>
        <!-- theme scripts -->
        <script src="{{ CUBE() }}/js/scripts.js"></script>
        <script src="{{ CUBE() }}/js/pace.min.js"></script>
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

                window.open ('{{ WEBSITE['url'] }}/article/search?category='+s,'newwindow','height=600,width=800,top=100,left=200,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,status=no')
            }

        </script>

        {% block after %}
        {% endblock %}

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <div class="g-recaptcha" data-sitekey="6LftISATAAAAAIfSbCBowMT-lq-vGBRlqPOwuyuw"></div>
    </body>
</html>


