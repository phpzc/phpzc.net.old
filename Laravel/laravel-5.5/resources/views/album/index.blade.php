@extends('layouts.main')
@section('head')

    <link rel="stylesheet" type="text/css" href="{{ CUBE('css/libs/dropzone.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ CUBE('css/libs/magnific-popup.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box">
                <header class="main-box-header">
                    <h2>Album List</h2>
                </header>

                <div class="main-box-body">
                    <div id="gallery-photos-wrapper">
                        <ul id="gallery-photos" class="clearfix gallery-photos gallery-photos-hover">
                            @foreach($album_list as $v)
                                <li id="recordsArray_1" class="col-md-3 col-sm-3 col-xs-6">
                                    <div class="photo-box" style="background-image: url('{{ $v['face'] or '/Public/img/pic-none.png' }}')">
                                    </div>
                                    <a href="/album/detail?id={{ $v['realid'] }}" class="remove-photo-link" title="show pictures">
                                        <span class="fa-stack fa-lg">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <i class="fa fa-smile-o fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('after')
    <script src="{{ CUBE('js/jquery-ui.custom.min.js') }}"></script>
    <script src="{{ CUBE('js/dropzone.js') }}"></script>
    <script src="{{ CUBE('js/jquery.magnific-popup.min.js') }}"></script>
@endsection