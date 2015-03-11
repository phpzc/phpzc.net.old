/**
 * core.js
 *    ---base on jquery
 * @author zhangcheng zhang5474jj@163.com
 * @version $Id$
 * @package
 * @license http://opensource.org/licenses/MIT     The MIT License (MIT)
 * @copyright Copyright (c) 2014, ZhangCheng 2014/04/03
 **/

/*
 * <scriptsrc="http://code.jquery.com/jquery-1.11.0.min.js"></script>
 * */

var VIP={};
VIP.namespace = function(str){
    var arr = str.split('.'), o = VIP;
    for(i=(arr[0]=="VIP")?1:0; i<arr.length; i++)
    {
        o[arr[i]] = o[arr[i]] || {};
    }
    o = o[arr[i]];
};

//event
//获取事件的发生的对象
function getEventTarget(e)
{
    e = window.event || e;
    return e.srcElement || e.target;

}


//事件冒泡
//阻止事件的传递
function stopPropagation(e)
{
    e = window.event || e;
    if(document.all)
    {
        //ie
        e.cancelBubble = true;
    }
    else
    {
        //firefox
        e.stopPropagation = true;
    }
}

//添加onXXXX事件
// 监听事件的叠加处理
function on(node,evenType,handler)
{
    node = typeof node == "string" ? document.getElementById(node):node;
    if(document.all)
    {
        node.attachEvent("on"+evenType, handler);
    }
    else
    {
        node.addEventListener(eventType, handler, false);
    }
}

// js判断处理
// 处理字符串
// 类型判断

function isNumber(s)
{
    return !isNaN(s);
}

function isString(s)
{
    return typeof s === "string";
}

function isBoolean(s)
{
    return typeof s === "boolean";
}

function isFunction(s)
{
    return typeof s === "function";
}

function isNull(s)
{
    return s === null;
}

function isUndefined(s)
{
    return typeof s === "undefined";
}

function isEmpty(s)
{
    return /^\s*$/.test(s);
}

function isArray(s)
{
    return s instanceof Array;
}

function VIPLog(msg)
{
	console.log(msg);
}

VIP.Base = function(){
    //获取基础地址
    var Base = window.location.href;
    var i= Base.indexOf('.com');
    if( i==-1){
        return false;
    }
    Base = Base.substring(0,i+4);

    return Base;
}
//跳转
VIP.Jump = function(data)
{
    var Base = VIP.Base();
    
    if(isString(data))
    {
        window.location.href = Base+data;
    }else{
    	window.open(data.url,"_blank");
    }

}


//load file
VIP.LoadScript = function(url)
{
    var script = document.createElement('script');

    script.type = "text/javascript";
    script.src = VIP.Base()+url;
    document.body.appendChild(script);
}
//load script text
VIP.LoadScriptString = function(code)
{
    var script = document.createElement('script');
    script.type = "text/javascript";
    try{
        script.appendChild(document.createTextNode(code));
    }catch(e){
        script.text = code;
    }
    document.body.appendChild(script);
}

//load css file
VIP.LoadStyle = function(url)
{
    var link = document.createElement("link");
    link.type = "text/css";
    link.rel = "stylesheet";
    link.href = url;
    var head = document.getElementsByTagName('head')[0];
    head.appendChild(link);
}
// load css text
VIP.LoadStyleString = function(code)
{
    var style = document.createElement("style");
    style.type = "text/css";
    try{
        style.appendChild(document.createTextNode(code));
    }catch(e){
        style.styleSheet.cssText = code;
    }
    var head = document.getElementsByTagName('head')[0];
    head.appendChild(style);

}
// jQuery Object to Dom Object
VIP.ToDom = function(obj,index)
{
    return obj[index];
}

// Dom Object to jQuery Object
VIP.TojQuery = function(obj)
{
    return $(obj);
}

VIP.namespace("Layer");
VIP.Layer = {
		layer : function(){
			
			return $('.G_layer');
		},
		cleanAll:function()
		{
			$('.G_layer').empty();
			$('.G_layer').hide();
		},
		show:function()
		{
			$('.G_layer').show();
		},
		hide:function(){
			$('.G_layer').hide();
		},
		width:function(){
			return document.body.clientWidth;
		},
		height:function(){
			return document.body.clientHeight;
		},
		/*
		 * 设置位置为中心
		 */
		center:function(obj)
		{
	        var w = obj.width();
	        //alert(window.screen.height )
	        obj.css("left",(VIP.Layer.width()-w)/2);
	        obj.css("top",(window.screen.availHeight-obj.height())/2);
		}
};

//关闭按钮
/*清除自身*/
function CleanClose(obj)
{
	obj.click(function(){
		VIP.Layer.cleanAll();
	})
}
function HideClose(obj)
{
	obj.click(function(){
		obj.parent().parent().hide();
        obj.parent().parent().parent().hide();
		VIP.Layer.hide();	
	})

}

//事件对象存储器
VIP.namespace("Event");
VIP.Event = {
	_data : [],
	getData : function(){
		return VIP.Event._data
	},
	addObject: function(v)
	{
		VIP.Event._data[VIP.Event._data.length] = v
	},
	removeObject : function(obj){
		for(v in this._data){
			if (this._data[v] == obj ){
				this._data[v] = null
				break;
			}
		}
	},
	getLength:function()
	{
		return _data.length;
	},
};
window.onresize = function()
{

	for(v in VIP.Event.getData())
	{
		VIPLog(v)
		if(v != null){
			VIP.Layer.center(VIP.Event.getData()[v])
		}
			
	}
}