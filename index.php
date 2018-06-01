<?php

require 'init.php';

!defined('SITE_NAME') && define('SITE_NAME', 'one');

//未初始化
if( empty(onedrive::$app_url) ){
	route::any('/','AdminController@install');
}

//列目录
route::any('{path:#all}','IndexController@index');
