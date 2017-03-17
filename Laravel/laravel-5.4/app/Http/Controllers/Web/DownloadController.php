<?php
namespace App\Http\Controllers\Web;

use App\Model\Document;

class DownloadController extends CommonController
{

    public final function index()
    {
        $url = request()->input('url');

        if(empty($url)){
            redirect('/');
        }

        $type = strtolower( request()->input('type')) ;
        $id = request()->input('id');

        switch($type){
            case 'document':
                $this->document($url,$id);
                break;
            default:
                redirect('/');
                break;
        }
    }

    private function document($url,$id){

        Document::where(array('id'=>$id))->increment('visit');

        header('location:'.$url);
        exit;
    }

}