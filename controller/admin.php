<?php
	class admin{
		function install_set(){
			if ($_SERVER['REQUEST_METHOD'] == 'GET') {
				return view::load('install_set')->with('client_id',config('client_id'))
								->with('client_secret',config('client_secret'))
								->with('redirect_uri',config('redirect_uri'));
			}
			if(empty($_POST['client_id']) || empty($_POST['client_secret']) || empty($_POST['redirect_uri'])){
				return view::load('install_set')->with('error','参数不能为空')
								->with('client_id',config('client_id'))
								->with('client_secret',config('client_secret'))
								->with('redirect_uri',config('redirect_uri'));
			}
			config('client_id',$_POST['client_id']);
			config('client_secret',$_POST['client_secret']);
			config('redirect_uri',$_POST['redirect_uri']);
			view::direct('?/install/auth');
		}

		function install_auth(){
			$authorize_url = onedrive::authorize_url();
			if ($_SERVER['REQUEST_METHOD'] == 'GET') {
				return view::load('install_auth')->with('authorize_url',$authorize_url);
			}

			if(empty($_POST['code'])){
				return view::load('install_auth')->with('authorize_url',$authorize_url)
							->with('error','参数不能为空');
			}

			list($tmp, $code) = explode("code=",$_POST['code']);
			$code = empty($code)?$tmp:$code;
			$data = onedrive::authorize($code);
			if(empty($data['access_token'])){
				return view::load('install_auth')->with('authorize_url',$authorize_url)
							->with('error','认证失败');
			}
			
			$app_url = onedrive::get_app_url($data['access_token']);
			if(empty($app_url)){
				return view::load('install_auth')->with('authorize_url',$authorize_url)
							->with('error','获取app url 失败');
			}
			
			config('refresh_token', $data['refresh_token']);
			config('app_url', $app_url);

			view::direct('/');
		}
	}
