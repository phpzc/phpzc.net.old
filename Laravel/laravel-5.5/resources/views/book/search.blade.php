@extends('layouts.main')

@section('head')
    <script>
        function addBook() {
            $.post('/book/addBook', '{{ $StoryDetail2 or ""}}', function () {
                alert('success');
            }, 'json');
        }


    </script>
@endsection
@section('content')
    <div class="row">
        <div class="main-box clearfix">

            <header class="main-box-header clearfix">
                <h2>Search Book Menu</h2>
                <div class="row form-inline-box">
                    <form action="/book/search" method="post">
                        {{ csrf_field() }}
                        <input type="text" name="word" value="{{ urldecode(request()->input('word','')) }}"
                               class="form-control form-inline"/>
                        <input type="submit" value="Search Book" class="btn btn-success form-inline"/>

                        <a href="/book/search?clear=1" class="btn btn-danger form-inline">Clear Cache</a>
                    </form>
                </div>
            </header>
        </div>

        <div class="row">


            <div class="col-lg-12">

            <?php if(isset($book['menu']) && !empty($book['menu'])){ ?>
            <!--书架-->
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="main-box clearfix profile-box-contact">
                        <div class="main-box-body clearfix">
                            <div class="profile-box-header gray-bg clearfix">
                                <img src="{{ $StoryDetail->face_image_url }}" alt="" class="profile-img img-responsive"/>
                                <h2>{{ $StoryDetail->author }}</h2>
                                <div class="job-position">
    {{ $StoryDetail->title }}
                                </div>
                                <ul class="contact-details">
                                    <li>
                                        <button class="btn btn-danger" onclick="addBook()">加入书架</button>
                                    </li>

                                    <li><a href="/book/search?word={{ $StoryDetail->title }}">
                                            <button class="btn btn-warning">阅读最新章节</button>
                                        </a></li>

                                </ul>
                            </div>

                            <div class="profile-box-footer clearfix">
    {{ $StoryDetail->short_description }}
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>


                <div class="main-box no-header clearfix">
                    <div class="main-box-body clearfix">
                        <div class="table-responsive">
                            <table class="table user-list table-hover">
                                <thead>
                                <tr>
                                    <th><span>链接</span></th>
                                    <th><span>章节</span></th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(isset($book['menu']) && !empty($book['menu'])){
                                foreach($book['menu'] as $k=>$v){ ?>
                                <tr>
                                    <td>

                                        <a href="/book/getContent?bid=<?=$book['id']?>&url=<?=$v['url']?>&word={{ urldecode(request()->input('word','')) }}"
                                           class="user-link"><?=$v['url']?></a>

                                    </td>

                                    <td>
                                        <?=$v['title']?>
                                    </td>

                                </tr>
                                <?php } }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row"></div>
            <script>
                function addBook2(s, th) {
                    $.post('/book/delBook', {book_title: s}, function () {
                        alert('del success');
                        $(th).parent().parent().parent().parent().parent().parent().hide();
                    }, 'json');
                }
            </script>
            <!--遍历书架 -->

            <?php if(!empty($book_cookie)){

                foreach($book_cookie as $v){

                ?>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="main-box clearfix profile-box-contact">
                        <div class="main-box-body clearfix">
                            <div class="profile-box-header gray-bg clearfix">
                                <img src="{{ $bv['value']['face_image_url'] or '' }}" alt="" class="profile-img img-responsive"/>
                                <h2>{{ $bv['value']['author'] or '' }}</h2>
                                <div class="job-position">
    {{ $bv['value']['title'] or '' }}
                                </div>
                                <ul class="contact-details">
                                    <li>
                                        <button class="btn btn-danger" onclick="addBook2('{{ $bv["value"]["title"] or "" }}',this)">
                                            删除书架
                                        </button>
                                    </li>

                                    <li><a href="/book/search?word={{ $bv['value']['title'] }}">
                                            <button class="btn btn-warning">阅读最新章节</button>
                                        </a></li>

                                </ul>
                            </div>

                            <div class="profile-box-footer clearfix">
    {{ $bv['value']['short_description'] }}
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }
            }
            ?>

        </div>
    </div>


@endsection

@section('after')

@endsection