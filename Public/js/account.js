/**
 * Created by zc on 2015/11/18.
 */
$(function(){
    var error_class = 'has-error';
    var success_class = 'has-success';


    $('#join').click(function(){
        var btn = $(this);
        btn.button('loading');

        //btn.button('reset');

        var u = $('#inputEmail').val().replace( /^\s+|\s+$/g, "" );
        var p = $('#Password1').val().replace( /^\s+|\s+$/g, "" );
        var c = $('#form_code').val();
        var name = $('#inputName1').val();

        var t = $('#current_type').val();

        //验证
        $('#error_box_new').html("");
        var f = false;

        if(!VIP.Form.checkLengthEx(name,1,32)){
            $("#inputName1").parent().addClass(error_class);
            $("#inputName1").siblings('span').html('昵称长度不能超过32个长度，汉字长度3,英文数字长度1,1-32个字');

            f = true;
        }


        if(!VIP.Form.checkLength(u,32))
        {
            $("#inputEmail").parent().addClass(error_class);
            $("#inputEmail").siblings('span').html('邮箱长度不能超过32个长度');

            f = true;
        }


        if(!VIP.Form.email(u))
        {
            $("#inputEmail").parent().addClass(error_class);
            $("#inputEmail").siblings('span').html('邮箱格式不正确');

            f = true;
        }
        if(!VIP.Form.checkLength(p,32))
        {
            $("#Password1").parent().addClass(error_class);
            $("#Password1").siblings('span').html('密码长度不能超过32个长度');

            f = true;
        }


        if(f){ btn.button('reset'); return;}

        $.ajax({
            type:"POST",
            url:"/user/accountBindNew",
            data:"username="+u+"&password="+p+"&code="+c+"&type="+t+"&name="+name,
            async:true,
            dataType:"json",
            success: function(msg)
            {
                btn.button('reset');
                if(msg.success == 1)
                {
                    //跳到首页
                    window.location.href = "/index/index.html";
                    //window.location.reload();
                }
                else
                {
                    alert(msg.error_str);

                }
            }
        });
    });
    $('#bind').click(function(){
        var btn = $(this);
        btn.button('loading');

        //取得数据
        var u = $('#inputEmail1').val().replace( /^\s+|\s+$/g, "" );
        var p = $('#inputPassword1').val().replace( /^\s+|\s+$/g, "" );
        var c = $('#form_code').val();

        var t = $('#current_type').val();

        //验证

        var f = false;

        if(!VIP.Form.checkLength(u,32))
        {
            $("#inputEmail1").parent().addClass(error_class);
            $("#inputEmail1").siblings('span').html('邮箱长度不能超过32个长度');
            f = true;
        }


        if(!VIP.Form.email(u))
        {
            $("#inputEmail1").parent().addClass(error_class);
            $("#inputEmail1").siblings('span').html('邮箱格式不正确');

            f = true;
        }
        if(!VIP.Form.checkLength(p,32))
        {
            $("#inputPassword1").parent().addClass(error_class);
            $("#inputPassword1").siblings('span').html('密码长度不能超过32个长度');

            f = true;
        }


        if(f){btn.button('reset'); return;}
        $.ajax({
            type:"POST",
            url:"/user/accountBindOld",
            data:"username="+u+"&password="+p+"&code="+c+"&type="+t,
            async:true,
            dataType:"json",
            success: function(msg)
            {

                if(msg.success == 1)
                {
                    //跳到首页
                    window.location.href = "/index/index.html";
                    //window.location.reload();
                }
                else
                {
                    alert(msg.error_str);

                }
            }
        });


    });
});