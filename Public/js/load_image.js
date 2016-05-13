/**
 * Created by zc on 2016/5/12.
 */
function p__load_img(url,obj,callback) {
    var img = new Image();
    img.onload =function () {
        img.onload = null;
        callback(img,obj);
    }
    img.src = url;
}

function load_image(objArray,callback) {
    for(var i=0;i<objArray.length;i++)
    {
        p__load_img(objArray[i].data('src'),objArray[i],callback);
    }
}

