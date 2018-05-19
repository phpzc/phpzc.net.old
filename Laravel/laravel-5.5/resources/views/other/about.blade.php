@extends('layouts.main')
@section('head')

    <link rel="stylesheet" type="text/css" href="{{ CUBE('css/libs/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ CUBE('css/libs/nifty-component.css') }}"/>

@endsection

@section('content')

    <div class="row" id="user-profile">
        <div class="md-modal md-effect-11" id="modal-11">
            <div class="md-content">
                <div class="modal-header">
                    <button class="md-close close">&times;</button>
                    <h4 class="modal-title">Send Message To Me</h4>
                </div>
                <div class="modal-body">
                    <form role="form">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="">Your Name</label>
                            <input type="text" maxlength="30" class="form-control" id="" name="name" placeholder="Enter name"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea">Textarea</label>
                            <textarea class="form-control" id="msg_text" maxlength="255" id="exampleTextarea" rows="3" placeholder="Enter message"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="man">Man</label>
                            <input type="radio" id="man" name="sex" value="0" checked>
                            <label for="women">Women</label>
                            <input type="radio" id="women" name="sex" value="1">

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="send_message_to_me">Send</button>
                </div>
            </div>
        </div>
        <div class="md-overlay"></div><!-- the overlay element -->


        <div class="col-lg-3 col-md-4 col-sm-4">
            <div class="main-box clearfix">
                <header class="main-box-header clearfix">
                    <h2>About Me</h2>
                </header>

                <div class="main-box-body clearfix">

                    <img src="{{ $info['avator_url'] }}" alt="" class="profile-img img-responsive center-block" />

                    <div class="profile-label">
                        <span class="label label-danger">{{ $info['name'] }}</span>
                    </div>

                    <div class="profile-stars">
                        <span>{{ $info['foreign_name'] }}</span>
                    </div>

                    <div class="profile-since">
                        Begin Coding: Mar 2012
                    </div>

                    <div class="profile-details">
                        <ul class="fa-ul">
                            <li><i class="fa-li fa fa-qq"></i> <span>{{ $info['qq'] }}</span></li>
                            <li><i class="fa-li fa fa-envelope"></i> <span><a href="Mailto:{{ $info['mail'] }}">{{ $info['mail'] }}</a></span></li>
                            <li><i class="fa-li fa fa-github"></i> <span><a href="{{ $info['github'] }}" target="_blank">{{ $info['github'] }}</a></span></li>
                            <li><i class="fa-li fa fa-weibo"></i> <span><a href="{{ $info['weibo'] }}" target="_blank">{{ $info['weibo'] }}</a></span></li>
                        </ul>
                    </div>


                    <div class="profile-message-btn center-block text-center">
                        <a href="javascript:;" data-modal="modal-11" class="btn btn-success md-trigger btn btn-primary mrg-b-lg send_message_me" id="send_message_me">
                            <i class="fa fa-envelope"></i>
                            Send message
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-lg-9 col-md-8 col-sm-8">
            <div class="main-box clearfix">
                <div class="tabs-wrapper profile-tabs">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-newsfeed" data-toggle="tab">Descriotion</a></li>
                        <li><a href="#tab-activity" data-toggle="tab">Newsfeed</a></li>

                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab-newsfeed">

                            <div class="story">

                                <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

                                <p class="text-muted">
                                    江苏建筑职业技术学院 - 电子信息工程
                                </p>

                                <hr>

                                <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                                <p class="text-muted">北京, 泰州</p>

                                <hr>

                                <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

                                <p>
                                    <span class="label label-danger">PHP</span>
                                    <span class="label label-success">C/C++</span>
                                    <span class="label label-info">Lua</span>
                                    <span class="label label-warning">Java</span>
                                    <span class="label label-success">Javascript</span>
                                    <span class="label label-info">Markdown</span>
                                    <span class="label label-primary">HTML</span>
                                    <span class="label label-warning">CSS</span>

                                </p>

                                <hr>

                                <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

                                <p>{!! htmlspecialchars_decode($info['description']) !!} </p>

                            </div>

                        </div>

                        <div class="tab-pane fade" id="tab-activity">

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('after')
    <script src="{{ CUBE('js/modernizr.custom.js') }}"></script>
    <script src="{{ CUBE('js/classie.js') }}"></script>
    <script src="{{ CUBE('js/modalEffects.js') }}"></script>

    <script src="{{ JS('Form_Validator.js') }}"></script>
    <script>

        $(function () {
            $('#send_message_to_me').click(function(){

                var email = $('input[name=email]').val();
                var name = $('input[name=name]').val();
                var msg = $('#msg_text').val();

                if(Form_Validator.isEmpty(email) ||
                    Form_Validator.isEmpty(name)||
                    Form_Validator.isEmpty(msg)
                ){
                    return;
                }
                if(!Form_Validator.isEmail(email)){
                    return alert('error mail');
                }
                if(Form_Validator.isLocked()){return}
                Form_Validator.lock();

                var sex = 0;
                if($('#women').is(':checked')){
                    sex=1;
                }

                $.post('/other/send_message',{email:email,name:name,message:msg,sex:sex},function(data){
                    Form_Validator.unLock();
                    if(data.status == 1){
                        alert('Send Success');
                        $('.close').click();
                        $('input[name=email]').val('');
                        $('input[name=name]').val('');
                        $('#msg_text').val('');

                    }else{
                        alert('Send Error'+data.content);
                    }

                },'json');

            })
        })
    </script>

@endsection