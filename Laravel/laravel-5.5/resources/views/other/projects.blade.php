@extends('layouts.layout')

@section('content_title')
@endsection

@section('content')

    <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Open-Source Projects</h3>
                <div class="card-options">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>

                </div>
            </div>
            <div class="card-body"  id="git_content_project">
                <div class="dimmer active">
                    <div class="loader"></div>
                    <div class="dimmer-content">

                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

    <script>
        var bg=['red-bg','yellow-bg','green-bg','purple-bg','gray-bg'];

        function render_html(item,i)
        {
            if(item.fork){
                return '';
            }

            return '<div class="col-sm-6 col-lg-4">\n' +
                '        <div class="card">\n' +
                '            <div class="card-body  d-flex flex-column"><h4><a href="'+item.html_url+'" target="_blank">'+item.name+'</a></h4><div class="text-muted">'+item.description+'</div></div>'+
                '            <table class="table card-table">\n' +
                '                <tr>\n' +
                '                    <td>Language</td>\n' +
                '                    <td class="text-right"><span class="text-muted">'+item.language+'</span></td>\n' +
                '                </tr>\n' +
                '                <tr>\n' +
                '                    <td>Star</td>\n' +
                '                    <td class="text-right"><span class="text-muted">'+item.stargazers_count+'</span></td>\n' +
                '                </tr>\n' +
                '                <tr>\n' +
                '                    <td>Fork</td>\n' +
                '                    <td class="text-right"><span class="text-muted">'+item.forks+'</span></td>\n' +
                '                </tr>\n' +
                '                <tr>\n' +
                '                    <td>Latest Update</td>\n' +
                '                    <td class="text-right"><span class="text-muted">'+item.updated_at+'</span></td>\n' +
                '                </tr>\n' +
                '            </table>\n' +
                '        </div>\n' +
                '    </div>';

            //return '<div class="col-lg-4 col-md-5 col-sm-6"><div class="main-box clearfix profile-box-menu"><div class="main-box-body clearfix"><a href="'+item.html_url+'" target="_blank"><div class="profile-box-header '+bg[(i%5)]+' clearfix"><h2>'+item.name+'</h2><div class="job-position">'+item.description+'</div></div></a><div class="profile-box-content clearfix"><ul class="menu-items"><li><a href="#" class="clearfix"><i class="fa fa-language fa-lg"></i>'+item.language+'</a></li><li><a href="#" class="clearfix"><i class="fa fa-star fa-lg"></i> Star<span class="label label-success label-circle pull-right">'+item.stargazers_count+'</span></a></li><li><a href="#" class="clearfix"><i class="fa fa-code-fork fa-lg"></i> Fork<span class="label label-warning label-circle pull-right">'+item.forks+'</span></a></li><li><a href="#" class="clearfix"><i class="fa fa-clock-o fa-lg"></i>'+item.updated_at+'</a></li></ul></div></div></div></div>';

        }

        $(function(){
            $.get('https://api.github.com/users/phpzc/repos?type=owner&per_page=100',function(response){

                var template = '<div class="row">';
                for(var i=0;i<response.length;i++)
                {
                    template = template + render_html(response[i],i);
                }

                template += '</div>';

                $('#git_content_project').html(template);
                $('#git_content_project').show();
            },'json');
        });
    </script>

@endsection

