# oneindex
Onedrive Directory Index

## 功能：
不用服务器空间，不走服务器流量，  

直接列onedrive目录，文件直链下载。  

## change log:  
18-03-29: 更新直链获取机制、缓存机制，避免频繁访问的token失效  
18-03-29: 解决非英文编码问题  
18-03-29: 添加onedrive共享的起始目录 功能  
18-03-29: 添加rewrite的配置文件  
18-03-29: 增加sqlite模式cache支持  
18-03-29: 添加缩略图功能  

## 需求：
1、PHP空间，PHP 5.6+ 打开curl支持  
2、onedrive business 账号 (企业版或教育版)  
3、oneindex 程序   

## 安装：
1、复制oneindex到服务器，设置` config/ `、`config/base.php` 、 `cache/` 可读写  
2、浏览器访问、绑定账号  
3、可以使用  

## 可配置项
配置在 `config/base.php` 文件中:  

**onedrive共享的起始目录:**  
```
'onedrive_root'=> '', //默认为根目录
```  

如果想只共享onedrive下的 /document/share/ 目录  
```
'onedrive_root'=> '/document/share', //最后不带 '/'
```  
  
**去掉链接中的 /?/ :** 
需要添加apache/nginx/iis的rewrite的配置文件  
参考程序根目录下的：`.htaccess`或`nginx.conf`或`Web.config`  
```
    'root_path' => '?' 
```
改为  

```
    'root_path' => '?' 
```  
  
**缓存时间:**  
初步测试直链过期时间为一小时,默认设置为： 
```
  'cache_expire_time' => 3600, //缓存过期时间 /秒
  'cache_refresh_time' => 600, //缓存刷新时间 /秒
```
如果经常出现链接失效，可尝试缩短缓存时间,如:  
```
  'cache_expire_time' => 300, //缓存过期时间 /秒
  'cache_refresh_time' => 60, //缓存刷新时间 /秒
```
  
**设置缓存模式为sqlite:**  
```
'cache_type'=> 'sqlite'  // file | sqlite
```

## demo
列目录：[https://xn.tn](url)  
直连下载：[https://xn.tn/node-v8.9.4-x64.msi](url)  
图片直连：http://xn.tn/bg.jpg  
![Alt text](http://xn.tn/bg.jpg)
缩略图：thumbnails=large|medium|small  
![thumbnails](http://xn.tn/bg.jpg?thumbnails=medium)
![thumbnails](http://xn.tn/bg.jpg?thumbnails=small)


[![Watch the video](https://xn.tn/trailer.mp4?thumbnails=large)](https://xn.tn/trailer.mp4)

## Q&A:  
**Q:需要企业版或教育版的全局管理员？**  
A:不需要，全局管理员开出来的子账号就可以，不过该域名在office365必须要有管理员  

**Q:文件上传后，不能即时在程序页面显示出来？**  
A:有缓存，可以在config/base.php设置缓存时间。  


**Q:能否使用自己的client_id、client_secret？**  
A: 1、按照 https://moeclub.org/2017/03/17/24/ 教程获得 client_id、client_secret、code  
    2、修改 config/base.php 中的值  
    3、访问 http://你的域名/?/install&code=你的code 完成账号绑定  



> 感谢 moeclub 提供的 client_id 和 client_secret,以实现一键绑定
