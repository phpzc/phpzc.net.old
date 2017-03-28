<?php

$host = $_SERVER['HTTP_HOST'];

if( strpos($host,'admin') === 0){

    require './Laravel/laravel-5.1/public/index.php';

    exit;
}