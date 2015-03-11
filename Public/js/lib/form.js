/**
 * Form - common
 *
 * @author zhangcheng zhang5474jj@163.com
 * @version $Id$
 * @package
 * @license http://opensource.org/licenses/MIT     The MIT License (MIT)
 * @copyright Copyright (c) 2014, ZhangCheng 2014/04/17
 **/
VIP.namespace('Form');
VIP.Form = {
    inputdefaultValue:function(object){
        var obj = object.obj;
        var val = object.value;
        if(obj.val() == ''){
         obj.val(val);
        }
        
        obj.click(function(){
            if($(this).val()  == val){
                $(this).val('');
            }
        });

        obj.blur(function(){
            if($(this).val() == ''){
                $(this).val(val)
            }
        });
    },
    email:function(str){
        var myreg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return myreg.test(str);   
    },
    getStrLength:function(str){
        var realLength = 0;
        var len = str.length;
        var charCode = -1;
        for(var i = 0; i < len; i++){
            charCode = str.charCodeAt(i);
            if (charCode >= 0 && charCode <= 128) { 
                realLength += 1;
            }else{ 
            // 如果是中文则长度加3
                realLength += 3;
            }
        } 
        return realLength;
    },
    checkLength:function(str,len){
        return this.getStrLength(str) <= len;
    },
};
//alert(typeof(VIP.Form.inputdefaultValue));
