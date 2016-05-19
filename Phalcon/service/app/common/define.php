<?php
if(is_ssl()){
    define("NET_NAME","https://" . $_SERVER ["HTTP_HOST"] );
}else{
    define("NET_NAME","http://" . $_SERVER ["HTTP_HOST"] );
}


include __DIR__.'/ApiUrl.php';
include __DIR__.'/ApiCode.php';
include __DIR__.'/ApiAuth.php';
include __DIR__.'/ApiClient.php';


?>