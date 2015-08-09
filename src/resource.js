var res = {
    HelloWorld_png : "res/HelloWorld.png",
    CloseNormal_png : "res/CloseNormal.png",
    CloseSelected_png : "res/CloseSelected.png"
};
var _tmpI = 1;
for(_tmpI = 1; _tmpI<=9;_tmpI++) {
       var sub=0;
       if(_tmpI < 10){
            sub='0'+_tmpI;
        }else{
            sub = _tmpI;
        }
        var str = 'mv_'+sub+'_jpg';
        res.str = 'res/img/mv_'+sub+'.jpg';

}
var g_resources = [];
for (var i in res) {
    g_resources.push(res[i]);
}