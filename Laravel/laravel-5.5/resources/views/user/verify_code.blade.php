<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>找回密码-{{ $WEBSITE['name'] }}</title>

    <!-- bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{ CUBE('/css/bootstrap/bootstrap.min.css') }}" />

    <!-- RTL support - for demo only -->
    <script src="{{ CUBE('/js/demo-rtl.js') }}"></script>
    <!--
    If you need RTL support just include here RTL CSS file <link rel="stylesheet" type="text/css" href="css/libs/bootstrap-rtl.min.css" />
    And add "rtl" class to <body> element - e.g. <body class="rtl">
    -->

    <!-- libraries -->
    <link rel="stylesheet" type="text/css" href="{{ CUBE('/css/libs/font-awesome.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ CUBE('/css/libs/nanoscroller.css') }}" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="{{ CUBE('/css/compiled/theme_styles.css') }}" />

    <!-- this page specific styles -->

    <!-- Favicon -->
    <link type="image/x-icon" href="/favicon.png" rel="shortcut icon"/>

    <!--[if lt IE 9]>
    <script src="{{ CUBE('/js/html5shiv.js') }}"></script>
    <script src="{{ CUBE('/js/respond.min.js') }}"></script>
    <![endif]-->
</head>
<body id="login-page">

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div id="login-box">
                <div id="login-box-holder">
                    <div class="row">
                        <div class="col-xs-12">

                            <div id="login-box-inner">
                                <form role="form" action="" method="post" autocomplete="off">
                                    {{ csrf_field() }}
                                    <h4>找回密码邮件</h4>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input class="form-control" type="email" placeholder="Email address" name="username" value="{{ $username or '' }}"/>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input type="password" class="form-control" placeholder="Password" name="password" value="" autocomplete="off"/>
                                    </div>


                                    <div class="row">
                                        <div class="col-xs-12">
                                            <button type="submit" class="btn btn-success col-xs-12">修改</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<div id="config-tool" class="closed">
    <a id="config-tool-cog">
        <i class="fa fa-cog"></i>
    </a>

    <div id="config-tool-options">
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
<script src="{{ CUBE('/js/demo-skin-changer.js') }}"></script> <!-- only for demo -->

<script src="{{ CUBE('/js/jquery.js') }}"></script>
<script src="{{ CUBE('/js/bootstrap.js') }}"></script>
<script src="{{ CUBE('/js/jquery.nanoscroller.min.js') }}"></script>

<script src="{{ CUBE('/js/demo.js') }}"></script> <!-- only for demo -->

<!-- this page specific scripts -->
<script>
    $(function(){
        $('input[type=password]').val('')
    })
</script>

<!-- theme scripts -->
<script src="{{ CUBE('/js/scripts.js') }}"></script>

<!-- this page specific inline scripts -->

</body>
</html>