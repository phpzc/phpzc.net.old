@extends('layouts.layout')


@section('content')
    <div class="row row-cards">

        @foreach($documents as $v)
            <div class="col-sm-6 col-lg-4">
                <div class="card p-3">
                    <a href="javascript:void(0)" class="mb-3">
                        <img src="{{ $v['imgurl'] }}" alt="Photo by Nathan Guerrero" class="rounded" title="{{ $v['title'] }}" style="max-height: 180px">
                    </a>
                    <div class="d-flex align-items-center px-2">
                        <div >

                            <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-download mr-1"></i> {{ $v['visit'] }}</a>
                        </div>

                        <div class="ml-auto text-muted">
                            <a href="/download/index?url=<?php echo urlencode($v['url']);?>&type=document&id={{ $v['id'] or '' }}" class="btn btn-success" target="_blank">
                                <i class="fa fa-download"></i>
                                Download
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        @endforeach


    </div>
    <link rel="stylesheet" href="{{ tabler_assets('css/bootstrap_pagination.css') }}">
    <div class="row">
        <div class="common_page">{{ $page }}</div>
    </div>
@endsection
