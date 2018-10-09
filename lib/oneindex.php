<?php
	class oneindex{

		//使用 $refresh_token，获取 $access_token
		static function get_token($refresh_token){
			
		}

		static function refresh_cache($path){
			set_time_limit(0);
			if( php_sapi_name() == "cli" ){
			   echo $path.PHP_EOL;
			}
			$items = onedrive::dir($path);
			if(is_array($items)){
				cache::set('dir_'.$path, $items, config('cache_expire_time') );
			}
			foreach((array)$items as $item){
			    if($item['folder']){
			        self::refresh_cache($path.$item['name'].'/');
			    }
			}
		}
		
	}
