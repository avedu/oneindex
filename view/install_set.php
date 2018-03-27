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
					  <h2>初始化<small>基本参数设置</small></h2>
					</div>
					<div>
						<?php if(!@is_writable(ROOT.'config/') OR !@is_writable(ROOT.'cache/')):?>
							<div class="alert alert-danger" role="alert">请设置目录<code>config/</code>和<code>cache/</code>可读写</div>
						<?php endif;?>
						<?php if(!empty($error)):?>
							<div class="alert alert-danger" role="alert"><?php echo $error;?></div>
						<?php endif;?>
						<form method="post">
					      <div class="form-group">
					        <label >应用程序 ID</label>
					        <input type="text" class="form-control" name="client_id" placeholder="client id" value="<?php echo $client_id;?>"/>
					      </div>
					      <div class="form-group">
					        <label >密钥值</label>
					        <input type="text" class="form-control" name="client_secret" placeholder="client secret"  value="<?php echo $client_secret;?>"/>
					      </div>
					      <div class="form-group">
					        <label >回调链接</label>
					        <input type="text" class="form-control" name="redirect_uri" placeholder="redirect uri"  value="<?php echo $redirect_uri;?>"/>
					      </div>
					      <div class="form-group">
					     	 <input type="submit" class="btn btn-primary pull-right" value="下一步"></input>
					      </div>
					    </form>
				    </div>
				    <br><br>
					<div class="page-header">
					  <h3>如何获取<small><code>Client ID</code>、<code>Client secret</code>和<code>redirect uri</code></small></h3>
					</div>
				    <p>

				    <div>
					  <h4>1、登录：<a href="https://manage.windowsazure.com/" target="_blank">Microsoft Azure Management Portal</a></h4>
					</div>
					<div>
					  <h4>2、按照教程获取：<a href="https://moeclub.org/2017/07/07/304/" target="_blank">moeclub</a></h4>
					</div>


				</div>
			</div>
		</div>
	</body>
</html>