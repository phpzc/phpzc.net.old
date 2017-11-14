@extends('layouts.main')

@section('head')

    <!--

    <link rel="stylesheet" type="text/css" href="{{ CUBE('css/libs/dropzone.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ CUBE('css/libs/magnific-popup.css') }}">

    -->

    <link rel="stylesheet" href="/Public/css/baguetteBox.min.css">
    <link rel="stylesheet" href="/Public/css/gallery-grid.css">
@endsection


@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box">
                <header class="main-box-header">
                    <h2>Images List</h2>
                </header>

                <div class="main-box-body">

                    <!--

                    <div id="gallery-photos-lightbox">
                        <ul class=" clearfix gallery-photos">

                            <?php if(!empty($photo)){ ?>
                            @foreach($photo as $v)
                                <li class="col-md-3 col-sm-3 col-xs-6">

                                    <a href="{{ $v['imgurl'] }}" class="photo-box image-link" style="background-image: url('{{ $v['imgurl'] }}');">
                                        <img class="lazy col-md-3 col-sm-3 col-xs-6" data-original="{{ $v['imgurl'] }}" />
                                    </a>
                                    <span class="thumb-meta-time" style="color:green"><i class="fa fa-clock-o"></i> {{ $v['year'] }}/{{ $v['month'] }}</span>
                                </li>
                            @endforeach
                            <?php } ?>
                        </ul>
                    </div>

                    -->

                        <div class="tz-gallery">

                            <div class="row">

                                <?php if(!empty($photo)){ ?>
                                @foreach($photo as $v)

                                <div class="col-sm-6 col-md-4">
                                    <a class="lightbox" href="{{ $v['imgurl'] }}">
                                        <img src="{{ $v['imgurl'] }}" alt="Park">
                                    </a>
                                </div>

                                @endforeach
                                <?php } ?>
                            </div>

                        </div>

                </div>


            </div>
        </div>
    </div>
@endsection

@section('after')
    <script src="{{ CUBE('js/jquery-ui.custom.min.js') }}"></script>
    <script src="{{ CUBE('/js/dropzone.js') }}"></script>
    <script src="{{ CUBE('js/jquery.magnific-popup.min.js') }}"></script>


    <script src="{{ JS('jquery.lazyload.js?v=1.9.1') }}"></script>

    <script type="text/javascript" charset="utf-8">
        $(function() {
            $("img.lazy").lazyload({effect: "fadeIn"});
        });
    </script>
    <script type="text/javascript" src="/Public/js/baguetteBox.min.js"></script>
    <script type="text/javascript">
        baguetteBox.run('.tz-gallery');
    </script>

    <script>
        $(function() {

//            $(document).ready(function() {
//                $('#gallery-photos-lightbox').magnificPopup({
//                    type: 'image',
//                    delegate: 'a',
//                    gallery: {
//                        enabled: true
//                    }
//                });
//            });

        });
    </script>
@endsection