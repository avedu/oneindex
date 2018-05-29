<?php view::layout('layout')?>
<?php 
function file_ico($item){
  $ext = strtolower(pathinfo($item['name'], PATHINFO_EXTENSION));
  if(in_array($ext,['bmp','jpg','jpeg','png','gif'])){
  	return "image";
  }
  if(in_array($ext,['mp4','mkv','webm','avi','mpg', 'mpeg', 'rm', 'rmvb', 'mov', 'wmv', 'mkv', 'asf'])){
  	return "ondemand_video";
  }
  if(in_array($ext,['ogg','mp3','wav'])){
  	return "audiotrack";
  }
  return "insert_drive_file";
}
?>

<?php view::begin('content');?>
	
<div class="mdui-container-fluid">

<?php if($head):?>
<div class="mdui-typo" style="padding: 20px;">
	<?php e($head);?>
</div>
<?php endif;?>

	
<div class="mdui-row">
	<ul class="mdui-list">
		<li class="mdui-list-item th">
		  <div class="mdui-col-xs-12 mdui-col-sm-7">文件</div>
		  <div class="mdui-col-sm-3 mdui-text-right">修改时间</div>
		  <div class="mdui-col-sm-2 mdui-text-right">大小</div>
		</li>
		<?php if($path != '/'):?>
		<li class="mdui-list-item mdui-ripple">
			<a href="<?php echo get_absolute_path($root.$path.'../');?>">
			  <div class="mdui-col-xs-12 mdui-col-sm-7">
				<i class="mdui-icon material-icons">arrow_upward</i>
		    	..
			  </div>
			  <div class="mdui-col-sm-3 mdui-text-right"></div>
			  <div class="mdui-col-sm-2 mdui-text-right"></div>
		  	</a>
		</li>
		<?php endif;?>
		
		<?php foreach((array)$items as $item):?>
			<?php if(!empty($item['folder'])):?>

		<li class="mdui-list-item mdui-ripple">
			<a href="<?php echo get_absolute_path($root.$path.$item['name']);?>">
			  <div class="mdui-col-xs-12 mdui-col-sm-7 mdui-text-truncate">
				<i class="mdui-icon material-icons">folder_open</i>
		    	<?php e($item['name']);?>
			  </div>
			  <div class="mdui-col-sm-3 mdui-text-right"><?php echo date("Y-m-d H:i:s", $item['lastModifiedDateTime']);?></div>
			  <div class="mdui-col-sm-2 mdui-text-right"><?php echo $item['size'];?></div>
		  	</a>
		</li>
			<?php else:?>
		<li class="mdui-list-item file mdui-ripple">
			<a href="<?php echo get_absolute_path($root.$path).urlencode($item['name']);?>" target="_blank">
			  <div class="mdui-col-xs-12 mdui-col-sm-7 mdui-text-truncate">
				<i class="mdui-icon material-icons"><?php echo file_ico($item);?></i>
		    	<?php e($item['name']);?>
			  </div>
			  <div class="mdui-col-sm-3 mdui-text-right"><?php echo date("Y-m-d H:i:s", $item['lastModifiedDateTime']);?></div>
			  <div class="mdui-col-sm-2 mdui-text-right"><?php echo $item['size'];?></div>
		  	</a>
		</li>
			<?php endif;?>
		<?php endforeach;?>
	</ul>
</div>
<?php if($readme):?>
<div class="mdui-typo mdui-shadow-3" style="padding: 20px;margin: 20px; 0">
	<div class="mdui-chip">
	  <span class="mdui-chip-icon"><i class="mdui-icon material-icons">face</i></span>
	  <span class="mdui-chip-title">README.md</span>
	</div>
	<?php e($readme);?>
</div>
<?php endif;?>
</div>
<script>
$ = mdui.JQ;
$(function(){
	$('.file a').each(function(){
		$(this).on('click', function () {
			var form = $('<form target=_blank method=post></form>').attr('action', $(this).attr('href')).get(0);
			$(document.body).append(form);
			form.submit();
			$(form).remove();
			return false;
		});
	});
});
</script>
<?php view::end('content');?>