# 2018百步梯 爱上女主播-后台

### 食用指南

- 食用前先将`/.env`配置好
- 在你的数据库上运行`/creat.sql`
- 主目录下运行`composer install` 、 `php artisan key:generate` 和 `php artisan storage:link` *有关`composer`与镜像的内容，请参考https://laravel-china.org/composer* 
- 图片存放在`/storage/app/public/img/`下；音频存放在`/storage/app/public/aud/`下
- 前端请求链接配置为*后台存放环境/后台文件夹名/public/接口路由* 
    - 栗子：`url='localhost/LoveHostess-Backstage/public/api/login'`
- 一切配置完就可以跑起来了😂

-------

#### Code By KanoLin. Power By Laravel5.6. 2018.