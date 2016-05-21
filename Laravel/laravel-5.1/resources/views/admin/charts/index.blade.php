@extends('admin.layouts.main')

@section('before_head')
    <link rel="stylesheet" href="{{ CUBE('css/libs/morris.css') }}" type="text/css" />
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box">
                <header class="main-box-header clearfix">
                    <h2>Morris Area charts————综合统计数量 本年度</h2>
                </header>

                <div class="main-box-body clearfix">
                    <div id="hero-area"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('after')
        <!-- this page specific scripts -->
    <script src="{{ CUBE('js/jquery.knob.js') }}"></script>
    <script src="{{ CUBE('js/raphael-min.js') }}"></script>
    <script src="{{ CUBE('js/morris.js') }}"></script>
    <script>
    $(function($) {

        graphArea2 = Morris.Area({
            element: 'hero-area',
            data: [
                    /*
                {period: '2010-01-01', iphone: 2666, ipad: null, itouch: 2647},
                {period: '2010-02-02', iphone: 2778, ipad: 2294, itouch: 2441},
                {period: '2010-03-03', iphone: 4912, ipad: 1969, itouch: 2501},
                {period: '2010-04-04', iphone: 3767, ipad: 3597, itouch: 5689},
                {period: '2010-05-05', iphone: 6810, ipad: 1914, itouch: 2293},
                {period: '2010-06-06', iphone: 5670, ipad: 4293, itouch: 1881},
                {period: '2010-07-07', iphone: 4820, ipad: 3795, itouch: 1588},
                {period: '2010-08-08', iphone: 15073, ipad: 5967, itouch: 5175},
                {period: '2010-09-09', iphone: 10687, ipad: 4460, itouch: 2028},
                {period: '2010-10-10', iphone: 8432, ipad: 5713, itouch: 1791}
                */

                    @foreach ($data as $v)
                    {period:'{{ $v['period'] }}',article:{{ $v['article'] }}, photo:{{ $v['photo']  }} ,'document':{{ $v['document'] }} },
                    @endforeach
            ]


            ,
            lineColors: ['#0288d1', '#607d8b', '#689f38', '#8e44ad', '#c0392b', '#f39c12'],
            xkey: 'period',
            ykeys: ['article', 'photo', 'document'],
            labels: ['博客', '图片', '文档'],
            pointSize: 2,
            hideHover: 'auto',
            resize: true
        });
    });
    </script>
@endsection