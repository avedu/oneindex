<?php
require 'init.php';

onedrive::$app_url = config('app_url');
onedrive::$dir_cache_time = config('dir_cache_time');
onedrive::$file_cache_time = config('file_cache_time');

if( empty(onedrive::$app_url) ){
	route::any('/install',function(){
			$authorize_url = onedrive::authorize_url();
			if (empty($_REQUEST['code'])) {
				return view::load('auth')->with('authorize_url',$authorize_url);
			}
			$data = onedrive::authorize($_REQUEST['code']);
			if(empty($data['access_token'])){
				return view::load('auth')->with('authorize_url',$authorize_url)
							->with('error','认证失败');
			}
			$app_url = onedrive::get_app_url($data['access_token']);
			if(empty($app_url)){
				return view::load('auth')->with('authorize_url',$authorize_url)
							->with('error','获取app url 失败');
			}
			config('refresh_token', $data['refresh_token']);
			config('app_url', $app_url);
			config('root_path', '?');
			config('dir_cache_time', 600);
			config('file_cache_time', 86400);
			view::direct('/');
	});
	if((route::$runed) == false){
		view::direct('?/install');
	}
}

route::get('{path:#all}',function(){
	if(substr($_SERVER['REQUEST_URI'],-1) != '/'){
		$item = onedrive::file($_GET['path']);
		$downloadurl = $item["@content.downloadUrl"];
		if(!empty($downloadurl)){
			header('Location: '.$downloadurl);
		}
		return;
	}
	$path = str_replace('//','/', '/'.$_GET['path'].'/');
	$dir = onedrive::dir($path);
	view::load('list')->with('path',$path)->with('items', $dir['value'])->show();
});