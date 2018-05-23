@extends('layouts.layout')

@section('content')

    <div class="row">
        <?php if(!empty($photo)){ ?>
        @foreach($photo as $v)

                <div class="col-sm-6 col-lg-4">
                    <div class="card p-3">
                        <a href="javascript:void(0)" class="mb-3">
                            <img src="{{ $v['imgurl'] }}" class="rounded">
                        </a>

                    </div>
                </div>
        @endforeach
        <?php } ?>
    </div>



    <script src="{{ JS('jquery.lazyload.js?v=1.9.1') }}"></script>

    <script type="text/javascript" charset="utf-8">
        $(function() {
            $("img.lazy").lazyload({effect: "fadeIn"});
        });
    </script>
@endsection


