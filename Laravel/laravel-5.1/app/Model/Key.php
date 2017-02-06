<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Key extends Model
{
    //
    protected $table = 'key';
    //维护 created_at updated_at
    public $timestamps = false;

    //软删除
    //use SoftDeletes;

    public static function generatePassword($min = 6,$max = 16)
    {

        static $validchars = "abcdefghijklmnopqrstuvwxyz123456789_!@#$%*";
        $max_char = strlen($validchars) - 1;
        $length = mt_rand($min, $max);
        $middle = ($max + $min)/2;
        if($length < $middle){
            $length = $middle;
        }
        $password = "";
        for ($i = 0; $i < $length; $i++) {
            $password .= $validchars[ mt_rand(0, $max_char) ];
        }

        return $password;
    }

}
