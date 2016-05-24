@extends('admin.layouts.main')

@section('content')
    <div class="span12">
        <div class="box color_2 ">
            <div class="title row-fluid">
                <h4 class="pull-left"><span>Messages</span></h4>
                <div class="btn-toolbar pull-right ">
                    <div class="btn-group"> <a class="btn">Message Tip</a> <a class="btn change_color_outside"><i class="paint_bucket"></i></a> </div>
                </div>
            </div>
            <!-- End .title -->
            <div class="content row-fluid">
                <ul class="messages_layout">

                    <li class="from_user left">
                        <a href="#" class="avatar"><img src="{{ WIN8('img/message_avatar2.png') }}"/></a>
                        <div class="message_wrap"> <span class="arrow"></span>

                            <div class="text"> {{ $message }} </div>

                        </div>
                    </li>

                </ul>
            </div>
            <!-- End .content -->
        </div>
        <!-- End .box -->
    </div>

@endsection


@section('after')

    <script>

        $(function(){
            setTimeout(function () {
                window.location.href = '{{ $url }}';
            },3000);
        })
    </script>
@endsection