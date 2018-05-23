<div class="col-lg-4 order-lg-1 mb-4">
{{--
<div class="example  mb-4">
    <h3>Tags</h3>
    <div class="tags">
                @foreach($tag as $v)
                    @if( $v->name != null )
                    <span class="tag tag-dark">
                        {{ $v->name }}
                        <span class="tag-addon tag-gray">{{ $v->article_count }}</span>
                    </span>
                    @endif
                @endforeach

    </div>
</div>
--}}

<div class="mb-4 col-ld-12">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Hot</h2>
        </div>
        <table class="table card-table">
            @foreach($top as $k=>$v)
                <tr>
                    <td>{{ $k+1 }}</td>
                    <td class="text-left">
                        <a href="/article/detail?id={{ $v['id'] }}" target="_blank">{{ $v['title'] }}</a>
                    </td>
                </tr>
            @endforeach

        </table>
    </div>
</div>


<div class="example  mb-4">
    <h3>Links</h3>

    @foreach($links as $v)
        <div class="col-sm-12 mb-1">
            <a href="{{ $v['url'] }}" target="_blank" class="btn btn-outline-primary" style="word-break: break-all" title="{{ $v['name'] }}"><i class="fe fe-link mr-2" ></i>{{ cut_str($v['name'],14) }}</a>
        </div>
    @endforeach

</div>
</div>