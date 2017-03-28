@extends('layouts.main')
@section('head')
    <link rel="stylesheet" href="{{ CUBE('/css/libs/select2.css') }}" type="text/css" />
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="main-box">
                <header class="main-box-header clearfix">
                    <h2>Article create form</h2>
                </header>

                <div class="main-box-body clearfix">
                    <form class="form-horizontal" role="form" action="" method="post" id="current_form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Article</label>
                            <div class="col-lg-10">
                                <select class="form-control" name="article_id">

                                        @foreach($article as $v)
                                        <option value="{{ $v['id'] }}">{{ $v['title'] }}</option>
                                        @endforeach

                                </select>

                                <input type="hidden" name="id" value="{{ request()->input('id') }}">
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button  type="button" onclick="document.getElementById('current_form').submit()" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
