<?php 
class AdminController{
	static $default_config = array(
	  'cache_expire_time' => 3600,
	  'cache_refresh_time' => 600,
	  'root_path' => '?'
	);
	
	function __construct(){
		session_start();
	}

	function password($password){
		return md5(md5($password.'oneindex'));
	}

	function index(){
		return "admin/index";
	}
	
	function install(){
		if(!empty($_GET['code'])){
			return $this->install_3();
		}
		switch ( intval($_GET['step']) ){
			case 1:
				return $this->install_1();
			case 2:
				return $this->install_2();	
			default:
				return $this->install_0();
		}
	}

	function install_0(){
		$check['php'] = version_compare(PHP_VERSION,'5.6.0','ge');
		$check['curl'] = function_exists('curl_init');
		$check['config'] = is_writable(ROOT.'config/');
		$check['cache'] = is_writable(ROOT.'cache/');

		return view::load('install/install_0')->with('title','系统安装')
						->with('check', $check);
	}

	function install_1(){
		if(!empty($_POST['client_secret']) && !empty($_POST['client_id']) && !empty($_POST['redirect_uri']) ){
			config('client_secret',$_POST['client_secret']);
			config('client_id',$_POST['client_id']);
			config('redirect_uri',$_POST['redirect_uri']);
			config('onedrive_root', '');
			config('root_path', '?');
			config('cache_expire_time', 3600);
			return view::direct('?step=2');
		}
		$https = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'));
		if($https || $_SERVER['HTTP_HOST'] == 'localhost'){
			$redirect_uri = 'https://'.$_SERVER['HTTP_HOST'].get_absolute_path(dirname($_SERVER['PHP_SELF']));
		}else{
			// 非https,调用ju.tn中转
			$redirect_uri = 'https://ju.tn/';
		}
		
		$ru = "https://developer.microsoft.com/en-us/graph/quick-start?appID=_appId_&appName=_appName_&redirectUrl={$redirect_uri}&platform=option-php";
		$deepLink = "/quickstart/graphIO?publicClientSupport=false&appName=oneindex&redirectUrl={$redirect_uri}&allowImplicitFlow=false&ru=".urlencode($ru);
		$app_url = "https://apps.dev.microsoft.com/?deepLink=".urlencode($deepLink);
		return view::load('install/install_1')->with('title','系统安装')
						->with('redirect_uri', $redirect_uri)
						->with('app_url', $app_url);
	}

	function install_2(){
		return view::load('install/install_2')->with('title','系统安装');
	}

	function install_3(){
		$data = onedrive::authorize($_GET['code']);
		if(!empty($data['refresh_token'])){
			config('refresh_token',$data['refresh_token']);
			config('@token', $data);
		}
		return view::load('install/install_3')->with('refresh_token',$data['refresh_token']);
		
	}
}
