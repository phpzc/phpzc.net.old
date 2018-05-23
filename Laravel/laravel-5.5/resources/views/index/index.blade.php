@extends('layouts.layout')

@section('content')

    <!--modal -->
    <link rel="stylesheet" type="text/css" href="{{ CUBE('css/libs/nifty-component.css') }}"/>

    <div class="row row-cards row-deck">
        @foreach($article_list as $v)
        <div class="col-sm-6 col-xl-3">
            <div class="card">

                <div class="card-body d-flex flex-column">
                    <h4><a href="#">{{ cut_str( htmlspecialchars_decode($v['title']),40) }}</a></h4>
                    <div class="text-muted">{{ cut_str($v['content'],300) }}</div>
                    <div class="d-flex align-items-center pt-5 mt-auto">
                        <div class="avatar avatar-md mr-3" style="background-image: url(https://avatars0.githubusercontent.com/u/3666436?v=3&s=460)"></div>
                        <div>
                            <a href="#" class="text-default">张成</a>
                            <small class="d-block text-muted">{{ date('Y/m/d',$v['time']) }}</small>
                        </div>
                        <div class="ml-auto text-muted">
                            <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </div>

    {{-- doc --}}
    <div class="page-header">
        <h1 class="page-title">
            Latest Document
        </h1>
    </div>

    <div class="row row-cards">
        @foreach($article_list2 as $v)
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


@endsection


@section('footer')

    <div class="footer">
        <div class="container">
            <div class="row">

                <div class="row">
                    @foreach($links as $v)

                        <a href="{{ $v['url'] }}" target="_blank" class="btn btn-outline-primary" style="margin:0.5em;word-break: break-all" ><i class="fe fe-link mr-2" ></i>{{ $v['name'] }}</a>

                    @endforeach
                </div>

            </div>
            <div class="page-header">
                <h1 class="page-title">
                    Add Link
                </h1>
            </div>

            <div class="row">

                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Your Email address</label>
                                    <input type="email"  class="form-control" placeholder="Your Email address" value="" id="exampleEmail">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Your site url</label>
                                    <input type="text" class="form-control" placeholder="Enter url" value=""  id="exampleUrl">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Your site name</label>
                                    <input type="email" class="form-control"   id="exampleName" placeholder="Enter site name">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="alert alert-success" style="display: none" id="links_submit_tip">
                        <i class="fa fa-check-circle fa-fw fa-lg"></i>
                        <strong>Submit Success!</strong>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary" id="links_submit">Submit</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        $(function(){
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
        })
    </script>
@endsection