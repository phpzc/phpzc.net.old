/**
 * Browser Checking File
 *
 * @author zhangcheng zhang5474jj@163.com
 * @version $Id$
 * @package
 * @license  http://opensource.org/licenses/MIT     The MIT License (MIT)
 * @copyright Copyright (c) 2014, ZhangCheng 2014/04/02
 **/

/*It need load file namespace.js*/

VIP.namespace('browser');

VIP.browser = {
    versions:function()
    {
        var u = navigator.userAgent, app = navigator.appVersion;
        var ua=navigator.userAgent.toLowerCase();  
        var s=null;
        

        return {//移动终端浏览器版本信息
                trident: u.indexOf('Trident') > -1, //IE内核
                presto: u.indexOf('Presto') > -1, //opera内核
                webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
                gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核
                mobile: !!u.match(/AppleWebKit.*Mobile.*/)||!!u.match(/AppleWebKit/) || !!u.match(/.*Linux.*/), //是否为移动终端  UC移动端发现 有Linux字段 百度移动端也有
                ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
                android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或者uc浏览器
                iPhone: u.indexOf('iPhone') > -1 || u.indexOf('Mac') > -1, //是否为iPhone或者QQHD浏览器
                iPad: u.indexOf('iPad') > -1, //是否iPad
                webApp: u.indexOf('Safari') == -1,//是否web应该程序，没有头部与底部
                
                msie:(s=ua.match(/msie\s*([\d|\.]+)/))?s[1]:false,  
                firefox:(s=ua.match(/firefox\/([\d|\.]+)/))?s[1]:false,  
                chrome:(s=ua.match(/chrome\/([/d|\.]+)/))?s[1]:false,  
                opera:(s=ua.match(/opera.([\d|\.]+)/))?s[1]:false,  
                safari:(s=ua.match(/varsion\/([\d|\.]+).*safari/))?s[1]:false 
                
            };  
    
    }(),
    language:(navigator.browserLanguage || navigator.language).toLowerCase()

};

function PrintBrowser(obj){
        document.writeln("语言版本: "+obj.browser.language+"<br/>");
        document.writeln(" 是否为移动终端: "+obj.browser.versions.mobile+"<br/>");
        document.writeln(" ios终端: "+obj.browser.versions.ios+"<br/>");
        document.writeln(" android终端: "+obj.browser.versions.android+"<br/>");
        document.writeln(" 是否为iPhone: "+obj.browser.versions.iPhone+"<br/>");
        document.writeln(" 是否iPad: "+obj.browser.versions.iPad+"<br/>");
        document.writeln(navigator.userAgent+"<br/>");
};

VIP.browser.versions.toString = function()
{
    return this.msie + ' '+this.firefox + ' '+this.chrome + ' '+this.opera + ' '+ this.safari;
}


//PrintBrowser(VIP);
function CheckBrowser(){
    //alert(navigator.appVersion+"<br />");
    //alert(navigator.userAgent+"<br />");
    VIPLog(navigator.userAgent)
    var s = null
    if(s = VIP.browser.versions.msie){
        if( s<9) // 9  10 允许访问
            window.location.href=VIP.Base()+"/index.php/help";//退出
    }
    if(s = VIP.browser.versions.firefox)
    {
        if(s<100)
            ;//
    }
    //alert(VIP.browser.versions)
};
CheckBrowser();
