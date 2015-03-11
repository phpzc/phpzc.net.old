/**
 * common.js
 *      some functions
 * @author zhangcheng zhang5474jj@163.com
 * @version $Id$
 * @package
 * @license http://opensource.org/licenses/MIT     The MIT License (MIT)
 * @copyright Copyright (c) 2014, ZhangCheng 2014/04/03
 **/


//cookie
VIP.namespace("Cookie");
VIP.Cookie = {
    set: function(name,value,expires){
        var expDays = expires*24*60*60*1000;
        var expDate = new Date();
        expDate.setTime(expDate.getTime()+expDays);

        var expString = expires? ";  expires="+expDate.toGMTString():"";
        var pathString = ";path=/";
        document.cookie = name+"="+escape(value)+expString+pathString;


    },
    get: function(name){
        var cookieStr = ";  "+document.cookie+";  ";
        var index = cookieStr.indexOf(";  "+name+"=");
        if(index != -1)
        {
            var s = cookieStr.substring(index+name.length+3,cookieStr.length);
            return unescape(s.substring(0,s.indexOf(";")));
        }
        else
        {
            return null;
        }
    },
    del: function(name){
        var exp = new Date(new Date().getTime()-1);
        var s = this.get(name);
        if(s != null)
        {
            document.cookie = name+"="+s+";expires="+exp.toGMTString()+";path=/";
        }
    },
};


//Layer 自定义一层全局layer透明分布整页  清除的时候 可以直接清除布局与其上层的所有弹出框
VIP.namespace('Layer');
VIP.Layer = {
    
    clean:function(){},
    create:function(){},

};

ajax

resize

drag

animation

tab

tree

msg

color

date

texteditor
//反序列化
VIP.Eval = function(str)
{
    return eval("("+str+")");
}



//自定义属性获取 和默认属性获取  class->className
//默认属性获取
VIP.Get = function(obj,name)
{
    return obj.name;
    
}
//自定义属性获取
VIP.GetAttr = function(obj,name)
{
    return obj.getAttribute(name);
}

