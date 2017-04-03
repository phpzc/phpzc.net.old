@extends('layouts.main')
@section('content')
    <div class="row" id="form_show_result"  >
        <div class="alert alert-danger">
            <i class="fa fa-times-circle fa-fw fa-lg"></i>
            <strong>404 Not Found!</strong>  <a href="/" id="target_url" class="alert-link">立即跳转至首页</a>.
        </div>
    </div>
@endsection

@section('after')
    <script>
        (function(){
            var wait = 3,href = $("#target_url").attr("href");
            var interval = setInterval(function(){
                var time = --wait;
                if(time <= 0) {
                    location.href = href;
                    clearInterval(interval);
                };
            }, 1000);
        })();
    </script>
@endsection