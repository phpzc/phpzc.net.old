<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\CommonController as AhcCommonController;

class CommonController extends AhcCommonController
{

    public function __construct()
    {

    }


    protected function dump($str)
    {
        echo "<pre>";

        var_dump($str);
        echo "</pre>";
    }
}