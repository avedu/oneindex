<?php 
if( php_sapi_name() !== "cli" ){
   die( "NoAccess" );
}
require 'init.php';

switch ( $argv[1] ){
	case 'cache:clear':
		$dir=opendir(CACHE_PATH);
		while ($file=readdir($dir)) {
			@unlink(CACHE_PATH.$file);
		}
		break;
	case 'cache:refresh':
		function refresh_cache($path){
			echo $path.PHP_EOL;
		    $items = onedrive::dir($path);
		    if(is_array($items)){
				cache('dir_'.$path, $items);
			}
		    foreach((array)$items as $item){
		        if($item['folder']){
		            refresh_cache($path.urlencode($item['name']).'/');
		        }
		    }
		}
		refresh_cache(get_absolute_path(config('onedrive_root')));
	break;	
	case 'token:refresh':
		$refresh_token = config('refresh_token');
		$token = onedrive::get_token($refresh_token);
		if(!empty($token['refresh_token'])){
			config('@token', $token);
		}
	break;		
	default:
	?>
oneindex commands :
 cache
  cache:clear    clear cache
  cache:refresh  refresh cache
 token
  token:refresh  refresh token
	<?php
		break;
}
?>
