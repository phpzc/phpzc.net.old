@extends('layouts.layout')

@section('content_title')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-4">
            <div class="card card-profile">
                <div class="card-header" style="background-image: url({{ tabler_assets('images/故宫.jpg') }});"></div>
                <div class="card-body text-center">
                    <img class="card-profile-img" src="https://avatars0.githubusercontent.com/u/3666436?v=3&s=460">
                    <h3 class="mb-3">张成</h3>
                    <p class="mb-4">
                        Big belly rude boy, million dollar hustler. Unemployed.
                    </p>
                    <button class="btn btn-outline-primary btn-sm">
                        <span class="fa fa-twitter"></span> Follow
                    </button>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <span class="avatar avatar-xxl mr-5" style="background-image: url(https://avatars0.githubusercontent.com/u/3666436?v=3&s=460)"></span>
                        <div class="media-body">
                            <h4 class="m-0">张成</h4>
                            <p class="text-muted mb-0">Webdeveloper</p>
                            <ul class="social-links list-inline mb-0 mt-2">
                                <li class="list-inline-item">
                                    <a href="https://weibo.com/lampzhangcheng" target="_blank" title="weibo" data-toggle="tooltip"><i class="fa fa-weibo"></i></a>
                                </li>

                                <li class="list-inline-item">
                                    <a href="https://github.com/phpzc" title="GitHub" data-toggle="tooltip" target="_blank"><i class="fa fa-git"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-8">

            <form class="card">
                <div class="card-body">
                    <h3 class="card-title">Description</h3>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="form-label">Education</label>
                                <p class="text-muted">江苏建筑职业技术学院 - 电子信息工程</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label class="form-label">Location</label>
                                <p class="text-muted">北京, 泰州</p>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Skills</label>
                                <div class="tags">
                                    <span class="tag tag-danger">PHP</span>
                                    <span class="tag tag-success">C/C++</span>
                                    <span class="tag tag-info">Lua</span>
                                    <span class="tag tag-warning">Java</span>
                                    <span class="tag tag-success">Javascript</span>
                                    <span class="tag tag-info">Markdown</span>
                                    <span class="tag tag-primary">HTML</span>
                                    <span class="tag tag-warning">CSS</span>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-0">
                                <label class="form-label">About Me</label>
                                <p>{!! htmlspecialchars_decode($info['description']) !!}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection
