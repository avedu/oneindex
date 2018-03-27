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
					  <h4>1、点击链接：<a href="<?php echo $authorize_url;?>" target="_blank">绑定账户</a></h4>
					</div>
					<div>
					  <h4>2、将<code>code</code>填入下面输入框</h4>
					</div>
					<div>
						<?php if(!empty($error)):?>
						<div class="alert alert-danger" role="alert"><?php echo $error;?></div>
						<?php endif;?>
						<form method="post">
					      <div class="form-group">
					        <label >code</label>
					        <textarea class="form-control" rows="5" name="code"></textarea>
					      </div>
					      <div class="form-group">
					     	 <input type="submit" class="btn btn-primary pull-right" value="下一步"></input>
					     	 <a  class="btn btn-default" href="?/install">上一步</a>
					      </div>
					    </form>
				    </div>
				</div>
			</div>
		</div>
	</body>
</html>