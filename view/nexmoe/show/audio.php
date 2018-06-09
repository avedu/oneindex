<?php view::layout('layout')?>

<?php view::begin('content');?>
<div class="mdui-container-fluid">
    <div class="nexmoe-item">
	
	<audio class="mdui-center" src="<?php e($item['downloadUrl']);?>" controls autoplay style="width: 100%;"  poster="<?php @e($item['thumb'].'&width=176&height=176');?>">
	</audio>
	
	<br>
	<!-- 固定标签 -->
	<div class="mdui-textfield">
	  <label class="mdui-textfield-label">下载地址</label>
	  <input class="mdui-textfield-input" type="text" value="<?php e($url);?>"/>
	</div>
	<div class="mdui-textfield">
	  <label class="mdui-textfield-label">引用地址</label>
	  <textarea class="mdui-textfield-input"><audio src="<?php e($url);?>"></audio></textarea>
	</div>
	</div>
</div>
<a href="<?php e($url);?>" class="mdui-fab mdui-fab-fixed mdui-ripple mdui-color-theme-accent"><i class="mdui-icon material-icons">file_download</i></a>
<?php view::end('content');?>