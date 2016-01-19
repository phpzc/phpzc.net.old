/**
 * Created by zc on 2015/12/24.
 */

var __form_tools = {
    is_phone: function (str) {
        if (!/(13[0-9]|15[012356789]|18[0-9]|14[57]|17[0-9])[0-9]{8}$/.test(parseInt(str))) {
            return false;
        } else {
            return true;
        }
    },
    getStrLength: function (str) {
        if( this.isEmpty(str)){
            return 0;
        }
        var realLength = 0;
        var len = str.length;

        var charCode = -1;
        for (var i = 0; i < len; i++) {
            charCode = str.charCodeAt(i);
            if (charCode >= 0 && charCode <= 128) {
                realLength += 1;
            } else {
                // 如果是中文则长度加3
                realLength += 3;
            }
        }
        return realLength;
    },
    checkLength: function (str, len) {
        return this.getStrLength(str) <= len;
    },
    checkLengthEx: function (str, min, max) {

        return this.getStrLength(str) >= min && this.getStrLength(str) <= max;
    },

    isAlphaNumeric:function(str){
        var Regx = /^[A-Za-z0-9]*$/;
        if (Regx.test(str)) {
            return true;
        }
        else {
            return false;
        }
    },

    isNumber: function (s) {
        return !isNaN(s);
    },

    isString: function (s) {
        return typeof s === "string";
    },

    isBoolean: function (s) {
        return typeof s === "boolean";
    },

    isFunction: function (s) {
        return typeof s === "function";
    },

    isNull: function (s) {
        return s === null;
    },

    isUndefined: function (s) {
        return typeof s === "undefined";
    },

    isEmpty: function (s) {
        return /^\s*$/.test(s);
    },

    isArray: function (s) {
        return s instanceof Array;
    },
    toInteger:function(s){
        var v = parseInt(s);
        if(!this.isNumber(v)){
            return 0;
        }else{
            return v;
        }
    },
    toFloat:function(s){
        var v = parseFloat(s);
        if(!this.isNumber(v)){
            return 0;
        }else{
            return v;
        }
    },
    toString:function(s){

        if(!this.isString(s)){
            return '';
        }else{
            return v;
        }
    },
    isEmail:function(str){
        var myreg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return myreg.test(str);
    },
    isLoading:false,
    lock:function(){this.isLoading = true},
    unLock:function(){this.isLoading = false},
    isLocked:function(){return this.isLoading},
};

var Form_Validator = Object.create(__form_tools);