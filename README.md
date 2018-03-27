# oneindex
Onedrive Directory Index

## 功能：
将 onedrive 转换成网站 列目录形式直接展示，并文件直接直链下载。

## 安装
- 1、环境需要php 5.6+ 开启 curl 支持
- 2、设置目录 config/ 和 cache/ 为可读可写
- 3、访问网站，绑定账号即可食用
```
 感谢 moeclub 提供的 client_id 和 client_secret,以实现一键绑定
```

## 其他配置
访问 config/base.php

- 设置 目录 缓存时间
``` dir_cache_time  ```
- 设置 文件 缓存时间
``` file_cache_time  ```
- url展示形式
``` root_path="?" ```
如果设置了apache或者nginx的rewrite(使用wordpress的配置即可),将root_path改为空，可以去除url中的"/?/"
