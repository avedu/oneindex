<?php

require 'init.php';

!defined('SITE_NAME') && define('SITE_NAME', 'one');

//世纪互联
//onedrive::$api_url = "https://microsoftgraph.chinacloudapi.cn/v1.0";
//onedrive::$oauth_url = "https://login.partner.microsoftonline.cn/common/oauth2/v2.0";


//未初始化
if( empty( config('refresh_token') ) ){
	route::any('/','AdminController@install');
}

//后台
route::group(function(){
	return ($_COOKIE['admin'] == md5(md5(config('password')).'oneindex'));
},function(){
	route::get('/logout','AdminController@logout');
	
	route::any('/admin/','AdminController@index');
	route::any('/admin/setpass','AdminController@setpass');
});
//登录后台
route::any('/login','AdminController@login');
route::any('/admin/',function(){
	return view::direct('?/login');
});

//列目录
define('VIEW_PATH', ROOT.'view/material/');
route::any('{path:#all}','IndexController@index');
