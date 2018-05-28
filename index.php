<?php

require 'init.php';

!defined('SITE_NAME') && define('SITE_NAME', 'one');

//世纪互联
//onedrive::$api_url = "https://microsoftgraph.chinacloudapi.cn/v1.0";
//onedrive::$oauth_url = "https://login.partner.microsoftonline.cn/common/oauth2/v2.0";


//未初始化
if( empty( config('refresh_token') ) ){
	define('VIEW_PATH', ROOT.'view/admin/');
	route::any('/','AdminController@install');
}

define('VIEW_PATH', ROOT.'view/material/');
//列目录
route::any('{path:#all}','IndexController@index');
