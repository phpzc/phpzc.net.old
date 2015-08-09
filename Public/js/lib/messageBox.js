/*
 * @author zhangcheng
 * 
 * @desc 需啊core.js支持
 * @time 2014年9月20日22:30:39
 */
VIP.namespace("MessageBox");

function VIP_messageBox_createBody()
{
	// top 180
	// left 自动
	//  img\button ORB_Icons_by_013.png 32   error
	//  ORB_Icons_by_014.png                           right
	//var cssStr = "";
	//VIP.LoadStyleString(cssStr)
	
	var str = "<div id='VIP_messageBox'>\
			<div class='VIP_messageBox_close '>"+VIP.WEBSITE_NAME+" 提示<span></span></div>\
			<div class='VIP_messageBox_content'></div>\
			<div class='VIP_messageBox_bottom'></div>\
					</div>";
	var str1 = "<div id='VIP_messageBox_layer'></div>";
	$(document.body).append(str1);
	var layer = $('#VIP_messageBox_layer');
	$(document.body).append(str);
	var Msg = $('#VIP_messageBox');
	var w = Msg.width();
	Msg.css("left",(VIP.Layer.width()-w)/2);
	var h = VIP.Layer.height();
	VIPLog(h);
	//Msg.css("top","300px");
	
	$(".VIP_messageBox_close").click(function(){
		VIP_messageBox_removeBody();
	});

};
function VIP_messageBox_removeBody()
{
	$("#VIP_messageBox_layer").remove();
	$("#VIP_messageBox").remove();
	
}
/*
 * obj{"callback":function(param)....,"data":....}
 * */
function VIP_messageBox_addOK(obj)
{
	var str= "<span id='message_ok'></span>";
	$('.VIP_messageBox_bottom').append(str);
		
	if(isFunction(obj.callback))
	{
		if (obj.data != null){
			$('#message_ok').click(function(){
				obj.callback(obj.data);
				VIP_messageBox_removeBody();
			});
		}
		else
		{
			$('#message_ok').click(function(){
				obj.callback();
				VIP_messageBox_removeBody();
			});
		}
	}
	else
	{
		$('#message_ok').click(function(){
			VIP_messageBox_removeBody();
		});
		$('#message_ok').css("width",$('.VIP_messageBox_bottom').css("width"));
		$('#message_ok').hover(function(){
			$(this).css("background-color","#000");
			$(this).addClass("VIP_messageBox_hover");
		},function(){
			$(this).removeClass("VIP_messageBox_hover");
			$(this).css("background-color",$('.VIP_messageBox_close').css("background-color"));
		});
	}
}

/*
 * 确定 取消 回调
 * obj{"callback":function(param)....,"data":....}
 * */
function VIP_messageBox_addOKNO(obj)
{
	var str= "<span id='message_no'></span><span id='message_split'></span><span id='message_ok'></span>";
	$('.VIP_messageBox_bottom').append(str);
	
	//取消 清除所有dom
	$('#message_no').click(function(){
		VIP_messageBox_removeBody();
	});
	
	if(isFunction(obj.callback))
	{
		if (obj.data != null){
			$('#message_ok').click(function(){
				obj.callback(obj.data);
				VIP_messageBox_removeBody();
			});
		}
		else
		{
			$('#message_ok').click(function(){
				obj.callback();
				VIP_messageBox_removeBody();
			});
		}
		
	}

		$('#message_ok').hover(function(){
			$(this).addClass("VIP_messageBox_hover");
			$(this).css("background-color","#000");
		},function(){
			$(this).removeClass("VIP_messageBox_hover");
			$(this).css("background-color",$('.VIP_messageBox_close').css("background-color"));
		});
		$('#message_no').hover(function(){
			$(this).addClass("VIP_messageBox_hover");
			$(this).css("background-color","#000");
		},function(){
			$(this).removeClass("VIP_messageBox_hover");
			$(this).css("background-color",$('.VIP_messageBox_close').css("background-color"));
		});
}




function VIP_messageBox_addContent(obj)
{
	var str = "<center><p>"+obj+"</p></center>";
	$('.VIP_messageBox_content').append(str);
	
}

function VIP_messsageBox_autoRemove()
{
	setTimeout(function(){
		$('#VIP_messageBox_layer').remove();
		$('#VIP_messageBox').animate({opacity:0},700,null,function(){
			$(this).remove();
		})
	},700);
};

VIP.MessageBox = {
		//无按钮  纯提示 用户自己点关闭
		createBox: function(message)
		{
			VIP_messageBox_createBody();
			VIP_messageBox_addOK({});
			VIP_messageBox_addContent(message);
			
		},
		// 无按钮 自动消失
		createBoxAuto:function(message)
		{
			VIP_messageBox_createBody();
			VIP_messageBox_addContent(message);
			VIP_messsageBox_autoRemove();
		},
		// 确定 回调
		//
		//  obj {		callback:function,
		//				data:{}
		//			}
		createBoxConfirm:function(message,obj)
		{
			VIP_messageBox_createBody();
			VIP_messageBox_addOK(obj);
			VIP_messageBox_addContent(message);
		},
		//
		createBoxConfirmCancle:function(message,obj)
		{
			VIP_messageBox_createBody();
			VIP_messageBox_addOKNO(obj);
			VIP_messageBox_addContent(message);
		},
};

