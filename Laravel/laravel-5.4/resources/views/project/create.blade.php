@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box">
                <header class="main-box-header clearfix">
                    <h2>Project create form</h2>
                </header>

                <div class="main-box-body clearfix">
                    <form class="form-horizontal" role="form" action="/project/create_project" method="post" id="current_form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="form_title" class="col-lg-2 control-label">Project name：</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="form_title" placeholder="Title" name="name" />
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
