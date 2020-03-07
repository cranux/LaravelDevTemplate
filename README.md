<h2 align="center">Laravel 6 DevTemplate<h5>

<p align="center">
    <b>laravel + swoole + adminlte 模板 效率开发项目</b>
</p>

  
## 环境要求

1. PHP >= 7.2.0
2. **[Composer](https://getcomposer.org/)**
3. PHP openssl 扩展
4. PHP fileinfo 扩展
5. PDO PHP 拓展
6. Mbstring PHP 拓展
7. Tokenizer PHP 拓展
8. XML PHP 拓展
9. Ctype PHP 拓展
10. JSON PHP 拓展
11. BCMath PHP 拓展
12. Swoole PHP 拓展


## 介绍

laravel 快速开发模板,一些好的模块包括:

swoole接入、权限管理、基于token验证的接口、小程序用户注册、公众号接入、文章管理

目前采用laravel最新版 6.x 框架,后台使用 [JeroenNoten/Laravel-AdminLTE](https://github.com/JeroenNoten/Laravel-AdminLTE) 3.0 全新的后台ui界面,更多灵活扩展的功能; 本项目长期维护 ,原来[Laravel 5 DevelopmentTemplate](https://github.com/cranux/laravelDevelopmentTemplate)将不再维护

## 文档

文档内容逐步增加中  [laravelDevTemplatDoc](http://doc.niexp.cn/docs/laravelDevelopmentTemplate)

后台账号密码:  admin@admin.com   123456

## 安装

1.**执行命令**

```bash
composer install 
```
(不使用swoole时,请把 composer.json中的 hhxsv5/laravel-s 删除再执行上述命令)

2.**复制 `.env`**

```bash
cp .env.example .env
```

3.**配置key**

```bash
php artisan key:generate
```

4.**编辑 `.env`,配置数据库等信息**

5.**生成数据库和填充数据**

```bash
php artisan migrate && php artisan db:seed
```

6.**配置jwt-auth**

```bash
php artisan jwt:secret
```

## 重点讲解laravel-s (swoole)的使用
修改配置config/laravels.php:监听的IP、端口等,请参考[配置项](https://github.com/hhxsv5/laravel-s/blob/master/Settings-CN.md)

### 运行
| 命令 | 说明 |
| --------- | --------- |
| `start` | 启动LaravelS|
| `stop` | 停止LaravelS |
| `restart` | 重启LaravelS |
| `reload` | 平滑重启所有Task/Worker/Timer进程(这些进程内包含了你的业务代码),并触发自定义进程的`onReload`方法,不会重启Master/Manger进程 |
| `info` | 显示组件的版本信息 |
| `help` | 显示帮助信息 |

## 与Nginx配合使用
```nginx
gzip on;
gzip_min_length 1024;
gzip_comp_level 2;
gzip_types text/plain text/css text/javascript application/json application/javascript application/x-javascript application/xml application/x-httpd-php image/jpeg image/gif image/png font/ttf font/otf image/svg+xml;
gzip_vary on;
gzip_disable "msie6";
upstream laravels {
    # 通过 IP:Port 连接
    server 127.0.0.1:5200 weight=5 max_fails=3 fail_timeout=30s;
    # 通过 UnixSocket Stream 连接,小诀窍:将socket文件放在/dev/shm目录下,可获得更好的性能
    #server unix:/xxxpath/laravel-s-test/storage/laravels.sock weight=5 max_fails=3 fail_timeout=30s;
    #server 192.168.1.1:5200 weight=3 max_fails=3 fail_timeout=30s;
    #server 192.168.1.2:5200 backup;
    keepalive 16;
}
server {
    listen 80;
    # 别忘了绑Host哟
    server_name xxx.com;
    root /xxxpath/laravel/public;
    access_log /yyypath/log/nginx/$server_name.access.log  main;
    autoindex off;
    index index.html index.htm;
    # Nginx处理静态资源(建议开启gzip),LaravelS处理动态资源。
    location / {
        try_files $uri @laravels;
    }
    # 当请求PHP文件时直接响应404,防止暴露public/*.php
    #location ~* \.php$ {
    #    return 404;
    #}
    location @laravels {
        # proxy_connect_timeout 60s;
        # proxy_send_timeout 60s;
        # proxy_read_timeout 120s;
        proxy_http_version 1.1;
        proxy_set_header Connection "";
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Real-PORT $remote_port;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header Host $http_host;
        proxy_set_header Scheme $scheme;
        proxy_set_header Server-Protocol $server_protocol;
        proxy_set_header Server-Name $server_name;
        proxy_set_header Server-Addr $server_addr;
        proxy_set_header Server-Port $server_port;
        proxy_pass http://laravels;
    }
}
```

```php
/**
 * 如果启用WebSocket server,$swoole是`Swoole\WebSocket\Server`的实例,否则是是`Swoole\Http\Server`的实例
 * @var \Swoole\WebSocket\Server|\Swoole\Http\Server $swoole
 */
$swoole = app('swoole');
var_dump($swoole->stats());// 单例
```


swoole 的更多配置请阅读:
[hhxsv5/laravel-s中文文档](https://github.com/hhxsv5/laravel-s/blob/master/README-CN.md)

## Adimlte 的配置使用
请仔细查看 [文档](https://github.com/JeroenNoten/Laravel-AdminLTE#62-favicon)

### 有问题请提交 lssues ,本人长期维护更新
也可以添加微信交流 
![微信](https://image.niexp.cn/wx/mmqrcode1578754969742.png)



## 用到的包
- [hhxsv5/laravel-s](https://github.com/hhxsv5/laravel-s)
- [JeroenNoten/Laravel-AdminLTE](https://github.com/JeroenNoten/Laravel-AdminLTE)
- [laravelcollective/html](https://github.com/LaravelCollective/html)
- [overtrue/laravel-ueditor](https://github.com/overtrue/laravel-ueditor)
- [overtrue/laravel-wechat](https://github.com/overtrue/laravel-wechat)
- [prettus/l5-repository](https://github.com/andersao/l5-repository)
- [spatie/laravel-permission](https://github.com/spatie/laravel-permission)
- [yajra/laravel-datatables](https://github.com/yajra/laravel-datatables)
- [vinkla/hashids](https://github.com/vinkla/laravel-hashids)
- [tymon/jwt-auth](https://github.com/tymondesigns/jwt-auth)
- [brotzka/laravel-dotenv-editor](https://github.com/brotzka/laravel-dotenv-editor)
- [zedisdog/laravel-schema-extend](https://github.com/zedisdog/laravel-schema-extend)

## 推荐包
- [iidestiny/laravel-filesystem-oss](https://packagist.org/packages/iidestiny/laravel-filesystem-oss)
- [jacobcyl/ali-oss-storage](https://github.com/jacobcyl/Aliyun-oss-storage)
- [jellybool/flysystem-upyun](https://github.com/JellyBool/flysystem-upyun)
- [overtrue/laravel-filesystem-qiniu](https://github.com/overtrue/laravel-filesystem-qiniu)
- [intervention/image](https://github.com/Intervention/image)
- [ixudra/curl](https://github.com/ixudra/curl)
- [league/uri](https://github.com/thephpleague/uri)
- [maatwebsite/excel](https://github.com/Maatwebsite/Laravel-Excel)
- [orzcc/taobao-top-client](https://github.com/orzcc/taobao-top-client)
- [sentry/sentry-laravel](https://github.com/getsentry/sentry-laravel)
- [simplesoftwareio/simple-qrcode](https://github.com/SimpleSoftwareIO/simple-qrcodea)
- [fxcosta/laravel-chartjs](https://github.com/fxcosta/laravel-chartjs)

## License
  [MIT](https://github.com/cranux/LaravelDevTemplate/blob/master/LICENSE)
  

