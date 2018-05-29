<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no"/>
	<title><?php e($title.' - '.SITE_NAME);?></title>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/mdui/0.4.1/css/mdui.min.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/mdui/0.4.1/js/mdui.min.js"></script>
</head>
<body class="mdui-drawer-body-left mdui-appbar-with-toolbar  mdui-theme-primary-indigo mdui-theme-accent-pink">
<header class="mdui-appbar mdui-appbar-fixed">
  <div class="mdui-toolbar mdui-color-theme">
    <span class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-drawer="{target: '#main-drawer', swipe: true}"><i class="mdui-icon material-icons">menu</i></span>
    <a href="?/admin/" class="mdui-typo-headline mdui-hidden-xs">OneIndex</a>
    <div class="mdui-toolbar-spacer"></div>
    <a href="?/logout"><i class="mdui-icon material-icons">&#xe8ac;</i> 登出</a>
  </div>
</header>

<div class="mdui-drawer" id="main-drawer">
  <div class="mdui-list" mdui-collapse="{accordion: true}">
	<a href="?/admin/settings" class="mdui-list-item">
      <i class="mdui-list-item-icon mdui-icon material-icons">&#xe8b8;</i>
      <div class="mdui-list-item-content">基本设置</div>
    </a>

    <a href="https://onedrive.live.com/" class="mdui-list-item" target="_blank">
      <i class="mdui-list-item-icon mdui-icon material-icons">&#xe2bf;</i>
      <div class="mdui-list-item-content">文件管理(onedrive)</div>
    </a>

    <a href="?/admin/setpass" class="mdui-list-item">
      <i class="mdui-list-item-icon mdui-icon material-icons">&#xe88d;</i>
      <div class="mdui-list-item-content">后台密码修改</div>
    </a>

  </div>
</div>

<a id="anchor-top"></a>

<div class="mdui-container">
	<?php view::section('content');?>
</div>
</body>

</html>