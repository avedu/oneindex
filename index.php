<?php
require 'init.php';
define('CONTROLLER_PATH', ROOT . 'controller/');

onedrive::$client_id = config('client_id');
onedrive::$client_secret = config('client_secret');
onedrive::$redirect_uri = config('redirect_uri');
onedrive::$app_url = config('app_url');



if( empty(onedrive::$app_url) ){
	route::any('/install','admin@install_set');
	route::any('/install/auth','admin@install_auth');
	if((route::$runed) == false){
		view::direct('?/install');
	}
}

//route::get('/downloads/','one@index');
route::get('{path:#all}','one@index');