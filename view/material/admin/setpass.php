<?php view::layout('layout')?>

<?php view::begin('content');?>
	
<div class="mdui-container-fluid">
	<div class="mdui-col-md-6 mdui-col-offset-md-3">
	  <form action="?/admin/setpass" method="post">
		  <div class="mdui-textfield mdui-textfield-floating-label">
		    <i class="mdui-icon material-icons">done</i>
		    <label class="mdui-textfield-label">密码</label>
		    <input name="password" class="mdui-textfield-input" type="password"/>
		  </div>
		  <div class="mdui-textfield mdui-textfield-floating-label">
		    <i class="mdui-icon material-icons">done_all</i>
		    <label class="mdui-textfield-label">重复密码</label>
		    <input name="password2" class="mdui-textfield-input" type="password"/>
		  </div>
		  <br>
		  <button type="submit" class="mdui-center mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme">
		  	<i class="mdui-icon material-icons">done</i>
		  	设置后台密码
		  </button>
	  </form>
	</div>
	
</div>

<?php view::end('content');?>