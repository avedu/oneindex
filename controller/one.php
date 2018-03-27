<?php
	class one{
		function index(){
			if(substr($_SERVER['REQUEST_URI'],-1) != '/'){
				return $this->download($_GET['path']);
			}
			$path = str_replace('//','/', '/'.$_GET['path'].'/');
			$dir = onedrive::dir($path);
			view::load('list')->with('path',$path)->with('items', $dir['value'])->show();
		}

		function download($path){
			$item = onedrive::file($path);
			$downloadurl = $item["@content.downloadUrl"];
			if(!empty($downloadurl)){
				header('Location: '.$downloadurl);
			}
		}
	}
