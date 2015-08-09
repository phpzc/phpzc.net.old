var _num = 1;

var HelloWorldLayer = cc.Layer.extend({
    sprite:null,
    ctor:function () {
        //////////////////////////////
        // 1. super init first
        this._super();

        /////////////////////////////
        // 2. add a menu item with "X" image, which is clicked to quit the program
        //    you may modify it.
        // ask the window size
        var size = cc.winSize;

//        // add a "close" icon to exit the progress. it's an autorelease object
//        var closeItem = new cc.MenuItemImage(
//            res.CloseNormal_png,
//            res.CloseSelected_png,
//            function () {
//                cc.log("Menu is clicked!");
//            }, this);
//        closeItem.attr({
//            x: size.width - 20,
//            y: 20,
//            anchorX: 0.5,
//            anchorY: 0.5
//        });
//
//        var menu = new cc.Menu(closeItem);
//        menu.x = 0;
//        menu.y = 0;
//        this.addChild(menu, 1);
//
//        /////////////////////////////
//        // 3. add your codes below...
//        // add a label shows "Hello World"
//        // create and initialize a label
//        var helloLabel = new cc.LabelTTF("Hello World", "Arial", 38);
//        // position the label on the center of the screen
//        helloLabel.x = size.width / 2;
//        helloLabel.y = 0;
//        // add the label as a child to this layer
//        this.addChild(helloLabel, 5);

        // add "HelloWorld" splash screen"
        var sub=0;
        if(_num < 10){
            sub='0'+_num;
        }else{
            sub = _num;
        }
        this.sprite = new cc.Sprite('res/img/mv_'+sub+'.jpg');
        var h = this.sprite.getContentSize().height;
        this.sprite.attr({
            x: size.width / 2,
            y: size.height / 2,
            scaleY: h*1.0 / size.height,
        });
        this.addChild(this.sprite, 0);

//        this.sprite.runAction(
//            cc.sequence(
//                cc.rotateTo(2, 0),
//                cc.scaleTo(2, 1, 1)
//            )
//        );
//        helloLabel.runAction(
//            cc.spawn(
//                cc.moveBy(2.5, cc.p(0, size.height - 40)),
//                cc.tintTo(2.5,255,125,0)
//            )
//        );
        return true;
    }
});



function getTransAction(num){
        var nextScene = cc.Scene.extend({
            onEnter:function () {
                this._super();
                var layer = new HelloWorldLayer();
                this.addChild(layer);
                var action = new cc.DelayTime(2);
                var callfunc = new cc.CallFunc(function(){
                _num++;
                _num %= 9;
                _num += 1;
                goToNext(_num);

                })
                var sce = new cc.Sequence(action,callfunc);
                this.runAction( sce)
            }
        });
    var sce = new nextScene()
    var ac;

    switch(num){
    case 1:
        ac = new cc.TransitionCrossFade(1, sce)
        break;
    case 2:
        ac = new cc.TransitionRotoZoom(1, sce)
        break;
    case 3:
        ac = new cc.TransitionMoveInR(1, sce)
        break;
    case 4:
        ac = new cc.TransitionProgressRadialCW(1, sce)
        break;
    default:
        ac = new cc.TransitionProgressInOut(1, sce)
        break;
    }

    return ac

}

function goToNext(num){


    cc.director.runScene(getTransAction(num));
}

var HelloWorldScene = cc.Scene.extend({
    onEnter:function () {
        this._super();
        var layer = new HelloWorldLayer();
        this.addChild(layer);
        var action = new cc.DelayTime(10);
        var callfunc = new cc.CallFunc(function(){
            _num++;
            _num %= 9;
            _num += 1;
            goToNext(_num);

        })
        var sce = new cc.Sequence(action,callfunc);
        this.runAction( sce)
    }
});

