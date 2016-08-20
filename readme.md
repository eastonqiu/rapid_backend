# Rapid Backend (A backend starter based on Laravel 5.2)  
Compose Code Generator([Infyom Laravel-Generator](https://github.com/InfyOmLabs/laravel-generator)), API JWT Token([JWT-Auth](https://github.com/tymondesigns/jwt-auth)), RBAC(Role Based Access Control, [Entrust](https://github.com/Zizaco/entrust)) & ACL([Laravel Policy](https://laravel.com/docs/5.2/authorization#policies)), and Administror Theme [AdminLTE](https://github.com/acacha/adminlte-laravel), and API Doc(Swagger).  
You can quickly add your bussiness and control every resources based on RBAC, just config the permission in the admin UI. It is very easy to config every permission to any user, and easy to extend.

# Premise
* You are a laraveler and familiar with [laravel 5.2](https://laravel.com/docs/5.2)
* [JWT(JSON Web Token)](https://jwt.io/introduction/), a token(auth payload) to access a stateless api instead of the cookies in browser.
* [About RBAC](https://en.wikipedia.org/wiki/Role-based_access_control)
* ACL, we just make the owner have all the permissions of their own resources (related with themselves).
* AdminLTE, a amazing admin theme...you will like it.
* Swagger (coming soon...)

# Screenshots
> comming soon...

# Setup
* Clone this repo. (some install steps can refer to [laravel installation](https://laravel.com/docs/5.2/#installation)).
* Copy .env.example to .env, create database and modify db connection settings.
* Modify folder permission
```
sudo chmod -R www-data:www-data storage bootstrap/cache
```
* Enable rewrite module
```
sudo ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/

# virtual machine setting
<Directory app/public>
    Options Indexes FollowSymLinks
    Require all granted
    AllowOverride All
</Directory>
```
* Migrate database and seed
```
php artisam migrate:refresh --seed
```
We generate three kind of accounts:  
|     email      | password |     desc    
|  root@163.com  | 123456   |  super user   
|  admin@163.com | 123456   |  admin user can not change role and permission  
|  jack@163.com  | 123456   |  a normal user that only have the permissions of their own resources     

* Start server in the root folder
```
php artisan serve
```
Try the three accounts and feel it.  
Open http://localhost:8000/login in browser


# JWTGuard

- JWT
https://github.com/tymondesigns/jwt-auth/issues/513#issuecomment-186087297

# Resource Access Control List(ACL).

## Owner Resource Protection ([Laravel Policy](https://laravel.com/docs/5.2/authorization#policies))


## RBAC - [Entrust](https://github.com/Zizaco/entrust)

It can not support CACHE_DRIVER=file in the stable branch, fix commits:  
https://github.com/Zizaco/entrust/issues/612
https://github.com/Zizaco/entrust/pull/547
change the version: dev-master#6a0fd8c3b73037b4855c6c4eaf1060788c0df1e9

## Config Permissions

# AdminLTE Sidebar Config

# Laravel Generator(Infyom Lab)

# Swagger UI
comming soon....

# TODO

# Issues and discussion are welcome. ^_^

# License
MIT
