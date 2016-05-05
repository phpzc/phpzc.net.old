<!DOCTYPE html>
<html class="sidebar_default  no-js" lang="en">
<head>
    <meta charset="utf-8">
    <title>@section('title','Admin-title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    @yield('before_head')
    <link rel="shortcut icon" href="{{ WIN8('css/images/favicon.png') }}">
    <!-- Le styles -->
    <link href="{{ WIN8('css/twitter/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ WIN8('css/base.css') }}" rel="stylesheet">
    <link href="{{ WIN8('css/twitter/responsive.css') }}" rel="stylesheet">
    <link href="{{ WIN8('css/jquery-ui-1.8.23.custom.css') }}" rel="stylesheet">
    <script src="{{ WIN8('js/plugins/modernizr.custom.32549.js') }}"></script>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="{{ WIN8('js/google/html5.js') }}"></script>
    <![endif]-->

    @yield('before_tail')
</head>

<body>
<div id="loading"><img src="{{ WIN8('img/ajax-loader.gif') }}"></div>
<div id="responsive_part">
    <div class="logo"> <a href="/"><span>Start</span><span class="icon"></span></a> </div>
    <ul class="nav responsive">
        <li>
            <button class="btn responsive_menu icon_item" data-toggle="collapse" data-target=".overview"> <i class="icon-reorder"></i> </button>
        </li>
    </ul>
</div>

@include('admin.layouts.menu')

<div id="main">
    <div class="container" style="min-height: 30em;">
        <div class="header row-fluid">
            <div class="logo"> <a href="/"><span>Start</span><span class="icon"></span></a> </div>
            <div class="top_right">
                <ul class="nav nav_menu">
                    <li class="dropdown"> <a class="dropdown-toggle administrator" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
                            <div class="title"><span class="name">PeakPointer</span><span class="subtitle">Administrator</span></div>
                            <span class="icon"><img src="https://avatars0.githubusercontent.com/u/3666436?v=3&s=73" /></span></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                            <li><a href="javascript:;"><i class=" icon-user"></i> My Profile</a></li>
                            <li><a href="javascript:;"><i class=" icon-cog"></i>Settings</a></li>
                            <li><a href="/admin/index/logout"><i class=" icon-unlock"></i>Log Out</a></li>
                            <li><a href="javascript:;"><i class=" icon-flag"></i>Help</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- End top-right -->
        </div>

        <div id="main_container">

            @yield('content')

            <div style="with:100%;height:100px;"></div>
        </div>
        <div class="background_changer dropdown">
            <div class="dropdown" id="colors_pallete"> <a data-toggle="dropdown" data-target="drop4" class="change_color"></a>
                <ul  class="dropdown-menu pull-left" role="menu" aria-labelledby="drop4">
                    <li><a data-color="color_0" class="color_0" tabindex="-1">1</a></li>
                    <li><a data-color="color_1" class="color_1" tabindex="-1">1</a></li>
                    <li><a data-color="color_2" class="color_2" tabindex="-1">2</a></li>
                    <li><a data-color="color_3" class="color_3" tabindex="-1">3</a></li>
                    <li><a data-color="color_4" class="color_4" tabindex="-1">4</a></li>
                    <li><a data-color="color_5" class="color_5" tabindex="-1">5</a></li>
                    <li><a data-color="color_6" class="color_6" tabindex="-1">6</a></li>
                    <li><a data-color="color_7" class="color_7" tabindex="-1">7</a></li>
                    <li><a data-color="color_8" class="color_8" tabindex="-1">8</a></li>
                    <li><a data-color="color_9" class="color_9" tabindex="-1">9</a></li>
                    <li><a data-color="color_10" class="color_10" tabindex="-1">10</a></li>
                    <li><a data-color="color_11" class="color_11" tabindex="-1">10</a></li>
                    <li><a data-color="color_12" class="color_12" tabindex="-1">12</a></li>
                    <li><a data-color="color_13" class="color_13" tabindex="-1">13</a></li>
                    <li><a data-color="color_14" class="color_14" tabindex="-1">14</a></li>
                    <li><a data-color="color_15" class="color_15" tabindex="-1">15</a></li>
                    <li><a data-color="color_16" class="color_16" tabindex="-1">16</a></li>
                    <li><a data-color="color_17" class="color_17" tabindex="-1">17</a></li>
                    <li><a data-color="color_18" class="color_18" tabindex="-1">18</a></li>
                    <li><a data-color="color_19" class="color_19" tabindex="-1">19</a></li>
                    <li><a data-color="color_20" class="color_20" tabindex="-1">20</a></li>
                    <li><a data-color="color_21" class="color_21" tabindex="-1">21</a></li>
                    <li><a data-color="color_22" class="color_22" tabindex="-1">22</a></li>
                    <li><a data-color="color_23" class="color_23" tabindex="-1">23</a></li>
                    <li><a data-color="color_24" class="color_24" tabindex="-1">24</a></li>
                    <li><a data-color="color_25" class="color_25" tabindex="-1">25</a></li>
                </ul>
            </div>
        </div>
        <!-- End .background_changer -->
    </div>
    @include('admin.layouts.footer')
</div>


<!-- Le javascript
    ================================================== -->
<!-- General scripts -->
<script src="{{ WIN8('js/jquery.js') }}" type="text/javascript"> </script>
<!--[if !IE]> -->
<!--[if !IE]> -->
<script src="{{ WIN8('js/plugins/enquire.min.js') }}" type="text/javascript"></script>
<!-- <![endif]-->
<!-- <![endif]-->
<!--[if lt IE 7]>
<script src="{{ WIN8('js/google/IE7.js')}}"></script>
<![endif]-->
<script language="javascript" type="text/javascript" src="{{ WIN8('js/plugins/jquery.sparkline.min.js') }}"></script>
<script src="{{ WIN8('js/plugins/excanvas.compiled.js') }}"></script>
<script src="{{ WIN8('js/bootstrap-transition.js') }}" type="text/javascript"></script>
<script src="{{ WIN8('js/bootstrap-alert.js') }}" type="text/javascript"></script>
<script src="{{ WIN8('js/bootstrap-modal.js') }}" type="text/javascript"></script>
<script src="{{ WIN8('js/bootstrap-dropdown.js') }}" type="text/javascript"></script>
<script src="{{ WIN8('js/bootstrap-scrollspy.js') }}" type="text/javascript"></script>
<script src="{{ WIN8('js/bootstrap-tab.js') }}" type="text/javascript"></script>
<script src="{{ WIN8('js/bootstrap-tooltip.js') }}" type="text/javascript"></script>
<script src="{{ WIN8('js/bootstrap-popover.js') }}" type="text/javascript"></script>
<script src="{{ WIN8('js/bootstrap-button.js') }}" type="text/javascript"></script>
<script src="{{ WIN8('js/bootstrap-collapse.js') }}" type="text/javascript"></script>
<script src="{{ WIN8('js/bootstrap-carousel.js') }}" type="text/javascript"></script>
<script src="{{ WIN8('js/bootstrap-typeahead.js') }}" type="text/javascript"></script>
<script src="{{ WIN8('js/bootstrap-affix.js') }}" type="text/javascript"></script>
<script src="{{ WIN8('js/fileinput.jquery.js') }}" type="text/javascript"></script>
<script src="{{ WIN8('js/jquery-ui-1.8.23.custom.min.js') }}" type="text/javascript"></script>
<script src="{{ WIN8('js/jquery.touchdown.js') }}" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="{{ WIN8('js/plugins/jquery.uniform.min.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ WIN8('js/plugins/jquery.tinyscrollbar.min.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ WIN8('js/jnavigate.jquery.min.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ WIN8('js/jquery.touchSwipe.min.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ WIN8('js/plugins/jquery.peity.min.js') }}"></script>


<!-- Custom made scripts for this template -->
<script src="{{ WIN8('js/scripts.js') }}" type="text/javascript"></script>

@yield('after')

</body>
</html>