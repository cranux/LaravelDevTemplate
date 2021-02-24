<h2 align="center">Laravel DevTemplate<h5>

<p align="center">
    <b>laravel + adminlte 模板 效率开发项目</b>
</p>

### 从3.x开始本模板不再集成swoole,集成swoole版本请访问[LaraDevTempSwoole]()

#### 本模板2.x基于laravel6.x开发并集成swoole如需使用切换分支至2.x，3.x基于laravel8.x开发

## 环境要求

1. PHP >= 7.3.0
2. **[Composer](https://getcomposer.org/)**
3. PHP openssl 扩展
4. PHP fileinfo 扩展
5. PDO PHP 拓展
6. Mbstring PHP 拓展


## 介绍

laravel 快速开发模板,一些好的模块包括:

swoole接入、权限管理、基于token验证的接口、小程序用户注册、公众号接入、文章管理

目前采用laravel最新版 8.x 框架,后台使用 [JeroenNoten/Laravel-AdminLTE](https://github.com/JeroenNoten/Laravel-AdminLTE) 3.0 全新的后台ui界面,更多灵活扩展的功能; 本项目长期维护 ,原来[Laravel 5 DevelopmentTemplate](https://github.com/cranux/laravelDevelopmentTemplate)将不再维护

## 文档

文档内容逐步增加中  [laravelDevTemplatDoc](http://doc.niexp.cn/docs/laravelDevelopmentTemplate)

后台账号密码:  admin@admin.com   123456

## 安装

1.**执行命令** (安装依赖)

```bash
composer install    
```

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


## Adimlte 的配置使用
请仔细查看 [文档](https://github.com/JeroenNoten/Laravel-AdminLTE#62-favicon)

### 注意：
如果登录后台有关于composer的报错，请执行
`composer dump-autoload` 之后重启进程重新登录

### 有问题请提交 lssues ,本人长期维护更新
也可以添加微信交流
![微信](https://image.niexp.cn/wx/mmqrcode1578754969742.png)




## License
[MIT](https://github.com/cranux/LaravelDevTemplate/blob/master/LICENSE)
  

