@extends('layouts.main')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                <header class="main-box-header clearfix">
                    <h2>{{ $articles->total() }} results found for: <span class="emerald">&quot;{{ $search_name }}&quot;</span></h2>
                    <small class="gray">Request time ({{ $need_time }} seconds)</small>
                </header>

                <div class="main-box-body clearfix">
                    <div id="search-form">
                        <form action="/article/search" method="get">
                            <div class="input-group">
                                <input type="text" name="category" value="{{ $search_name }}" class="form-control input-lg"/>
                                <div class="input-group-btn">
                                    <button class="btn btn-lg btn-primary" type="">
                                        <i class="fa fa-search"></i> Search
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <ul id="search-results">
                        @foreach($article_list as $article)
                            <li>
                                <h3 class="title">
                                    <a href="/article/detail?id={{ $article['id'] }}" target="_blank">
                    {{ cut_str(htmlspecialchars_decode($article['title']),40) }}
                                    </a>
                                </h3>
                                <div class="link-title">
                                    <?php echo NET_NAME;?>/article/detail?id={{ $article['id'] }}
                                </div>
                                <div class="desc">
                                    {{ cut_str($article['content'],300) }}
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection