@extends('layouts.main')

@section('head')
    <meta property="qc:admins" content="145143141776000236654" />
    <!--timeline-->
    <link rel="stylesheet" type="text/css" href="{{ CUBE('css/libs/timeline.css') }}">
    <!--modal -->
    <link rel="stylesheet" type="text/css" href="{{ CUBE('css/libs/nifty-component.css') }}"/>
    <!-- 3d banner begin-->
    <link rel="stylesheet" href="{{ PUBLICS('good_effect/banner-3d/style.css') }}" />
@endsection

@section('content')

    <div class="row" style="margin-bottom:3em;">
        <div class="main-box-body clearfix" >
            <div class="alert alert-info" id="ip-alert">


                <i class="fa fa-info-circle fa-fw fa-lg"></i>

                <strong>Welcome You!</strong> 来自 <?php echo getIPLoc_taobao(get_client_ip(0,true));?> 的网友.  <!--<strong>Default Music:<audio controls="controls" autoplay="autoplay" loop="loop" preload="auto">
                    <source src="/sound2.mp3" />
                </audio>
                </strong>-->
            </div>

        </div>
        <div id="cuteslider_3_wrapper" class="cs-circleslight">

            <div id="cuteslider_3" class="cute-slider" data-width="960" data-height="420" data-overpause="true">

                <ul data-type="slides">
                    <?php

                    foreach($lunbo as $k=>$v){
                        if($k==0){
                            echo '<li data-delay="5" data-src="5" data-trans3d="tr6,tr17,tr22,tr23,tr29,tr27,tr32,tr34,tr35,tr53,tr54,tr62,tr63,tr4,tr13,tr45" data-trans2d="tr3,tr8,tr12,tr19,tr22,tr25,tr27,tr29,tr31,tr34,tr35,tr38,tr39,tr41">
                        <img  src="'.$v['imgurl'].'" data-thumb="'.$v['imgurl'].'">
                        <a data-type="link" href="'.$v['href'].'" target="_blank"></a>
                    </li>';
                        }else{
                            echo '<li data-delay="5" data-src="5" data-trans3d="tr6,tr17,tr22,tr23,tr29,tr27,tr32,tr34,tr35,tr53,tr54,tr62,tr63,tr4,tr13,tr45" data-trans2d="tr3,tr8,tr12,tr19,tr22,tr25,tr27,tr29,tr31,tr34,tr35,tr38,tr39,tr41">
                                    <img  src="'.$v['imgurl'].'" data-src="'.$v['imgurl'].'" data-thumb="'.$v['imgurl'].'">
                                    <a data-type="link" href="'.$v['href'].'" target="_blank"></a>
                                </li>';
                        }
                    }
                    ?>
                </ul>

                <ul data-type="controls">

                    <li data-type="captions"></li>

                    <li data-type="link"></li>

                    <li data-type="video"></li>

                    <li data-type="slideinfo"></li>

                    <li data-type="circletimer"></li>

                    <li data-type="previous"></li>

                    <li data-type="next"> </li>

                    <li data-type="bartimer"></li>

                    <li data-type="slidecontrol" data-thumb="true" data-thumbalign="up"></li>

                </ul>

            </div>

            <div class="cute-shadow"><img src="{{ PUBLICS('good_effect/banner-3d/shadow.png') }}" alt="shadow"></div>

        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                <header class="main-box-header clearfix">
                    <h1>Latest Articles</h1>
                    <hr>
                </header>
                <div class="row">
                    <div class="col-lg-12">
                        <section id="cd-timeline" class="cd-container">

                            @foreach($article_list as $v)
                                <div class="cd-timeline-block">
                                    <div class="cd-timeline-img cd-location">
                                        <i class="fa fa-map-marker fa-2x"></i>
                                    </div>

                                    <div class="cd-timeline-content">
                                        <h2><a href="/article/detail?id={{ $v['id'] }}">{{ cut_str( htmlspecialchars_decode($v['title']),40) }}</a></h2>
                                        <p style="word-break:break-all;word-wrap:break-word ;">{{ cut_str($v['content'],300) }}</p>
                                        <div class="clearfix">
                                            <a class="btn btn-primary pull-right"
                                               href="/article/detail?id={{ $v['id'] }}"
                                               target="_blank">
                                                Read more
                                            </a>
                                        </div>
                                        <span class="cd-date">
                                            {{ date('Y/m/d',$v['time']) }}
                                </span>
                                    </div>
                                </div>
                            @endforeach
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- doc --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box">
                <header class="main-box-header">
                    <h1>Latest Document</h1>
                    <hr>
                </header>

                <div class="row" id="user-profile">
                    <style>
                        img:hover{opacity:0.75;}
                    </style>

                    @foreach($article_list2 as $v)
                        <div class="col-lg-3 col-md-4 col-sm-4">
                            <div class="main-box clearfix">
                                <header class="main-box-header clearfix">
                                    <div class="row" style="height:2em;">{{ $v['title'] }}}</div>
                                </header>

                                <div class="main-box-body clearfix">

                                    <img src="{{ replace_str($v['imgurl']) }}" style="cursor: pointer" title="{{ $v['title'] }}" alt="" class=" img-responsive center-block" />

                                    <div class="profile-label" >
                                        <span  class="label label-danger" style="display:inline-block;max-width:80%;cursor: pointer" title="{{ $v['author'] }}">{{ $v['author'] }}</span>
                                    </div>

                                    <div class="profile-stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <span>4 Star</span>
                                    </div>

                                    <div class="profile-since">
                                        Publish Time: {{ $v['year'] }}/{{  $v ['month'] }}
                                    </div>

                                    <div class="profile-details">
                                        <ul class="fa-ul">
                                            <li><i class="fa-li fa fa-download"></i>Downloads: <span>{{ $v['visit'] }}</span></li>
                                            <li><i class="fa-li fa fa-smile-o"></i>Views: <span>{{ $v['visit'] }}</span></li>
                                        </ul>
                                    </div>

                                    <div class="profile-message-btn center-block text-center">
                                        <a href="/download/index?url={{ urlencode($v['url']) or '' }}&type=document&id={{ $v['id'] or '' }}" class="btn btn-success" target="_blank">
                                            <i class="fa fa-download"></i>
                                            Download
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </div>
    </div>


    <div class="md-modal md-effect-4" id="modal-4">
        <div class="md-content">
            <div class="modal-header">
                <button class="md-close close" >&times;</button>
                <h4 class="modal-title">Apply for link</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="form-group">
                        <label for="exampleEmail">Your Email address</label>
                        <input type="email" class="form-control" id="exampleEmail" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleUrl">Your site url</label>
                        <input type="text" class="form-control" id="exampleUrl" placeholder="Enter url">
                    </div>

                    <div class="form-group">
                        <label for="exampleName">Your site name</label>
                        <input type="text" class="form-control" id="exampleName" placeholder="Enter site name">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <div class="alert alert-success" style="display: none" id="links_submit_tip">
                    <i class="fa fa-check-circle fa-fw fa-lg"></i>
                    <strong>Submit Success!</strong>
                </div>
                <button type="button" id="links_submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                <header class="main-box-header clearfix">
                    <h1>Links</h1>
                    <hr>
                </header>
                <div class="main-box-body clearfix">
                    <a style="margin:0.5em;display: inline-block" href="http://pecl.php.net/index.php" target="_blank"><button type="button" class="btn btn-info">PECL</button></a>
                    <a style="margin:0.5em;display: inline-block" href="https://launchpad.net/gearmand" target="_blank"><button type="button" class="btn btn-info">Gearmand</button></a>
                    <a style="margin:0.5em;display: inline-block" href="http://www.phpcomposer.com/" target="_blank"><button type="button" class="btn btn-info">phpcomposer</button></a>


                    @foreach($links as $v)
                        <a href="{{ $v['url'] }}" target="_blank" style="margin:0.5em;display: inline-block">
                            <button type="button" class="btn btn-info">{{ $v['name'] }}</button>
                        </a>

                    @endforeach

                </div>
                <div class="main-box-body clearfix">
                    <button class="md-trigger btn btn-danger mrg-b-lg" data-modal="modal-4">Add Link</button>

                </div>
            </div>
        </div>
    </div>

    <div class="md-overlay"></div><!-- the overlay element -->

    <div style="display: none;">

    </div>
@endsection


@section('after')
    <script src="{{ CUBE('/js/jquery.easypiechart.min.js') }}"></script>

    <!--modal -->
    <script src="{{ CUBE('js/modernizr.custom.js') }}"></script>
    <script src="{{ CUBE('js/classie.js') }}"></script>
    <script src="{{ CUBE('js/modalEffects.js') }}"></script>
    <!--timeline -->
    <script src="{{ CUBE('js/modernizr.js') }}"></script>
    <script src="{{ CUBE('js/timeline.js') }}"></script>
    <!-- this page specific inline scripts -->

    <script src="{{ JS('load_image.js') }}"></script>
    <script src="{{ CUBE('js/modernizr.custom.js') }}"></script>
    <script src="{{ CUBE('js/snap.svg-min.js') }}"></script> <!-- For Corner Expand and Loading circle effect only -->
    <script src="{{ CUBE('js/classie.js') }}"></script>



    <script>
        $(function() {
            //$('.carousel').carousel();

            //var imgArr = [$('#lunbo_0'),$('#lunbo_1'),$('#lunbo_2')];

            //load_image(imgArr,function(imgObj,thisObj){
            //    thisObj.attr('src' , thisObj.data('src'));
            //});

            //$("img.lazy").lazyload({effect: "fadeIn"});
            $('.chart').easyPieChart({
                easing: 'easeOutBounce',
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                },
                barColor: '#3498db',
                trackColor: '#f2f2f2',
                scaleColor: false,
                lineWidth: 8,
                size: 130,
                animate: 1500
            });

//            var sTimeOut = setTimeout(function () {
//                $('#ip-alert').hide();
//                sTimeOut = null;
//            },5000);

            //links
            $('#links_submit').click(function() {
                var email = $('#exampleEmail').val();
                var url = $('#exampleUrl').val();
                var name = $('#exampleName').val();
                var pattern = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
                if (!pattern.test(email)) {
                    alert("Error email");
                    return false;
                }
                var Expression=/http(s)?:\/\/([\w-]+\.)+[\w-]+(\/[\w- .\/?%&=]*)?/;
                var objExp=new RegExp(Expression);
                if(objExp.test(url)!=true){
                    alert("Error url");
                    return false;
                }

                if(name == ''){
                    alert('Error name');
                    return false;
                }

                $.ajax({
                    type:"POST",
                    url:'/links/add',
                    data:"email="+email+"&url="+url+"&name="+name,
                    async:true,

                    success: function(data)
                    {
                        if(data == '1'){
                            $('#links_submit_tip').show();
                            setTimeout(function(){
                                $('#links_submit_tip').hide();
                                $('.md-close').click();
                                $('#exampleEmail').val('');
                                $('#exampleUrl').val('');
                                $('#exampleName').val('');
                            },2000);

                        }else{
                            alert('Apply Fail!');
                        }

                    }
                });
            })


            // Audio

        });



    </script>


    <!--3d begin -->

    <script type='text/javascript' src='{{ PUBLICS('good_effect/banner-3d/modernizr.min.js?ver=2.6.1') }}'></script>

    <script type='text/javascript'>

        /* <![CDATA[ */

        var CSSettings = {"pluginPath":"{{ PUBLICS('/good_effect/banner-3d') }}"};

        /* ]]> */

    </script>

    <script type='text/javascript' src='{{ PUBLICS('/good_effect/banner-3d/cute.slider.js?ver=2.0.0') }}'></script>

    <script type='text/javascript' src='{{ PUBLICS('/good_effect/banner-3d/cute.transitions.all.js?ver=2.0.0') }}'></script>
    <!--3d end -->

    <script type="text/javascript">

        var cuteslider3 = new Cute.Slider();
        cuteslider3.setup("cuteslider_3" , "cuteslider_3_wrapper", "{{ PUBLICS('/good_effect/banner-3d/slider-style.css') }}");
        cuteslider3.api.addEventListener(Cute.SliderEvent.CHANGE_START, function(event) { });
        cuteslider3.api.addEventListener(Cute.SliderEvent.CHANGE_END, function(event) { });
        cuteslider3.api.addEventListener(Cute.SliderEvent.WATING, function(event) { });
        cuteslider3.api.addEventListener(Cute.SliderEvent.CHANGE_NEXT_SLIDE, function(event) { });
        cuteslider3.api.addEventListener(Cute.SliderEvent.WATING_FOR_NEXT, function(event) { });

    </script>
@endsection