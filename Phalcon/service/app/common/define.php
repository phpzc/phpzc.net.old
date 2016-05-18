<?php
if(is_ssl()){
    define("NET_NAME","https://" . $_SERVER ["HTTP_HOST"] );
}else{
    define("NET_NAME","http://" . $_SERVER ["HTTP_HOST"] );
}