<?php view::layout('layout')?>

<?php view::begin('content');?>
<div class="mdui-container-fluid">

	<div class="mdui-typo">
	  <h1> 页面缓存 <small>清除所有页面缓存</small></h1>
	</div>
	<br>
	<br>
	<br>
	<div class="mdui-row-xs-3">
	  <div class="mdui-col">
	  </div>
	  <div class="mdui-col">
		
		<form action="" method="post">
		    <button type="submit" class="mdui-btn mdui-btn-block mdui-color-theme-accent mdui-ripple">
      			<i class="mdui-icon material-icons">&#xe028;</i>
				清除所有缓存
		    </button>
	    </form>
	    <br>
	    <center class="mdui-typo-headline-opacity"><?php echo $message;?></center>
	  </div>
	</div>
</div>
<?php view::end('content');?>