<link href="{{ CSS('category/right.css') }}" rel="stylesheet" />
<link href="{{ CSS('category/form.css') }}" rel="stylesheet" />
<script src="{{ JS('core/jquery.js') }}"></script>
<div id="content">
    <div class="content-top"><a href="/category/index">分类管理</a></div>
    <div class="section-div">分类列表:(分类名称20个字限制)</div>
    <div class="section-div">
        <form action="/category/add" id="form1" method="post">

            @foreach($result as $v)

                @if ( $v->pid == 0)

                    <div class="top_{{ $v->id or '' }} category">
                        <div><a href="javascript:;" onclick="topshow('top_{{ $v->id or ''}}',this)">★</a></div>
                        <div><input type="text" value="{{ $v->name or ''}}" id="top_{{ $v->id  or '' }}" /></div>
                        <div><a href="javascript:;" onclick="add('{{ $v->id  or '' }}')">@添加子类</a>&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="edit('{{ $v->id  or '' }}')">@提交编辑</a>&nbsp;&nbsp;&nbsp;<a href="#" onclick="del('{{ $v->id  or '' }}')">删除分类</a></div>
                    </div>
                @else
                    <div class="top_{{ $v->pid }}_child category" style="display:block;">
                        <span>————————<input type="text" name="" value="{{ $v->name or ''}}" id="top_{{ $v->id  or '' }}"/></span>
                        <span><a href="javascript:;" onclick="edit('{{ $v->id  or '' }}')">@提交编辑</a>&nbsp;&nbsp;&nbsp;<a href="#" onclick="del('{{ $v->id  or ''}}')">删除分类</a></span>
                    </div>

                @endif
            @endforeach

            <div onclick="addtop(this)"><a href="javascript:;" >@添加顶级分类</a></div>
            <div onclick="sub()"><a href="javascript:;">@提交数据</a></div>
        </form>
    </div>
</div>
<script>
    function add(obj){

        var $a=$(obj);
        var form='<div class="top_'+obj+'_child" style="display:block;">输入分类名称：<input type="text" name="child'+obj+'[]" value="" /><a href="#" onclick="$(this).parent().hide()">【CLOSE】</a></div>';

        $(form).insertAfter($('.top_'+obj));

    }

    function topshow(obj1,obj2){

        if($('.'+obj1+'_child')[0].style.display=='block'){
            $('.'+obj1+'_child').css('display','none');
        }else{
            $('.'+obj1+'_child').css('display','block');
        }
        if(obj2.innerHTML=='★'){
            obj2.innerHTML='☆';
        }else{
            obj2.innerHTML='★';
        }
    }

    function addtop(obj){
        var $a=$(obj);
        var form='<div class="jsform" style="display:block;">输入顶级分类名称：<input type="text" name="top[]" value="" /></div>';
        $(form).insertBefore($a);
    }

    function sub()
    {
        $('#form1').submit();

    }
    function del(obj)
    {
        if(confirm('确定吗')){
            location.href='/category/del?id='+obj;
        }
    }

    function edit(obj)
    {
        var data=$('#top_'+obj).val();
        window.location='/category/edit?data='+data+'&id='+obj;
    }
</script>