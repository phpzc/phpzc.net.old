/**
 * User to Login and Register
 *
 * @author zhangcheng zhang5474jj@163.com
 * @version $Id$
 * @package
 * @license http://opensource.org/licenses/MIT     The MIT License (MIT)
 * @copyright Copyright (c) 2014, ZhangCheng 2014/04/02
 **/

/**/

VIP.namespace('User');

VIP.User = {
    reg:function(){
    	$(".form_notice").html("");
        VIP.Layer.show();
       
        $('#userreg').show();
        var w = $('#userreg').width();
        $('#userreg').css("left",(VIP.Layer.width()-w)/2);
        $('#TipBox').fadeIn();
    },
    login:function(){
    	$(".form_notice").html(""); 
    	VIP.Layer.show();
         
         $('#userlogin').show();
         
         var w = $('#userlogin').width();
        
         $('#userlogin').css("left",(VIP.Layer.width()-w)/2);
         $('#TipBox').fadeIn();
    },
    create:function(l,r){
           //$('.G_layer').show();
           //alert(2);
    },
    regTip:function(){
        //注册提交 和提示
        
        $('.loginbtn2').click(function(){
            //取得数据
            var e = $('#regEmail').val().replace( /^\s+|\s+$/g, "" );
            var p = $('#regPassword').val().replace( /^\s+|\s+$/g, "" );
            var n = $('#regUsername').val().replace( /^\s+|\s+$/g, "" );
            if( e.indexOf("输入邮箱") == 0 )
            {   
                return;
            }
            if( p.indexOf("输入密码") == 0 )
            {   
                return;
            }
            if( n.indexOf("输入昵称") == 0 )
            {
                return;
            }            
            var c = $('input[name=regcode]').val();
          
            //校验数据
            var f =false;
            $(".form_notice").html("");
            
            if(!VIP.Form.email(e)){
                $(".form_notice").append("<p>邮箱格式不正确</p>");
                f = true;
            }
            
            if(!VIP.Form.checkLength(e,32)){
                $(".form_notice").append("<p>邮箱长度不能超过32位</p>");
                f = true;
            }
            
            if(!VIP.Form.checkLength(p,32)){
                $(".form_notice").append("<p>密码长度不能超过32位</p>");
                f = true;
            }

            if(!VIP.Form.checkLength(c,32))
            {
                $(".form_notice").append("<p>网站校验码缺失非法等陆</p>");
                f = true;
            }
            if(!VIP.Form.checkLength(n,32))
            {
                $(".form_notice").append("<p>昵称长度不能超过32个长度</p>");
                f = true;
            }
            if(f){return;}
            $.ajax({
                type:"POST",
                url:VIP.Base()+"/user/reg",
                data:"email="+e+"&password="+p+"&code="+c+"&name="+n,
                async:true,
                dataType:"json",
                success: function(msg)
                {
                    
                    if(msg.success == 1)
                    {
                        window.location.reload();
                    }
                    else
                    {
                        $(".form_notice").append("<p>"+msg.error_str+"</p>");
 
                    }
                }
            });
        
        });   
    },
    loginTip:function(){
        //登录提示 教教          
        $('.loginbtn').click(function(){
            //取得数据
            var e = $('#loginEmail').val().replace( /^\s+|\s+$/g, "" );
            var p = $('#loginPassword').val().replace( /^\s+|\s+$/g, "" );

            if( e.indexOf("输入邮箱登录") == 0 )
            {
                
                return;
            }
            if( p.indexOf("输入密码登录") == 0 )
            {
                
                return;
            }
            var c = $('input[name=logincode]').val();
           
            if( $('#auto_login_checkbox').attr("checked"))
            {
                var auto = 1;
            }else{
                var auto = 0;
            }
            //校验数据
            var f =false;
            $(".form_notice").html("");
            
            if(!VIP.Form.email(e)){
                $(".form_notice").append("<p>邮箱格式不正确</p>");
                f = true;
            }
            
            if(!VIP.Form.checkLength(e,32)){
                $(".form_notice").append("<p>邮箱长度不能超过32位</p>");
                f = true;
            }
            
            if(!VIP.Form.checkLength(p,32)){
                $(".form_notice").append("<p>密码长度不能超过32位</p>");
                f = true;
            }

            if(!VIP.Form.checkLength(c,32))
            {
                $(".form_notice").append("<p>网站校验码缺失非法等陆</p>");
                f = true;
            }
            if(f){return;}
            $.ajax({
                type:"POST",
                url:VIP.Base()+"/user/login",
                data:"email="+e+"&password="+p+"&code="+c+"&auto="+auto,
                async:true,
                dataType:"json",
                success: function(msg)
                {
                    
                    if(msg.success == 1)
                    {
                        window.location.reload();
                    }
                    else
                    {
                        $(".form_notice").append("<p>"+msg.error_str+"</p>");
 
                    }
                }
            });
        
        });   
    },
    //新的帐号绑定
    accountBindNew:function(){
        $('#accountNewSub').click(function(){
 
            //取得数据
            var u = $('#new_username').val().replace( /^\s+|\s+$/g, "" );
            var p = $('#new_password').val().replace( /^\s+|\s+$/g, "" );
            var c = $('#form_code').val();
            var name = $('#new_name').val();
            
            var t = $('#current_type').val();
       
            if( u.indexOf("请输入邮箱") == 0 )
            {    
                return;
            }
            if( p.indexOf("请输入密码") == 0 )
            {
                
                return;
            }
            
            //验证
            $('#error_box_new').html("");
            var f = false;

            if(!VIP.Form.checkLength(name,32)){
                $("#error_box_new").append("<p>昵称长度不能超过32个长度，汉字长度3,英文数字长度1</p>");
                f = true;
            }


            if(!VIP.Form.checkLength(u,32))
            {
                $("#error_box_new").append("<p>邮箱长度不能超过32个长度</p>");
                f = true;
            }


            if(!VIP.Form.email(u))
            {
                $("#error_box_new").append("<p>邮箱格式不正确</p>");
                f = true;
            }
            if(!VIP.Form.checkLength(p,32))
            {
                $("#error_box_new").append("<p>密码长度不能超过32个长度</p>");
                f = true;
            }
            
            
            if(f){return;}
            $.ajax({
                type:"POST",
                url:VIP.Base()+"/user/accountBindNew",
                data:"username="+u+"&password="+p+"&code="+c+"&type="+t+"&name="+name,
                async:true,
                dataType:"json",
                success: function(msg)
                {
                    
                    if(msg.success == 1)
                    {
                        //跳到首页
                        window.location.href = VIP.Base()+"/index/index.html";
                        //window.location.reload();
                    }
                    else
                    {
                        $("#error_box_new").append("<p>"+t+msg.error_str+"</p>");
                        
                    }
                }
            });

        });


    },
    //绑定已经有的帐号
    accountBindOld:function(){
        
        $('#accountOldSub').click(function(){
           
            //取得数据
            var u = $('#old_username').val().replace( /^\s+|\s+$/g, "" );
            var p = $('#old_password').val().replace( /^\s+|\s+$/g, "" );
            var c = $('#form_code').val();
           
            var t = $('#current_type').val();
            
            if( u.indexOf("请输入邮箱") == 0 )
            {    
                return;
            }
            if( p.indexOf("请输入密码") == 0 )
            {
                
                return;
            }
            
            //验证
            $('#error_box_old').html("");
            var f = false;

            if(!VIP.Form.checkLength(u,32))
            {
                $("#error_box_old").append("<p>邮箱长度不能超过32个长度</p>");
                f = true;
            }


            if(!VIP.Form.email(u))
            {
                $("#error_box_old").append("<p>邮箱格式不正确</p>");
                f = true;
            }
            if(!VIP.Form.checkLength(p,32))
            {
                $("#error_box_old").append("<p>密码长度不能超过32个长度</p>");
                f = true;
            }
            
            
            if(f){return;}
            $.ajax({
                type:"POST",
                url:VIP.Base()+"/user/accountBindOld",
                data:"username="+u+"&password="+p+"&code="+c+"&type="+t,
                async:true,
                dataType:"json",
                success: function(msg)
                {
                    
                    if(msg.success == 1)
                    {
                        //跳到首页
                        window.location.href = VIP.Base()+"/index/index.html";
                        //window.location.reload();
                    }
                    else
                    {
                        $("#error_box_old").append("<p>"+msg.error_str+"</p>");
                        
                    }
                }
            });

        });
    },

    //检测用户是否已经登录函数
    checkAuthWithUrl:function(id,url)
    {
        if(id == ''){

        	VIP.MessageBox.createBoxConfirmCancle("请登录后再操作！",{callback:function(){
        		$('#login').click();
        	},data:null})
        
        }
        else
            window.location.href=url;
    },
    checkAuth:function(id)
    {
        if(id == ''){
        	VIP.MessageBox.createBoxConfirmCancle("请登录后再操作！",{callback:function(){
        		$('#login').click();
        	},data:null})
        	return true;
        }else{
        	return false;
        }
        
    },
};


