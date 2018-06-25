<?php view::layout('layout')?>

<?php view::begin('content');?>
<div class="mdui-container-fluid">

	<div class="mdui-typo">
	  <h1> 基本设置 <small>设置OneIndex基本参数</small></h1>
	</div>
	<form action="" method="post">
		<div class="mdui-textfield">
		  <h4>网站名称</h4>
		  <input class="mdui-textfield-input" type="text" name="site_name" value="<?php echo $config['site_name'];?>"/>
		</div>

		<div class="mdui-textfield">
		  <h4>网站风格<small></small></h4>
		  <select name="style" class="mdui-select">
			  <?php 
				foreach(scandir(ROOT.'view') as $k=>$s){
				    $styles[$k] = trim($s, '/');
				}
				$styles = array_diff($styles, [".", "..", "admin"]);
				$style = config("style")?config("style"):'material';
			 	foreach($styles as $style_name):
			  ?>
			  <option value ="<?php echo $style_name;?>" <?php echo ($style==$style_name)?'selected':'';?>><?php echo $style_name;?></option>
			  <?php endforeach;?>
		  </select>
		</div>

		<div class="mdui-textfield">
		  <h4>onedrive起始目录(空为根目录)<small>例：仅共享share目录 /share</small></h4>
		  <input class="mdui-textfield-input" type="text" name="onedrive_root" value="<?php echo $config['onedrive_root'];?>"/>
		</div>

		<div class="mdui-textfield">
		  <h4>缓存过期时间(秒)</h4>
		  <input class="mdui-textfield-input" type="text" name="cache_expire_time" value="<?php echo $config['cache_expire_time'];?>"/>
		</div>

		<div class="mdui-textfield">
		  <h4>去掉<code style="color: #c7254e;background-color: #f7f7f9;font-size:16px;">/?/</code> (需配合伪静态使用!!)</h4>
		  <label class="mdui-textfield-label"></label>
		  <label class="mdui-switch">
			  <input type="checkbox" name="root_path" value="?" <?php echo empty($config['root_path'])?'checked':'';?>/>
			  <i class="mdui-switch-icon"></i>
		  </label>
		</div>
		

		

	   <button type="submit" class="mdui-btn mdui-color-theme-accent mdui-ripple mdui-float-right">
	   	<i class="mdui-icon material-icons">&#xe161;</i> 保存
	   </button>
	</form>
</div>
<?php view::end('content');?>