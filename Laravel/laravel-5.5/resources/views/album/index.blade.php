@extends('layouts.layout')


@section('content')
    <div class="row">
        @foreach($album_list as $v)

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Carousel</h3>
                    </div>
                    <div class="card-body">
                        <div id="carousel-default" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <a href="/album/detail?id={{ $v['realid'] }}"><img class="d-block w-100" alt="" src="{{ $v['face'] or '/Public/img/pic-none.png' }}" data-holder-rendered="true" style="height: 200px;"></a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach

    </div>

@endsection
