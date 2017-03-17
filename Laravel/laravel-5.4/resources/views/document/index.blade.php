<extend name="Layout/index" />
@extends('layouts.main')
@section('head')
    <link rel="stylesheet" type="text/css" href="{{ CUBE('libs/magnific-popup.css') }}">
@endsection

@section('content')
    <div class="row" id="user-profile">
        <style>
            img:hover{opacity:0.75;}
        </style>

        @foreach($documents as $document)
            <div class="col-lg-3 col-md-4 col-sm-4">
                <div class="main-box clearfix">
                    <header class="main-box-header clearfix">
                        <div class="row" style="height:2em;">{{ $document['title'] }}</div>
                    </header>

                    <div class="main-box-body clearfix">

                        <img src="{{ replace_str($document['imgurl']) }}" style="cursor: pointer" title="{{ $document['title'] }}" alt="img" class=" img-responsive center-block" />

                        <div class="profile-label" >
                            <span  class="label label-danger" style="display:inline-block;max-width:80%;cursor: pointer" title="{{ $document['author'] }}">{{ $document['author'] }}</span>
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
                            Publish Time: {{ $document['year'] }}/{{ $document['month'] }}
                        </div>

                        <div class="profile-details">
                            <ul class="fa-ul">
                                <li><i class="fa-li fa fa-download"></i>Downloads: <span>{{ $document['visit'] }}</span></li>
                                <li><i class="fa-li fa fa-smile-o"></i>Views: <span>{{ $document['visit'] }}</span></li>
                            </ul>
                        </div>

                        <div class="profile-message-btn center-block text-center">
                            <a href="/download/index?url={{ urlencode($document['url']) }}&type=document&id={{ $document['id'] }}" class="btn btn-success" target="_blank">
                                <i class="fa fa-download"></i>
                                Download
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach


    </div>
    <div class="row">
        <div class="common_page">{{ $page }}</div>
    </div>
@endsection
