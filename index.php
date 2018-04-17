<?php

require 'init.php';


//route::get('/admin','AdminController@index');
//route::any('/admin/login','AdminController@login');
//route::any('/admin/logout','AdminController@logout');
//route::any('/admin/setpass','AdminController@setpass');

//未初始化
if( empty(onedrive::$app_url) ){
	route::any('/','AdminController@install');
}

//列目录
route::any('{path:#all}','IndexController@index');
