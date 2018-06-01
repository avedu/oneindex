<?php 

class ImagesController{
	function index(){
		if($this->is_image($_FILES["file"]) ){
			$content = file_get_contents( $_FILES["file"]['tmp_name']);
			$remotepath =  '/images/'.date('Y/m/d/');
			$remotefile = $remotepath.$_FILES["file"]['name'];
			$result = onedrive::upload($remotefile, $content);
			
			if($result){
				$cachefile = CACHE_PATH . md5('dir_/'.$remotepath) . '.php';
				unlink($cachefile);
				$root = get_absolute_path(dirname($_SERVER['SCRIPT_NAME'])).config('root_path');
				$url = (strpos($root,'?') == false)?$root.$remotefile.'?s':$root.$remotefile.'&s';
				view::direct($url);
			}
		}
		return view::load('images/index');
	}

	function is_image($file){
		$config = config('images@base');
		$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
		if(!in_array($ext,$config['exts'])){
			return false;
		}
		if($file['size'] > 10485760 || $file['size'] == 0){
			return false;
		}

		return true;
	}
}
