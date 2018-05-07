<?php 
class IndexController{
	private $url_path;
	private $name;
	private $path;
	private $items;
	private $time;

	function __construct(){
		//获取路径和文件名
		$paths = explode('/', $_GET['path']);
		if(substr($_SERVER['REQUEST_URI'], -1) != '/'){
			$this->name = urldecode(array_pop($paths));
		}
		$this->url_path = get_absolute_path(implode('/', $paths));
		$this->path = config('onedrive_root').$this->url_path;
		//获取文件夹下所有元素
		$this->items = $this->items($this->path);
	}

	
	function index(){
		//是否404
		$this->is404();

		$this->is_password();

		header("Expires:-1");
		header("Cache-Control:no_cache");
		header("Pragma:no-cache");

		if(!empty($this->name)){//file
			return $this->file();
		}else{//dir
			return $this->dir();
		}
	}

	//判断是否加密
	function is_password(){
		if(empty($this->items['.password'])){
			return false;
		}
		
		$password = $this->get_content($this->items['.password']);
		list($password) = explode("\n",$password);
		$password = trim($password);
		unset($this->items['.password']);
		if(!empty($password) && $password == $_COOKIE[md5($this->path)]){
			return true;
		}

		$this->password($password);
		
	}

	function password($password){
		if(!empty($_POST['password']) && $password == $_POST['password']){
			setcookie(md5($this->path), $_POST['password']);
			return true;
		}
		$navs = $this->navs();
		echo view::load('password')->with('navs',$navs);
		exit();
	}

	//文件
	function file(){
		$item = $this->items[$this->name];
		if ($item['folder']) {//是文件夹
			$url = $_SERVER['REQUEST_URI'].'/';
		}elseif(!is_null($_GET['t']) && !empty($item['thumb'])){//缩略图
			$url = $this->thumbnail($item);
		}elseif($_SERVER['REQUEST_METHOD'] == 'POST' || !is_null($_GET['s']) ){
			return $this->show($item);
		}else{//返回下载链接
			$url = $item['downloadUrl'];
		}
		header('Location: '.$url);
	}


	
	//文件夹
	function dir(){
		$root = get_absolute_path(dirname($_SERVER['SCRIPT_NAME'])).config('root_path');
		$navs = $this->navs();

		if($this->items['README.md']){
			$readme = $this->get_content($this->items['README.md']);
			$Parsedown = new Parsedown();
			$readme = $Parsedown->text($readme);
			//不在列表中展示
			unset($this->items['README.md']);
		}

		if($this->items['HEAD.md']){
			$head = $this->get_content($this->items['HEAD.md']);
			$Parsedown = new Parsedown();
			$head = $Parsedown->text($head);
			//不在列表中展示
			unset($this->items['HEAD.md']);
		}
		
		return view::load('list')->with('title', 'index of '. urldecode($this->url_path))
					->with('navs', $navs)
					->with('path',$this->url_path)
					->with('root', $root)
					->with('items', $this->items)
					->with('head',$head)
					->with('readme',$readme);
	}

	function show($item){
		$root = get_absolute_path(dirname($_SERVER['SCRIPT_NAME'])).config('root_path');
		$ext = strtolower(pathinfo($item['name'], PATHINFO_EXTENSION));
		$data['title'] = $item['name'];
		$data['navs'] = $this->navs();
		$data['item'] = $item;
		$data['url'] = (isset($_SERVER['HTTPS'])?'https://':'http://').$_SERVER['HTTP_HOST'].end($data['navs']);

		if(in_array($ext,['csv','doc','docx','odp','ods','odt','pot','potm','potx','pps','ppsx','ppsxm','ppt','pptm','pptx','rtf','xls','xlsx'])){
			return view::load('show/pdf')->with($data);
		}
		
		if(in_array($ext,['bmp','jpg','jpeg','png','gif'])){
			return view::load('show/image')->with($data);
		}
		if(in_array($ext,['mp4','webm'])){
			return view::load('show/video')->with($data);
		}
		
		if(in_array($ext,['mp4','webm','avi','mpg', 'mpeg', 'rm', 'rmvb', 'mov', 'wmv', 'mkv', 'asf'])){
			return view::load('show/video2')->with($data);
		}
		
		if(in_array($ext,['ogg','mp3','wav'])){
			return view::load('show/audio')->with($data);
		}

		$code_type = $this->code_type($ext);
		if($code_type){
			$data['content'] = $this->get_content($item);
			$data['language'] = $code_type;
			
			return view::load('show/code')->with($data);
		}

		header('Location: '.$item['downloadUrl']);
	}
	//缩略图
	function thumbnail($item){
		if(!empty($_GET['t'])){
			list($width, $height) = explode('|', $_GET['t']);
		}else{
			//800 176 96
			$width = $height = 800;
		}
		return $item['thumb']."&width={$width}&height={$height}";
	}

	//文件夹下元素
	function items($path, $fetch=false){
		//是否有缓存
		list($this->time, $items) = cache('dir_'.$this->path);
		//缓存失效或文件不存在，重新抓取
		if( !is_array($items) || (TIME - $this->time) > config('cache_expire_time') || $fetch){
			$items = onedrive::dir($path);
			if(is_array($items)){
				$this->time = TIME;
				cache('dir_'.$path, $items);
			} 
		}
		return $items;
	}

	function navs(){
		$root = get_absolute_path(dirname($_SERVER['SCRIPT_NAME'])).config('root_path');
		$navs['/'] = get_absolute_path($root.'/');
		foreach(explode('/',$this->url_path) as $v){
			if(empty($v)){
				continue;
			}
			$navs[urldecode($v)] = end($navs).$v.'/';
		}
		if(!empty($this->name)){
			$navs[$this->name] = end($navs).urlencode($this->name);
		}
		
		return $navs;
	}

	function get_content($item){
		$path =  $this->path.$item['name'];
		list($time, $content) = cache('content_'.$path);
		if( is_null($content) || (TIME - $time) > config('cache_expire_time')){
			$resp = fetch::get($item['downloadUrl']);
			if($resp->http_code == 200){
				$content = $resp->content;
				cache('content_'.$path, $content);
			}
		}
		return $content;
	}

	function code_type($ext){
		$code_type['html'] = 'html';
		$code_type['htm'] = 'html';
		$code_type['php'] = 'php';
		$code_type['css'] = 'css';
		$code_type['go'] = 'golang';
		$code_type['java'] = 'java';
		$code_type['js'] = 'javascript';
		$code_type['json'] = 'json';
		$code_type['txt'] = 'Text';
		$code_type['sh'] = 'sh';
		$code_type['md'] = 'Markdown';
		
		return @$code_type[$ext];
	}

	//时候404
	function is404(){
		if(!empty($this->items[$this->name]) || (empty($this->name) && is_array($this->items)) ){
			return false;
		}

		cache('404_'.$this->path.$this->name, true);
		
		http_response_code(404);
		view::load('404')->show();
		die();
	}

	function __destruct(){
		if (!function_exists("fastcgi_finish_request")) {
			return;
		}
		//后台刷新缓存
		if((TIME - $this->time) > config('cache_refresh_time')){
			fastcgi_finish_request();
			$items = onedrive::dir($this->path);
			if(is_array($items)){
				cache('dir_'.$this->path, $items);
			}
		}
	}
}