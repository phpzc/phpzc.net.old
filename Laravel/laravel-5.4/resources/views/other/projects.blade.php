@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                <header class="main-box-header clearfix">
                    <h2>开源项目</h2>
                </header>
                <div class="main-box-body clearfix">
                    <div class="row" style="min-height: 150px;" id="git_content_project">
                        <center style="font-size:2em;">Loading</center>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after')
    <script>
        var bg=['red-bg','yellow-bg','green-bg','purple-bg','gray-bg'];

        function render_html(item,i)
        {
            if(item.fork){
                return '';
            }

            return '<div class="col-lg-4 col-md-5 col-sm-6"><div class="main-box clearfix profile-box-menu"><div class="main-box-body clearfix"><a href="'+item.html_url+'" target="_blank"><div class="profile-box-header '+bg[(i%5)]+' clearfix"><h2>'+item.name+'</h2><div class="job-position">'+item.description+'</div></div></a><div class="profile-box-content clearfix"><ul class="menu-items"><li><a href="#" class="clearfix"><i class="fa fa-language fa-lg"></i>'+item.language+'</a></li><li><a href="#" class="clearfix"><i class="fa fa-star fa-lg"></i> Star<span class="label label-success label-circle pull-right">'+item.stargazers_count+'</span></a></li><li><a href="#" class="clearfix"><i class="fa fa-code-fork fa-lg"></i> Fork<span class="label label-warning label-circle pull-right">'+item.forks+'</span></a></li><li><a href="#" class="clearfix"><i class="fa fa-clock-o fa-lg"></i>'+item.updated_at+'</a></li></ul></div></div></div></div>';

        }

        $(function(){
            $.get('https://api.github.com/users/phpzc/repos?type=owner&per_page=100',function(response){

                var template = '';
                for(var i=0;i<response.length;i++)
                {
                    template = template + render_html(response[i],i);
                }
                $('#git_content_project').html(template);

            },'json');
        });
    </script>
@endsection