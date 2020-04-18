<?php view::layout('install/layout')?>

<?php view::begin('content');?>
<div id="xy">
用户须知：无论您是个人或组织、盈利与否、用途如何（包括以学习和研究为目的），均需仔细阅读本协议，包括免除oneindex开发者责任的免责条款及对您的权利限制。请您审阅并接受或不接受本服务条款。如您不同意本服务条款及/或oneindex开发者随时对其的修改，您应不使用或主动取消使用本程序。否则，您的任何对本程序的使用和修改等行为将被视为您对本服务条款全部的完全接受，包括接受oneindex开发者对服务条款随时所做的任何修改。  <br>
  <br>
在理解、同意、并遵守本协议的全部条款后，方可开始使用本软件。  <br>
  <br>
I. 前置条件  <br>
您应完全遵守中国大陆和您提供服务地区的相关法律法规，不得将使用本软件以任何形式用于任何违法用途。  <br>
  <br>
II. 协议许可的权利  <br>
  <br>
您可以在完全遵守本许可协议的基础上，将本软件应用于非商业用途。  <br>
  <br>
本软件及所附带的文件是作为不提供任何明确的或隐含的赔偿或担保的形式提供的。  <br>
   <br>
用户出于自愿而使用本软件，您必须了解使用本软件的风险，oneindex开发者不提供任何形式的技术支持、使用担保，也不承担任何因使用本软件而产生问题的相关责任。  <br>
   <br>
oneindex开发者不对使用本软件构建的网站或者网站中的展示的文件及内容信息承担责任，，oneindex开发者不承担任何直接、间接或者连带的责任，全部责任由您自行承担。<br>  
  <br>
oneindex开发者无法全面监控您下载的程序完整性，因此不保证应用程序的合法性、安全性、完整性、真实性或品质等；您同意自行判断并承担所有风险。由此对您及第三人可能造成的损失，oneindex开发者不承担任何直接、间接或者连带的责任。  <br>
  <br>
III. 代码修改和发布<br>
  <br>
基于本程序代码修改和发布的代码、软件、及构建的网站，与oneindex开发者无关，其产生的责任和后果与oneindex开发者无关，oneindex开发者不承担任何责任。<br>  
  <br>
一旦您开始安装、使用、修改oneindex，即被视为完全理解并接受本协议的各项条款，在享有上述条款授予的权利的同时，受到相关的约束和限制。 <br>
  
</div>
<script>
mdui.JQ('#xy').hide();
mdui.dialog({
  title: '使用及免责协议',
  content: mdui.JQ('#xy').html(),
  buttons: [
    {
      text: '同意'
    }
  ]
});
</script>
<div class="mdui-container-fluid">
	<div class="mdui-typo">
	  <h1>程序安装 <small>环境检测</small></h1>
	</div>

	<div class="mdui-table-fluid">
	  <table class="mdui-table">
	    <thead>
	      <tr>
	        <th>#</th>
	        <th>环境需求</th>
	        <th>当前环境</th>
	      </tr>
	    </thead>
	    <tbody>
	      <tr>
	        <td>1</td>
	        <td>PHP > 5.5</td>
	        <?php if($check['php']): ?>
	        <td><i class="mdui-icon material-icons" style="color:#4caf50;">&#xe5ca;</i></td>
	        <?php else:?>
	        <td><i class="mdui-icon material-icons" style="color:#f44336;">&#xe5cd;</i></td>
	        <?php endif;?>
	      </tr>
	      <tr>
	        <td>2</td>
	        <td>curl 支持</td>
	        <?php if($check['curl']): ?>
	        <td><i class="mdui-icon material-icons" style="color:#4caf50;">&#xe5ca;</i></td>
	        <?php else:?>
	        <td><i class="mdui-icon material-icons" style="color:#f44336;">&#xe5cd;</i></td>
	        <?php endif;?>
	      </tr>
	      <tr>
	        <td>3</td>
	        <td>config/ 目录可读可写</td>
	        <?php if($check['config']): ?>
	        <td><i class="mdui-icon material-icons" style="color:#4caf50;">&#xe5ca;</i></td>
	        <?php else:?>
	        <td><i class="mdui-icon material-icons" style="color:#f44336;">&#xe5cd;</i></td>
	        <?php endif;?>
	      </tr>
	      <tr>
	        <td>4</td>
	        <td>cache/ 目录可读可写</td>
	        <?php if($check['cache']): ?>
	        <td><i class="mdui-icon material-icons" style="color:#4caf50;">&#xe5ca;</i></td>
	        <?php else:?>
	        <td><i class="mdui-icon material-icons" style="color:#f44336;">&#xe5cd;</i></td>
	        <?php endif;?>
	      </tr>
	    </tbody>
	  </table>
	</div>
	<br><br>
	<!--<a class="mdui-btn mdui-color-theme-accent mdui-ripple mdui-float-left" href="?step=1">上一步</a>-->
	<?php if(array_sum($check) == count($check)):?>
	<a class="mdui-btn mdui-color-theme-accent mdui-ripple mdui-float-right" href="?step=1">下一步</a>
	<?php else:?>
	<button class="mdui-btn mdui-btn-raised  mdui-float-right disabled" disabled>下一步</button>
	<?php endif;?>
</div>

<?php view::end('content');?>
