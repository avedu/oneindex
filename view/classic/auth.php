<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8" />
		<title>
		</title>
		<link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">

					<div class="page-header">
					  <h2>初始化<small>账户验证</small></h2>
					</div>
					<div>
					<?php if(!@is_writable(ROOT.'config/') OR !@is_writable(ROOT.'cache/')):?>
						<div class="alert alert-danger" role="alert">请设置目录<code>config/</code>和<code>cache/</code>可读写</div>
					<?php endif;?>
					  <h4>环境需要：PHP: > <code>5.6+</code> 并且 开启 <code>curl</code> 支持</h4>
					  <h4>点击链接：<a href="<?php echo $authorize_url;?>">绑定账户</a></h4>
					</div>
					<?php if(!empty($error)):?>
						<div class="alert alert-danger" role="alert"><?php echo $error;?></div>
					<?php endif;?>
				</div>
			</div>
		</div>
	</body>
</html>