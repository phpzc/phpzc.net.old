/**
 * Back Top Plugin 
 * 回到顶部
 *
 * @author zhangcheng <lampzhangcheng@gmail.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright Copyright (c) 2013, ZhangCheng 2013 六月 09
 **/
$(function() {
    $.fn.scrollToTop = function(option) {
        option = $.extend({speed:"slow"},option)
        $(this).hide();
        if ($(window).scrollTop() != "0") {
            $(this).fadeIn("slow");
        };
        var scrollDiv = $(this);
        $(window).scroll(function() {
            if ($(window).scrollTop() == "0") {
                $(scrollDiv).fadeOut("slow");
            } else {
                $(scrollDiv).fadeIn("slow");
            }
        });
        $(this).click(function() {
            $("html, body").animate({
                scrollTop: 0
            },option.speed );
        });
    }
});
