<?php
namespace App\Http\Controllers\Web;

use App\Model\Album;
use App\Model\Photo;
use Intervention\Image\ImageManagerStatic as Image;


class AlbumController extends CommonController
{

    public function _initialize() {
        parent::_initialize ();
        $action_name = strtolower ( getCurrentMethod() );
        switch ($action_name) {
            case 'index' :
                $this->assign ( "website_title", "相册" );
                break;
        }
    }


    public final function index()
    {
//
        $res = Album::where(['isdel'=>0,'auth'=>0])
            ->select('id','title','num','face')
            ->orderBy('id','desc')
            ->limit(100)
            ->get();
        $res = $res->toArray();

        foreach ( $res as $k => $v ) {
            $res[$k]['title'] = strip_tags ( htmlspecialchars_decode ( $v ['title'] ) );
            $res[$k]['id'] = $this->encodeId ( $v ['id'] );
            $res[$k]['realid'] = $v['id'];
        }

        $this->assign ( 'album_list', $res );

        return view('album.index');
    }

    //查询相册信息 及相关照片信息
    public final function detail() {
        $id = request()->input('id');

        if (empty ( $id )) {
            abort(404);
        }


        $res = Photo::where(['uid'=>$id /*alblum对应id*/,'isdel'=>0])
            ->get()->toArray();

        $res2 = Album::where(['id'=>$id])->first();
        if(empty($res2))
        {
            abort(404);
        }
        $res2 = $res2->toArray();

        $this->assign('album',$res2);
        if($res2['uid'] == $this->getId())
        {
            $this->assign('my',1);
        }
        if (!empty($res)) {
            $this->assign ( 'photo', $res );
        }

        $this->assign ( 'website_title', "相册详情" );

        return view('album.detail');
    }


    public final function create_album()
    {
        if(request()->isMethod('get')){
            return view('album.create_album');
        }else{
            $data ["title"] = htmlspecialchars ( request()->input("title") );
            if ($this->jsonLengthCheck( $data ["title"], 30 )){
                $this->formErrorReferer("相册名称长度不正确");
            }
            $data ["content"] = htmlspecialchars ( request()->input("content") );
            if ($this->jsonLengthCheck( $data ["content"], 200 )){
                $this->formErrorReferer("相册描述长度不正确",1);
            }
            $data ["auth"] = (int) ( request()->input("auth") );

            $data ["time"] = time ();
            $data ["uid"] = session('id');

            $data ['year'] = date ( 'Y', $data ['time'] );
            $data ['month'] = date ( 'm', $data ['time'] );
            $data ['ip'] = ip2long ( $_SERVER ["REMOTE_ADDR"] );

            $res = Album::insertGetId($data);
            if ($res) {
                $this->formSuccess('添加成功');
            } else {
                $this->formErrorReferer("数据库添加失败",1);
            }
        }

    }

    public final function create_page()
    {
        $this->formLoginCheck();
        if(request()->isMethod('get')){
            $album = M ( 'Album' );
            $res = Album::where ( array (
                "isdel" => 0,"uid"=>session('id')
            ) )->get();

            $res = $res->toArray();


            foreach ( $res as $k => $v ) {
                $res[$k]["title"] = strip_tags ( htmlspecialchars_decode ( $v ['title'] ) );
                $res[$k]["id"] = $v ['id'];
            }

            $this->assign ( "album_list", $res );

            return view('album.create_page');

        }else{
            $data = $_POST;
            $data['images'] = $data['mortgaged-img-url'];

            $newdata=[];
            $time = time();
            $y=date ( 'Y', $time );
            $m=date ( 'm', $time );
            $ip =ip2long ( $_SERVER ["REMOTE_ADDR"] );
            foreach ($data['images'] as $k=>$v){
                $newdata[$k]['imgurl'] = NET_NAME.$v;
                $newdata[$k]['uid'] = $data['uid'];
                $newdata[$k]["time"] = $time;
                $newdata[$k]['year'] = $y;
                $newdata[$k]['month'] = $m;
                $newdata[$k]['ip'] = $ip;
                $subNameArr = explode('.',$v);
                $subName = $subNameArr[0].'_100x100.'.$subNameArr[1];
                $newdata[$k]['thumb_url'] = Image::make('.'.$v)->resize(100, 100)->save('.'.$subName);

            }

            $res = Photo::insert($newdata);

            if($res){
                $this->actionReturn(1,'上传成功','/album/index');
            }else{
                $this->actionReturn(0,'上传失败');
            }
        }

    }
}