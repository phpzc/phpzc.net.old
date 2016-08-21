<!DOCTYPE html>
<html class="no-js login" lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin-Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ WIN8('css/images/favicon.png') }}">
    <!-- Le styles -->
    <link href="{{ WIN8('css/twitter/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ WIN8('css/base.css') }}" rel="stylesheet">
    <link href="{{ WIN8('css/twitter/responsive.css') }}" rel="stylesheet">
    <link href="{{ WIN8('css/jquery-ui-1.8.23.custom.css') }}" rel="stylesheet">
    <script src="{{ WIN8('js/plugins/modernizr.custom.32549.js') }}"></script>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>

<body>
<div id="login_page">
    <!-- Login page -->
    <div id="login">
        <div class="row-fluid fluid">
            <div class="span5"> <img src="https://avatars0.githubusercontent.com/u/3666436?v=3&s=460" /> </div>
            <div class="span7">
                <div class="title">
                    <span class="name">PeakPointer</span>
                    <span class="subtitle">Locked</span>
                </div>
                <form class="form-search row-fluid " action="" method="post">
                    <div class="input-append row-fluid fluid">
                        <input type="text" id="login_pwd" class="row-fluid search-query" placeholder="Password" name="password">
                        <a href="javascript:;" class="btn color_4" id="login_a">Go</a> </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End #login -->
    <!-- <img src="img/ajax-loader.gif"> -->
</div>
<!-- End #loading -->

<!-- Le javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<!-- Flip effect on login screen -->
<script type="text/javascript" src="{{ WIN8('js/google/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ WIN8('js/plugins/jquerypp.custom.js') }}"></script>
<script type="text/javascript" src="{{ WIN8('js/plugins/jquery.bookblock.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ WIN8('js/plugins/jquery.uniform.min.js') }}"></script>

<script type="text/javascript">
    $(function() {
//        var Page = (function() {
//
//            var config = {
//                        $bookBlock: $( '#bb-bookblock' ),
//                        $navNext  : $( '#bb-nav-next' ),
//                        $navPrev  : $( '#bb-nav-prev' ),
//                        $navJump  : $( '#bb-nav-jump' ),
//                        bb        : $( '#bb-bookblock' ).bookblock( {
//                            speed       : 800,
//                            shadowSides : 0.8,
//                            shadowFlip  : 0.7
//                        } )
//                    },
//                    init = function() {
//
//                        initEvents();
//
//                    },
//                    initEvents = function() {
//
//                        var $slides = config.$bookBlock.children(),
//                                totalSlides = $slides.length;
//
//                        // add navigation events
//                        config.$navNext.on( 'click', function() {
//                            $("#arrow_register").fadeOut();
//                            $(".not-member").slideUp();
//                            $(".already-member").slideDown();
//                            config.bb.next();
//                            return false;
//
//                        } );
//
//                        config.$navPrev.on( 'click', function() {
//
//                            $(".not-member").slideDown();
//                            $(".already-member").slideUp();
//                            config.bb.prev();
//                            return false;
//
//                        } );
//
//                        config.$navJump.on( 'click', function() {
//
//                            config.bb.jump( totalSlides );
//                            return false;
//
//                        } );
//
//                        // add swipe events
//                        $slides.on( {
//
//                            'swipeleft'   : function( event ) {
//
//                                config.bb.next();
//                                return false;
//
//                            },
//                            'swiperight'  : function( event ) {
//
//                                config.bb.prev();
//                                return false;
//
//                            }
//
//                        } );
//
//                    };
//
//            return { init : init };
//
//        })();
//
//        Page.init();

        $('#login_a').click(function(){
            $.get('/admin/index/check',{password:$('#login_pwd').val()},function(data){
                if(data == 1){
                    window.location = '/';
                }
            })
        })
    });
</script>
<script type='text/javascript'>

    $(window).load(function() {
        $('#loading1').fadeOut();
    });
    $(document).ready(function() {
        $("input:checkbox, input:radio, input:file").uniform();


        $('[rel=tooltip]').tooltip();
        $('body').css('display', 'none');
        $('body').fadeIn(500);

        $("#logo a, #sidebar_menu a:not(.accordion-toggle), a.ajx").click(function() {
            event.preventDefault();
            newLocation = this.href;
            $('body').fadeOut(500, newpage);
        });
        function newpage() {
            window.location = newLocation;
        }
    });


</script>
</body>
</html>