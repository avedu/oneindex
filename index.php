<?php

require 'init.php';

//世纪互联
//onedrive::$api_url = "https://microsoftgraph.chinacloudapi.cn/v1.0";
//onedrive::$oauth_url = "https://login.partner.microsoftonline.cn/common/oauth2/v2.0";


/**
 *    程序安装
 */
if( empty( config('refresh_token') ) ){
	route::any('/','AdminController@install');
}

/**
 *    系统后台
 */
route::group(function(){
	return ($_COOKIE['admin'] == md5(config('password').config('refresh_token')) );
},function(){
	route::get('/logout','AdminController@logout');
	route::any('/admin/','AdminController@settings');
	route::any('/admin/cache','AdminController@cache');
	
	route::any('/admin/setpass','AdminController@setpass');
});
//登陆
route::any('/login','AdminController@login');
//跳转到登陆
route::any('/admin/',function(){
	return view::direct(get_absolute_path(dirname($_SERVER['SCRIPT_NAME'])).'?/login');
});

/**
 *    列目录
 */
define('VIEW_PATH', ROOT.'view/material/');
route::any('{path:#all}','IndexController@index');
