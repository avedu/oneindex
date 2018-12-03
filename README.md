# oneindex
Onedrive Directory Index

## 功能：
不用服务器空间，不走服务器流量，  

直接列onedrive目录，文件直链下载。  

## demo
[https://xn.tn](https://xn.tn)  

## 安装运行

### 源码安装运行：

#### 需求：
1、PHP空间，PHP 5.6+ 打开curl支持  
2、onedrive 账号 (个人、企业版或教育版/工作或学校帐户)  
3、oneindex 程序   

## 配置：
<img width="658" alt="image" src="https://raw.githubusercontent.com/donwa/oneindex/files/images/install.gif">  


### docker 安装运行：

运行：

```sh
docker run -d --name oneindex \
    -p 80:80 --restart=always \
    -v ~/oneindex/config:/var/www/html/config \
    -v ~/oneindex/cache:/var/www/html/cache \
    -e REFRESH_TOKEN='0 * * * *' \
    -e REFRESH_CACHE='*/10 * * * *' \
    setzero/oneindex
```

变量说明：

- `REFRESH_TOKEN`刷新一次token的crontab表达式，默认值`0 * * * *`，即每小时
- `REFRESH_CACHE`刷新一次cache的crontab表达式，默认值`*/10 * * * *`，即每10分钟

停止删除容器：

```shell
docker stop oneindex
docker rm -v oneindex
```

### docker-compose 安装运行：

运行：

```sh
docker-compose up -d
```

停止删除容器：

```shell
docker-compose down
```

### 计划任务  
[可选]**推荐配置**，非必需。后台定时刷新缓存，可增加前台访问的速度  
```
# 每小时刷新一次token
0 * * * * /具体路径/php /程序具体路径/one.php token:refresh

# 每十分钟后台刷新一遍缓存
*/10 * * * * /具体路径/php /程序具体路径/one.php cache:refresh
```

## 特殊文件实现功能  
` README.md `、`HEAD.md` 、 `.password`特殊文件使用  

可以参考[https://github.com/donwa/oneindex/tree/files](https://github.com/donwa/oneindex/tree/files)  

**在文件夹底部添加说明:**  
>在onedrive的文件夹中添加` README.md `文件，使用markdown语法。  

**在文件夹头部添加说明:**  
>在onedrive的文件夹中添加`HEAD.md` 文件，使用markdown语法。  

**加密文件夹:**  
>在onedrive的文件夹中添加`.password`文件，填入密码，密码不能为空。  

**直接输出网页:**  
>在onedrive的文件夹中添加`index.html` 文件，程序会直接输出网页而不列目录。  
>配合 文件展示设置-直接输出 效果更佳  

## 命令行功能  
仅能在php cli模式下运行  
**清除缓存:**  
```
php one.php cache:clear
```
**刷新缓存:**  
```
php one.php cache:refresh
```
**刷新令牌:**  
```
php one.php token:refresh
```
**上传文件:**  
```
php one.php upload:file 本地文件 [onedrive文件]
```


**上传文件夹:**  
```
php one.php upload:folder 本地文件夹 [onedrive文件夹]
```

例如：  
```
//上传demo.zip 到onedrive 根目录  
php one.php upload:file demo.zip  

//上传demo.zip 到onedrive /test/目录  
php one.php upload:file demo.zip /test/  

//上传demo.zip 到onedrive /test/目录并命名为 d.zip  
php one.php upload:file demo.zip /test/d.zip  

//上传up/ 到onedrive /test/  
php one.php upload:file up/ /test/
```
