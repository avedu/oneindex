<?php 
class AdminController{
	function __construct(){
		session_start();
		
		//无后台密码，先设置后密码
		//if( is_null(config('password')) ){
		//	echo $this->setpass();
		//	exit();
		//}
		
		//$password = $_SESSION['password'];
		//if($password != config('password')){
		//	view::direct('?/admin/login');
		//}
	}

	function password($password){
		return md5(md5($password.'oneindex'));
	}

	function index(){
		return "admin/index";
	}
	
	function install(){
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
		view::direct('./');
	}

	function login(){
		$password = $this->password($_POST['password']);
		if($password === config('password')){
			$_SESSION['password'] = $password;
			return view::direct('?/admin');
		}
		return view('admin/login');
	}

	function logout(){
		$_SESSION['password']= null;
		return view::direct('?/admin');
	}

	function setpass(){
		if(!empty($_POST['password']) && $_POST['password']==$_POST['password2']){
			$password = $this->password($_POST['password']);
			config('password', $password);
			$_SESSION['password'] = $password;
			return view::direct('?/admin');
		}
		return view('admin/setpass');
	}
}